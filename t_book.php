<?php

$appid = "wx627f086f1403f471";
$appsecret = "ed9ba0636ae683b10fb31efaa10ee9f9";
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
$data = json_decode(file_get_contents("weixin_1809.txt"));

	$output = https_request($url);
	echo "$output 8\n";
	$jsoninfo = json_decode($output, true);
	$access_token = $jsoninfo["access_token"];

}
echo "$access_token 12\n";
/*
$jsonmenu = '{
      "button":[
      {
            "name":"天气预报",
           "sub_button":[
            {
               "type":"click",
               "name":"北京天气",
               "key":"天气北京"
            },
            {
               "type":"click",
               "name":"上海天气",
               "key":"天气上海"
            },
            {
               "type":"click",
               "name":"广州天气",
               "key":"天气广州"
            },
            {
               "type":"click",
               "name":"深圳天气",
               "key":"天气深圳"
            },
            {
                "type":"view",
                "name":"本地天气",
                "url":"http://m.hao123.com/a/tianqi"
            }]
      

       },
       {
           "name":"方倍工作室",
           "sub_button":[
            {
               "type":"click",
               "name":"公司简介",
               "key":"company"
            },
            {
               "type":"click",
               "name":"趣味游戏",
               "key":"游戏"
            },
            {
                "type":"click",
                "name":"讲个笑话",
                "key":"笑话"
            }]
       

       }]
 }';
*/

$jsonmenu = '{
     "button":[
     {    
        "type":"click",
        "name":"今日歌曲",
         "key":"V1001_TODAY_MUSIC" },
    {     "name":"菜单",
        "sub_button":[
        {            
            "type":"view",
            "name":"搜索",
            "url":"http://www.soso.com/"},
             {
        "type":"click",
        "name":"赞一下我们",
        "key":"V1001_GOOD"
           }]
 }],
"matchrule":{
  "tag_id":"102"
  }
}';

//$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
$url = "https://api.weixin.qq.com/cgi-bin/menu/addconditional?access_token=$access_token";

$result = https_request($url, $jsonmenu);
echo "$result \n";
//var_dump($result);

function https_request($url,$data = null){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}

?>