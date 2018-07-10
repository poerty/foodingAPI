<?php
header("Content-Type: text/html; charset=UTF-8");

require_once("version_functions.php");
require_once("config.php");
require_once("db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

$sql = "SELECT * FROM F_Company WHERE login_id='".$_GET['ID']."'";
//query 에 변수(POST, get 등으로부터 받은 값들) 사용하는 예시
//$sql = "DELETE from m_unadmit_students WHERE uid=".$_GET['uid'];
$result  = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if($result->num_rows == 0){
    $sql = "INSERT INTO F_Company(CNAME, login_id, login_password, Email, `Location`) VALUES('".$_GET['CNAME']."','".$_GET['ID']."','".$_GET['password']."','".$_GET['email']."','".$_GET['address']."')";
    $result = mysqli_query($conn, $sql);
    echo "success";
} else {
    $sql = "UPDATE F_Company SET CNAME='".$_GET['CNAME']."', login_id='".$_GET['ID']."',login_password='".$_GET['password']."',Email='".$_GET['email']."',Location='".$_GET['address']."' WHERE CID='".$row['CID']."'";
    $result = mysqli_query($conn, $sql);
    echo "success";
}
?>
