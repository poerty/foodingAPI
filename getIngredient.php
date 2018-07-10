<?php
header("Content-Type: text/html; charset=UTF-8");

require_once("version_functions.php");
require_once("config.php");
require_once("db.php");
//$chartonum = Number($companyID);
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
$text=substr($_GET['key'],1);

$return_arr = array();
$sib = array();
function getIngredient($conn,$getRID){
    global $return_arr;
    global $sib;
    $sql = "SELECT * FROM F_RecipeIngredient RI JOIN F_Ingredient I ON RI.IID=I.IID WHERE RID=$getRID";
    $result = mysqli_query($conn,$sql);
    $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
    for($i=0;$i<$result->num_rows;$i++){
      if ($sib[$rows[$i]['IID']-"0"] == 1)
        continue;
        $sib[$rows[$i]['IID']-"0"] = 1;
        array_push($return_arr,$rows[$i]);
        if($rows[$i]['Is_Recipe']!=-1){
            getIngredient($conn,$rows[$i]['Is_Recipe']);
        }
    }
    $sql = "SELECT INAME as `NAME`, INAME as `English_NAME` ,IID FROM F_RecipeIngredient RI JOIN F_TempIngredient TI ON RI.recipeIngredient_id = TI.recipeIngredient_id WHERE RI.RID=$getRID AND RI.IID=0";
    $result = mysqli_query($conn,$sql);
    $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
    for($i=0;$i<$result->num_rows;$i++){
        $rows[$i]['NAME']="[".$rows[$i]['NAME']."]";
        $rows[$i]['English_NAME']="[".$rows[$i]['English_NAME']."]";
        array_push($return_arr,$rows[$i]);
    }
}

getIngredient($conn,$text);

echo my_json_encode($return_arr);
?>
