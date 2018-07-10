<?php
header("Content-Type: application/json; charset=UTF-8");

require_once("version_functions.php");
require_once("config.php");
require_once("db.php");

$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

$text=substr($_GET['recipeID'],1);
//$recipeid = $_GET['recipeID'];

$sib = mysqli_query("SELECT RNAME FROM F_RecipeID WHERE RID=$text");
$sib=mysqli_fetch_array($sib);
$sql = "SELECT RID,RNAME FROM F_RecipeID WHERE RID=$text";

$result  = mysqli_query($conn, $sql);
//$sib = $sql;
if($result->num_rows == 0){
  //  $sql = "SELECT * FROM F_recipeid ";
/*  $sql = "SELECT RID,RNAME FROM F_RecipeID ";
    $result  = mysqli_query($conn, $sql);
    $rows=mysqli_fetch_all($result,MYSQLI_ASSOC);
    echo my_json_encode($rows);*/
	echo "fail";
    //query 의 결과가 없을때 오류 fail
} else {
    $rows=mysqli_fetch_all($result,MYSQLI_ASSOC);
    echo my_json_encode($rows[0]);
//  echo  $sib;
}
?>
