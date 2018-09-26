<?php
include 'Conn.php';
    
$homework_title=$_POST['homework_title'];
$homework_title_img=$_POST['homework_title_img'];
$user_id=$_POST['user_id'];
$homework_type=$_POST['homework_type'];

$homework_info=$_POST['homework_info'];
$openid=$_POST['openid'];

$sql="INSERT INTO t_homework(homework_title,homework_title_img,user_id,homework_type,homework_info,openid)
VALUES('$homework_title','$homework_title_img','$user_id','$homework_type','$homework_info','$openid')";



mysqli_query($connect,'set names utf8');
mysqli_query($connect,$sql);
//echo json_encode($arr,JSON_UNESCAPED_UNICODE);

//echo mysql_insert_id();
mysqli_close($connect);

?>