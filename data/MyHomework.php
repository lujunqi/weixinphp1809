<?php
include 'Conn.php';
    
$openid = $_POST["openid"];
$sql="SELECT
	homework_id,
	homework_title,
	homework_title_img,
	DATE_FORMAT( homework_date, '%Y-%m-%d' ) homework_date,
	homework_type,
	( SELECT count( 1 ) FROM t_homework_follow hn WHERE hn.homework_id = h.homework_id ) homework_follow 
FROM
	t_homework h 
WHERE
	openid = '$openid' 
ORDER BY
	homework_id DESC";
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
