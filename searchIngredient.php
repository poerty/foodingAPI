<?php
header("Content-Type: text/html; charset=UTF-8");

require_once("version_functions.php");
require_once("config.php");
require_once("db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

$searchText = $_GET['searchText'];
$boolbool = $_GET['translate'];
$searchText = strtoupper($searchText);
if($boolbool == 'true'){
  $sql = "SELECT * FROM F_Ingredient WHERE UPPER(English_NAME) LIKE '%$searchText%' LIMIT 50";
}
else {
$sql = "SELECT * FROM F_Ingredient WHERE UPPER(NAME) LIKE '%$searchText%' LIMIT 50";
}
$result  = mysqli_query($conn, $sql);
if($result->num_rows == 0){
    echo "fail";
} else {
    $rows=mysqli_fetch_all($result,MYSQLI_ASSOC);
    echo my_json_encode($rows);
}
?>
