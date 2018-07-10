<?php
header("Content-Type: application/json; charset=UTF-8");

require_once("version_functions.php");
require_once("config.php");
require_once("db.php");

$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

$text=substr($_GET['RID'],1);
$sql = "SELECT round(sum(F_RecipeIngredient.IngredientSize*F_Ingredient.Calorie),3) as Calorie , 
        round(sum(F_RecipeIngredient.IngredientSize*F_Ingredient.Carbohydrate),3) as Carbohydrate, 
        round(sum(F_RecipeIngredient.IngredientSize*F_Ingredient.Protein),3) as Protein , 
        round(sum(F_RecipeIngredient.IngredientSize*F_Ingredient.Fat),3) as Fat, 
        round(sum(F_RecipeIngredient.IngredientSize*F_Ingredient.Sugar),3) as Sugar, 
        round(sum(F_RecipeIngredient.IngredientSize*F_Ingredient.Na),3) as Na, 
        round(sum(F_RecipeIngredient.IngredientSize*F_Ingredient.Cholesterol),3) as Cholesterol,  
        round(sum(F_RecipeIngredient.IngredientSize*F_Ingredient.FattyAcid),3) as FattyAcid,  
        round(sum(F_RecipeIngredient.IngredientSize*F_Ingredient.TransFattyAcid),3) as TransFattyAcid 
        FROM F_RecipeIngredient,F_Ingredient 
        where F_Ingredient.IID=F_RecipeIngredient.IID AND F_RecipeIngredient.RID=$text";

$result  = mysqli_query($conn, $sql);
if($result->num_rows == 0){
    echo "fail";
    //query 의 결과가 없을때 오류 fail
} else {
    $rows=mysqli_fetch_all($result,MYSQLI_ASSOC);
    echo my_json_encode($rows);
}
?>
