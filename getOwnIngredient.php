<?php
header("Content-Type: text/html; charset=UTF-8");

require_once("version_functions.php");
require_once("config.php");
require_once("db.php");
//$chartonum = Number($companyID);
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

$text=substr($_GET['key'],1);

$return_arr = array();

function getIngredient($conn,$getRID){
    global $return_arr;
    $sql = "SELECT * FROM F_RecipeIngredient RI JOIN F_Ingredient I ON RI.IID=I.IID WHERE RID=$getRID AND RI.IID!=0";
    $result = mysqli_query($conn,$sql);
    $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);

    for($i=0;$i<$result->num_rows;$i++){
        array_push($return_arr,$rows[$i]);
    }

    $sql = "SELECT INAME as `NAME`,IID FROM F_RecipeIngredient RI JOIN F_TempIngredient TI ON RI.recipeIngredient_id=TI.recipeIngredient_id WHERE RID=$getRID AND IID=0";
    $result = mysqli_query($conn,$sql);
    $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);

    for($i=0;$i<$result->num_rows;$i++){
        array_push($return_arr,$rows[$i]);
    }
}

getIngredient($conn,$text);

echo my_json_encode($return_arr);
?>
