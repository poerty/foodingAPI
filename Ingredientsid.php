<?php
header("Content-Type: application/json; charset=UTF-8");

require_once("version_functions.php");
require_once("config.php");
require_once("db.php");
//$chartonum = Number($companyID);
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
//$sql = "SELECT * FROM F_RecipeID";
//$sql = "SELECT F_Ingredient.IID, F_Ingredient.NAME FROM F_Ingredient JOIN F_RecipeIngredient on F_Ingredient.IID=F_F_RecipeIngredient.IID  WHERE F_F_RecipeIngredient.RID="._GET['key'];


//echo my_json_encode($_GET[0]['ingredientList']);
$key=$_GET['key'];

if($key[0]=='R'){
    $key=substr($key, 1, 100);
    $sql = "SELECT * FROM F_Ingredient I WHERE Is_Recipe=$key";
}
else{
    $sql = " SELECT * FROM F_Ingredient I WHERE IID=$key";    
}
//$sql = INSERT INTO F_RecipeID(RNAME, CID) VALUES($_GET['recipeName'],$_GET['companyID']);
//$sql = "SELECT F_Ingredient.IID, F_Ingredient.NAME FROM F_Ingredient, F_RecipeIngredient   WHERE F_Ingredient.IID=F_RecipeIngredient.IID AND F_RecipeIngredient.RID=".$_GET['key'];
//query 에 변수(post, get 등으로부터 받은 값들) 사용하는 예시
//$sql = "DELETE from m_unadmit_students WHERE uid=".$_POST['uid'];
$result  = mysqli_query($conn, $sql);
//$recipeName = .$_GET["recipeName"];
//$companyID=$_GET['companyID']
//echo my_json_encode($ingredientList[1]);
//$len=sizeof($ingredientList);
//cho my_json_encode($len);
$row = mysqli_fetch_assoc($result);
echo my_json_encode($row);