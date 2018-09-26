<?php
include 'Conn.php';
    
$homework_info_title=$_POST['homework_info_title'];
$user_id=$_POST['user_id'];
$homework_id=$_POST['homework_id'];
$homework_info=$_POST['homework_info'];

$sql="INSERT INTO t_homework_info ( homework_id, user_id, homework_info_title, homework_info )
VALUES
	( '$homework_id', '$user_id', '$homework_info_title', '$homework_info' )";



mysqli_query($connect,'set names utf8');
mysqli_query($connect,$sql);
//echo json_encode($arr,JSON_UNESCAPED_UNICODE);

//echo mysql_insert_id();
mysqli_close($connect);

?>