<?php
header("Content-Type: text/html; charset=UTF-8");

require_once("version_functions.php");
require_once("config.php");
require_once("db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

$CID=$_GET['CID'];
$English_NAME=$_GET['English_NAME'];

$sql = "DELETE FROM F_CertificateRequest WHERE CID=$CID";
//query 에 변수(POST, get 등으로부터 받은 값들) 사용하는 예시
//$sql = "DELETE from m_unadmit_students WHERE uid=".$_GET['uid'];
$result  = mysqli_query($conn, $sql);

$sql = "UPDATE F_Company SET certificated=1 WHERE CID=".$CID;
$result=mysqli_query($conn,$sql);

$sql = "SELECT * FROM F_RecipeID WHERE CID=$CID";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)){
    $sql2 = "SELECT sum(F_RecipeIngredient.IngredientSize) as ServingSize, sum(F_RecipeIngredient.IngredientSize*F_Ingredient.Calorie) as Calorie , sum(F_RecipeIngredient.IngredientSize*F_Ingredient.Carbohydrate) as Carbohydrate, sum(F_RecipeIngredient.IngredientSize*F_Ingredient.Protein) as Protein , sum(F_RecipeIngredient.IngredientSize*F_Ingredient.Fat) as Fat, sum(F_RecipeIngredient.IngredientSize*F_Ingredient.Sugar) as Sugar, sum(F_RecipeIngredient.IngredientSize*F_Ingredient.Na) as Na, sum(F_RecipeIngredient.IngredientSize*F_Ingredient.Cholesterol) as Cholesterol,  sum(F_RecipeIngredient.IngredientSize*F_Ingredient.FattyAcid) as FattyAcid,  sum(F_RecipeIngredient.IngredientSize*F_Ingredient.TransFattyAcid) as TransFattyAcid FROM F_RecipeIngredient,F_Ingredient where F_Ingredient.IID=F_RecipeIngredient.IID AND F_RecipeIngredient.RID=".$row['RID'];
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    if($row2['Calorie']!=NULL){
        $sql3 = "INSERT INTO F_Ingredient(`IID` ,`NAME` ,`English_NAME` ,`ServingSize` ,`Calorie` ,`Carbohydrate` ,`Protein` ,`Fat` ,`Sugar` ,`Na` ,`Cholesterol` ,`FattyAcid` ,`TransFattyAcid` ,`Is_Recipe`)
            VALUES (NULL ,  '".$row['RNAME']."',  '".$row['English_RNAME']."',  '".$row2['ServingSize']."',  ".$row2['Calorie'].",  ".$row2['Carbohydrate'].",  ".$row2['Protein'].",  ".$row2['Fat'].",  ".$row2['Sugar'].",  ".$row2['Na'].",  ".$row2['Cholesterol'].",  ".$row2['FattyAcid'].",  ".$row2['TransFattyAcid'].", ".$row['RID'].")";
        mysqli_query($conn,$sql3);
    }
    else{
        $sql3 = "INSERT INTO F_Ingredient(`IID` ,`NAME` ,`English_NAME`,`Is_Recipe`)
        VALUES (NULL ,  '".$row['RNAME']."',  '".$row['English_RNAME']."', ".$row['RID'].")";
        mysqli_query($conn,$sql3);
    }
}

?>
