<?php
header("Content-Type: text/html; charset=UTF-8");

require_once("version_functions.php");
require_once("config.php");
require_once("db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

$CID=$_GET['CID'];
$English_RNAME=$_GET['English_RNAME'];
$Location=$_GET['location'];
$Email=$_GET['Email'];

$sql = "INSERT INTO F_CertificateRequest(CID,date) VALUES(".$CID.",NOW())";
//query 에 변수(POST, get 등으로부터 받은 값들) 사용하는 예시
//$sql = "DELETE from m_unadmit_students WHERE uid=".$_GET['uid'];
$result  = mysqli_query($conn, $sql);

$sql="UPDATE F_Company SET Email='".$Email."' WHERE CID=".$CID;
mysqli_query($conn,$sql);
$sql="UPDATE F_Company SET `Location`='".$Location."' WHERE CID=".$CID;
mysqli_query($conn,$sql);

$sql = "SELECT * FROM F_RecipeID WHERE CID=$CID";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)){
    $sql2 = "UPDATE F_RecipeID SET English_RNAME='".$English_RNAME[$row['RID']]."' WHERE RID=".$row['RID'];
    mysqli_query($conn,$sql2);
}

?>
