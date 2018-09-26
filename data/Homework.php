<?php
include 'Conn.php';
    

$sql='select homework_id,homework_title,homework_title_img,DATE_FORMAT(homework_date,"%Y-%m-%d") homework_date,homework_type from t_homework  order by homework_id desc';
mysqli_query($connect,'set names utf8');


$result=mysqli_query($connect,$sql);
$arr=array();
while($row = $result->fetch_assoc()) { 
	$count=count($row);
	for($i=0;$i<$count;$i++){ 
	unset($row[$i]);
	}
	array_push($arr,$row); 
}

echo json_encode($arr,JSON_UNESCAPED_UNICODE);

mysqli_close($connect);

?>
