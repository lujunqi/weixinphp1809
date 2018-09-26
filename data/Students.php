<?php
include 'Conn.php';
    

$sql='select student_name,student_id,student_no from t_student';
mysqli_query($connect,'set names utf8');


$result=mysqli_query($connect,$sql);
$students=array();


while($row = $result->fetch_assoc()) { 
	$count=count($row);
	for($i=0;$i<$count;$i++){ 
	unset($row[$i]);
	}
	array_push($students,$row); 
}

mysqli_close($connect);

?>
