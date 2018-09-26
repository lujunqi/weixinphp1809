<?php
include 'Conn.php';

if( $_POST["type"] == "jj"){
	$id=$_POST["id"];
	$sql="select t.*,u.user_name,u.user_icon,u.user_tel,DATE_FORMAT(homework_date,'%Y-%m-%d') n_homework_date from t_homework t,t_user u where u.user_id=t.user_id and homework_id=$id";
	slt($connect,$sql);
}
if( $_POST["type"] == "qd"){
	$id=$_POST["id"];
	$sql="
SELECT
	u.user_id,
	u.user_icon,
	u.user_name,
	u.student_id 
FROM
	t_homework_follow hf,
	t_user u 
WHERE
	hf.user_id = u.user_id 
AND hf.homework_id = $id
ORDER BY hf.ID
	";
	slt($connect,$sql);
}
if( $_POST["type"] == "xx"){
	$id = $_POST['id'];
$sql="
SELECT
	u.user_id,
	user_icon,
	u.user_name,
	hi.homework_info_id,
	hi.homework_info_title,
	hi.homework_info,
	DATE_FORMAT( homework_info_date, '%Y-%m-%d' ) homework_info_date 
FROM
	t_user u,
	t_homework_info hi 
WHERE
	hi.user_id = u.user_id
and	hi.homework_id = $id
 order by homework_info_id desc 
";
	slt($connect,$sql);
}


if( $_POST["type"] == "dqd"){
	$homework_id=$_POST["homework_id"];
	$user_id=$_POST["user_id"];
	$sql = "insert into t_homework_follow(user_id,homework_id)values($user_id,$homework_id)";
	mysqli_query($connect,'set names utf8');
	mysqli_query($connect,$sql);
	mysqli_close($connect);
	echo '{}';
}
function slt($connect,$sql){
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
}


?>
