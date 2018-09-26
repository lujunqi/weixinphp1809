<?php
if (($_FILES["file"]["size"] < 1000000)){
  if ($_FILES["file"]["error"] > 0){
	    echo "{\"code\": 1,\"msg\": \"服务器故障\",\"data\": {\"src\": \"\"}}";
    }else{
	
		$file_name = $_GET["uuid"].'_'.$_FILES["file"]["name"];
		if (!file_exists("upload/" . $file_name)){
		  move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $file_name);
		}
		echo "{\"code\": 0,\"msg\": \"成功\",\"data\": {\"src\": \"upload/" . $file_name . "\"}}";
    }
    

}else{
  echo "{\"code\": 1,\"msg\": \"文件过大\",\"data\": {\"src\": \"\"}}";
}
?>