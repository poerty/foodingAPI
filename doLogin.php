<?php
header("Content-Type: text/html; charset=UTF-8");

require_once("version_functions.php");
require_once("config.php");
require_once("db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

$sql = "SELECT * FROM F_Company WHERE login_id='".$_GET['ID']."' AND login_password='".$_GET['password']."'";
//query 에 변수(POST, get 등으로부터 받은 값들) 사용하는 예시
//$sql = "DELETE from m_unadmit_students WHERE uid=".$_GET['uid'];
$result  = mysqli_query($conn, $sql);
if($result->num_rows == 0){
    echo "fail";
} else {
    $row=mysqli_fetch_assoc($result);
    echo my_json_encode($row);
}
?>
