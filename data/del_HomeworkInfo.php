<?php
session_start();
include 'Conn.php';
    

$hi_id=$_POST['hi_id'];
$user_id = $_SESSION['Uuser_id'];
echo $hi_id;
echo $user_id;


$sql="delete from t_homework_info where  homework_info_id=$hi_id and user_id = $user_id";



mysqli_query($connect,'set names utf8');
mysqli_query($connect,$sql);
//echo json_encode($arr,JSON_UNESCAPED_UNICODE);

//echo mysql_insert_id();
mysqli_close($connect);

?>