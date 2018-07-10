<?php
header("Content-Type: application/json; charset=UTF-8");

require_once("version_functions.php");
require_once("config.php");
require_once("db.php");
//$chartonum = Number($companyID);
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
//$sql = "SELECT * FROM F_RecipeID ";
$sql = "SELECT * FROM F_RecipeID WHERE CID=".$_GET['companyID'];
//query 에 변수(post, get 등으로부터 받은 값들) 사용하는 예시
//$sql = "DELETE from m_unadmit_students WHERE uid=".$_POST['uid'];
$result  = mysqli_query($conn, $sql);
if($result->num_rows == 0){
  //  $sql = "SELECT * FROM F_recipeid ";
  echo "fail";
  
    //query 의 결과가 없을때 오류 fail
} else {
    $rows=mysqli_fetch_all($result,MYSQLI_ASSOC);
    echo my_json_encode($rows);
}
?>
