<?php
header("Content-Type: application/json; charset=UTF-8");

require_once("version_functions.php");
require_once("config.php");
require_once("db.php");
//$chartonum = Number($companyID);
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
//$sql = "SELECT * FROM F_RecipeID ";
$sql = "SELECT RID,RNAME FROM F_RecipeID WHERE CID=(SELECT CID FROM F_RecipeID WHERE RID=".$_GET['recipeID'].")";
//query 에 변수(post, get 등으로부터 받은 값들) 사용하는 예시
//$sql = "DELETE from m_unadmit_students WHERE uid=".$_POST['uid'];

$ingredientList=$_GET['filterList'];

$text=substr($_GET['recipeID'],1);
$sql = "SELECT F_RecipeID.RID as RID FROM F_RecipeID,F_Company WHERE F_RecipeID.CID=(SELECT F_RecipeID.CID FROM F_RecipeID WHERE RID=$text) AND F_RecipeID.CID=F_Company.CID";
$result = mysqli_query($conn, $sql);
$rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
$return_arr2 = array();
//echo my_json_encode($rows);
for($i=0;$i<$result->num_rows;$i++){
    array_push($return_arr2,$rows[$i]);
    //echo $rows[$i];
}

//echo my_json_encode($return_arr2);
$return_arr=array();



for($i=0;$i<sizeof($return_arr2);$i++){
    $flag = 0;
    for($j=0;$j<count($ingredientList);$j++){
        $temp = $return_arr2[$i]['RID'];
        $sql = "SELECT F_RecipeIngredient.RID,F_RecipeID.RNAME,F_Company.CNAME FROM F_RecipeIngredient,F_RecipeID,F_Company WHERE F_Company.CID=F_RecipeID.CID AND F_RecipeID.RID=F_RecipeIngredient.RID AND F_RecipeIngredient.RID =$temp  AND F_RecipeIngredient.IID='".$ingredientList[$j]."'";
        $result2 = mysqli_query($conn, $sql);
        $rows2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);
        if(sizeof($rows2)==0){
        }
        else {
            $flag=1;
        }
    }
    if($flag==0){
        $sql = "SELECT F_RecipeIngredient.RID,F_RecipeID.RNAME,F_Company.CNAME FROM F_RecipeIngredient,F_RecipeID,F_Company WHERE F_Company.CID=F_RecipeID.CID AND F_RecipeID.RID=F_RecipeIngredient.RID AND F_RecipeIngredient.RID = '".$return_arr2[$i]['RID']."'";
        $result2 = mysqli_query($conn, $sql);
        $rows2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);
        array_push($return_arr,$rows2[0]);
    }
}
echo my_json_encode($return_arr);
?>
