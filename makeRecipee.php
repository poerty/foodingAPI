<?php
header("Content-Type: text/html; charset=UTF-8");

require_once("version_functions.php");
require_once("config.php");
require_once("db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

$ingredientList=$_GET['ingredientList'];
$ingredientAmountList=$_GET['ingredientAmountList'];
$ingredientNameList=$_GET['ingredientNameList'];
$companyID=$_GET['companyID'];
$recipeName=$_GET['recipeName'];
$ownName=$_GET['ownName'];

$sql = "SELECT * FROM F_Company WHERE CID=$companyID";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

$certificated = $row['certificated'];

if($ownName!=""){
    $sql = "SELECT * FROM F_RecipeID WHERE CID=$companyID AND RNAME='$ownName'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $RID=$row['RID'];
    $sql = "DELETE FROM F_RecipeIngredient WHERE RID=$RID";
    $result = mysqli_query($conn,$sql);
    $sql = "DELETE FROM F_Ingredient WHERE Is_Recipe=$RID";
    $result = mysqli_query($conn,$sql);


    $sql = "UPDATE F_RecipeID SET RNAME='$recipeName' WHERE RID=".$row['RID'];
    $result = mysqli_query($conn, $sql);

    $id = $row['RID'];
    
    for($i=0;$i<count($ingredientList);$i++){
        $sql = "INSERT INTO F_RecipeIngredient(RID,IID,IngredientSize) VALUES($id,$ingredientList[$i],$ingredientAmountList[$i])";
        mysqli_query($conn,$sql);
        if($ingredientNameList[$i]!="" && $ingredientNameList[$i]!=null){
            $id2 = mysqli_insert_id($conn);
            $sql2 = "INSERT INTO F_TempIngredient(recipeIngredient_id,INAME) VALUES($id2,'$ingredientNameList[$i]')";
            mysqli_query($conn,$sql2);            
        }
    }
    if($certificated==1){
        $sql2 = "SELECT sum(F_RecipeIngredient.IngredientSize) as ServingSize, sum(F_RecipeIngredient.IngredientSize*F_Ingredient.Calorie) as Calorie , sum(F_RecipeIngredient.IngredientSize*F_Ingredient.Carbohydrate) as Carbohydrate, sum(F_RecipeIngredient.IngredientSize*F_Ingredient.Protein) as Protein , sum(F_RecipeIngredient.IngredientSize*F_Ingredient.Fat) as Fat, sum(F_RecipeIngredient.IngredientSize*F_Ingredient.Sugar) as Sugar, sum(F_RecipeIngredient.IngredientSize*F_Ingredient.Na) as Na, sum(F_RecipeIngredient.IngredientSize*F_Ingredient.Cholesterol) as Cholesterol,  sum(F_RecipeIngredient.IngredientSize*F_Ingredient.FattyAcid) as FattyAcid,  sum(F_RecipeIngredient.IngredientSize*F_Ingredient.TransFattyAcid) as TransFattyAcid FROM F_RecipeIngredient,F_Ingredient where F_Ingredient.IID=F_RecipeIngredient.IID AND F_RecipeIngredient.RID=".$id;
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        if($row2['Calorie']!=NULL){
            $sql3 = "INSERT INTO F_Ingredient(`IID` ,`NAME` ,`English_NAME` ,`ServingSize` ,`Calorie` ,`Carbohydrate` ,`Protein` ,`Fat` ,`Sugar` ,`Na` ,`Cholesterol` ,`FattyAcid` ,`TransFattyAcid` ,`Is_Recipe`)
                VALUES (NULL ,  '".$recipeName."',  '',  '".$row2['ServingSize']."',  ".$row2['Calorie']/$row2['ServingSize'].",  ".$row2['Carbohydrate']/$row2['ServingSize'].",  ".$row2['Protein']/$row2['ServingSize'].",  ".$row2['Fat']/$row2['ServingSize'].",  ".$row2['Sugar']/$row2['ServingSize'].",  ".$row2['Na']/$row2['ServingSize'].",  ".$row2['Cholesterol']/$row2['ServingSize'].",  ".$row2['FattyAcid']/$row2['ServingSize'].",  ".$row2['TransFattyAcid']/$row2['ServingSize'].", ".$id.")";
            mysqli_query($conn,$sql3);
        }
        else{
            $sql3 = "INSERT INTO F_Ingredient(`IID` ,`NAME` ,`English_NAME`,`Is_Recipe`)
            VALUES (NULL ,  '".$recipeName."',  '', ".$id.")";
            mysqli_query($conn,$sql3);
        }
    }
}
else{
    $sql = "INSERT INTO F_RecipeID(RNAME, CID) VALUES('$recipeName','$companyID')";
    $result = mysqli_query($conn, $sql);
    $id = mysqli_insert_id($conn);
    
    for($i=0;$i<count($ingredientList);$i++){
        $sql = "INSERT INTO F_RecipeIngredient(RID,IID,IngredientSize) VALUES($id,$ingredientList[$i],$ingredientAmountList[$i])";
        mysqli_query($conn,$sql);
        if($ingredientNameList[$i]!="" && $ingredientNameList[$i]!=null){
            $id2 = mysqli_insert_id($conn);
            $sql2 = "INSERT INTO F_TempIngredient(recipeIngredient_id,INAME) VALUES($id2,'$ingredientNameList[$i]')";
            mysqli_query($conn,$sql2);            
        }
    }
    if($certificated==1){
        $sql2 = "SELECT sum(F_RecipeIngredient.IngredientSize) as ServingSize, sum(F_RecipeIngredient.IngredientSize*F_Ingredient.Calorie) as Calorie , sum(F_RecipeIngredient.IngredientSize*F_Ingredient.Carbohydrate) as Carbohydrate, sum(F_RecipeIngredient.IngredientSize*F_Ingredient.Protein) as Protein , sum(F_RecipeIngredient.IngredientSize*F_Ingredient.Fat) as Fat, sum(F_RecipeIngredient.IngredientSize*F_Ingredient.Sugar) as Sugar, sum(F_RecipeIngredient.IngredientSize*F_Ingredient.Na) as Na, sum(F_RecipeIngredient.IngredientSize*F_Ingredient.Cholesterol) as Cholesterol,  sum(F_RecipeIngredient.IngredientSize*F_Ingredient.FattyAcid) as FattyAcid,  sum(F_RecipeIngredient.IngredientSize*F_Ingredient.TransFattyAcid) as TransFattyAcid FROM F_RecipeIngredient,F_Ingredient where F_Ingredient.IID=F_RecipeIngredient.IID AND F_RecipeIngredient.RID=".$id;
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        if($row2['Calorie']!=NULL){
            $sql3 = "INSERT INTO F_Ingredient(`IID` ,`NAME` ,`English_NAME` ,`ServingSize` ,`Calorie` ,`Carbohydrate` ,`Protein` ,`Fat` ,`Sugar` ,`Na` ,`Cholesterol` ,`FattyAcid` ,`TransFattyAcid` ,`Is_Recipe`)
                VALUES (NULL ,  '".$recipeName."',  '',  '".$row2['ServingSize']."',  ".$row2['Calorie'].",  ".$row2['Carbohydrate'].",  ".$row2['Protein'].",  ".$row2['Fat'].",  ".$row2['Sugar'].",  ".$row2['Na'].",  ".$row2['Cholesterol'].",  ".$row2['FattyAcid'].",  ".$row2['TransFattyAcid'].", ".$id.")";
            mysqli_query($conn,$sql3);
        }
        else{
            $sql3 = "INSERT INTO F_Ingredient(`IID` ,`NAME` ,`English_NAME`,`Is_Recipe`)
            VALUES (NULL ,  '".$recipeName."',  '', ".$id.")";
            mysqli_query($conn,$sql3);
        }
    }
}





echo $id;

/*
if($result->num_rows != 0){
  $f = fail;
  echo my_json_encode($f);
  return;
}
else {
  $sql = " SELECT * FROM F_RecipeID WHERE CID=$companyID";
  $result  = mysqli_query($conn, $sql);
  if($result->num_rows != 0){
    $sql = "INSERT INTO F_RecipeID(RNAME, CID) VALUES('".$_GET['recipeName']."','".$_GET['companyID']."')";
    mysqli_query($conn, $sql);
    $temprid = "SELECT RID FROM F_RecipeID WHERE CID='".$_GET['companyID']."' and RNAME='".$_GET['recipeName']."'";
  }

}
*/
?>
