<?php
include 'Conn.php';
    
$homework_id=$_POST['homework_id'];

$sql="delete from t_homework where homework_id = $homework_id";



mysqli_query($connect,'set names utf8');
mysqli_query($connect,$sql);


mysqli_close($connect);

?>