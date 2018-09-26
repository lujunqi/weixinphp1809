<?php
class WeiXin1809 {
	private $appid = "wx627f086f1403f471";
	private  $secret = "ed9ba0636ae683b10fb31efaa10ee9f9";
	public function getUser(){

		$appid = $this->appid;
		$secret = $this->secret;
		if(!isset($_SESSION['openid'])){//session中获取openid
			$data = json_decode(file_get_contents("weixin_1809.txt"));
			if ($data->refresh_token_time > time()) { // 根据 refresh_token获取 token和openid
				$refresh_token = $data->refresh_token;
				$oauth2Url = "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=$appid&grant_type=refresh_token&refresh_token=$refresh_token";
				$oauth2 = $this->getJson($oauth2Url);
			}else{ //根据code 获取 token和openid
				$code = $_GET["code"];
				$oauth2Url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";
				
				$oauth2 = $this->getJson($oauth2Url);
	
				if(isset($oauth2["errcode"])){//第二次code
					$code = $_GET["code"];
					$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
					header("Location: https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$url&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect ");
					return;
				}
			}
			
			$access_token = $oauth2["access_token"];  
			$openid = $oauth2['openid']; 
		
			$get_user_info_url = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";
			$userinfo = $this->getJson($get_user_info_url);
			$nickname = $userinfo['nickname'];
			$headimgurl = $userinfo['headimgurl'];
		
			// 保持 refresh_token信息
			$data->refresh_token_time = time() + 3600*24*20;
			$data->refresh_token = $oauth2["refresh_token"];
			$fp = fopen("weixin_1809.txt", "w");
			fwrite($fp, json_encode($data));
			fclose($fp);
			//保持session
			$_SESSION['openid'] = $openid;
			$_SESSION['nickname'] = $nickname;
			$_SESSION['headimgurl'] = $headimgurl;
			

			echo '//微信获得';
		}else{//openid在session中
			$openid = $_SESSION['openid'];
			$nickname = $_SESSION['nickname'];
			$headimgurl = $_SESSION['headimgurl'];
			echo '//session获得';
		}
		// 获取 用户数据库信息
		include 'data/Conn.php';
		$sql="select * from t_user where openid= '$openid'";
		mysqli_query($connect,'set names utf8');
		$result=mysqli_query($connect,$sql);
		$row = $result->fetch_assoc();
		$count=count($row);
		mysqli_close($connect);
		
		echo "phpdata['openid']='$openid';\n";
		echo "phpdata['nickname']= '$nickname';\n";
		echo "phpdata['headimgurl']= '$headimgurl';\n";
		

		
		if($count==0){
			// 调用注册页面
			echo "weiXinReg();\n";
			return;
		}else{
			$_SESSION['Uuser_id'] = $row['user_id'];
			$_SESSION['Uuser_type'] = $row['user_type'];
			$_SESSION['Ustudent_id'] = $row['student_id'];
			$_SESSION['Uteacher_type'] = $row['teacher_type'];
			
		}

	}
	
	private function getJson($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch);
		//echo $output;
		return json_decode($output, true);
	}

}
?>