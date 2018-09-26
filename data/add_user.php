<?php
include 'Conn.php';
    
$user_tel=$_POST['user_tel'];
$user_icon=$_POST['user_icon'];
$user_name=$_POST['user_name'];
$student_id=$_POST['student_id'];
$teacher_type=$_POST['teacher_type'];
$user_type=$_POST['user_type'];
$openid=$_POST['openid'];

$sql="INSERT INTO t_user(user_tel,user_icon,user_name,student_id,teacher_type,user_type,openid)
values('$user_tel','$user_icon','$user_name','$student_id','$teacher_type','$user_type','$openid')";



mysqli_query($connect,'set names utf8');
mysqli_query($connect,$sql);
//echo json_encode($arr,JSON_UNESCAPED_UNICODE);

echo mysql_insert_id();
mysqli_close($connect);

?>