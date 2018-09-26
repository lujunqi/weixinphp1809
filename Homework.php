<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript">
var phpdata = {};
function php(){
<?php
require_once "WeiXin1809.php";
$wx = new WeiXin1809();
$wx->getUser();
?>

};
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>家庭作业</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta content="yes" name="apple-mobile-web-app-capable" />
<link href="styles/NewGlobal.css" rel="stylesheet" />
<script type="text/javascript" src="Scripts/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="layui/prismTemplete.js"></script>
<script src="layui/layui.js"></script>
<script type="text/javascript" src="Homework.js"></script>
<link rel="stylesheet" href="layui/css/layui.css"  media="all">
</head>
<body>
<input id="homework_id" type="hidden" />
<div id="weixin_homework" class="scene">
  <div class="header">
    <div class="title" id="titleString">家庭作业</div>
	<?php
		if(isset($_SESSION['Uuser_type'])&& $_SESSION["Uuser_type"]=="teacher"){
			echo '	<a href="MkHomework.php" class="back ">
							<span class="header-icon header-icon-return"></span>
							<span class="header-name">布置作业</span>
					</a>';
		}
	?>
  </div>
  <div class="container width90" id="activitys">
    <ul class="unstyled activitylist" id="list" data-method="grid" data-exp="d" data-map="map">
      <li> <a data-exp="map" data-method="href" > <img data-exp="map" data-method="img" src="Images/timg.jpg" width="100"/>
        <p>【<span data-exp="map.homework_type"></span>】<span data-exp="map.homework_title"></span>（<em data-exp="map.homework_date"></em>） </p>
        </a> </li>
    </ul>
  </div>
  <div class="container none" id="news">
    <ul class="unstyled hotel-bar">
      <li class="first"> <a data-key="jj" class="active">简介</a> </li>
      <li><a data-key="ls">老师</a></li>
      <li><a data-key="qd">签到</a></li>
      <li><a data-key="gj">跟进</a></li>
    </ul>
    <div id="jj" class="tab">
      <div class="hotel-prompt "> <span class="hotel-prompt-title">作业标题</span>
        <div id="slider" style="margin-top: 10px;">
          <div style="color:#099145; text-align:center;">
            <h3 id="homework_title" ></h3>
            <p id="homework_type" style="text-align:right;"></p>
            <p id="n_homework_date" style="text-align:right;"></p>
          </div>
        </div>
      </div>
      <div id="hotelinfo" class="hotel-prompt "> <span class="hotel-prompt-title">作业介绍</span>
        <p id="homework_info"></p>
      </div>
    </div>
    <div id="ls" class="tab">
      <div id="BookRoom" class="tab-pane active fade in">
        <div class="detail-address-bar"> <img alt="" width="40" id="user_icon" src="Images/coupon_icon4.png">
          <p id="user_name"></p>
        </div>
        <div id="datetab" class="detail-time-bar"> <img alt="" src="Images/coupon_icon5.png">
          <p id="user_tel"></p>
          <span class="icon-down"></span> </div>
        <ul class="unstyled roomlist" id="teacher_list" data-method="grid" data-exp="d" data-map="map">
          <li>
            <div class="roomtitle">
              <div class="roomname" data-exp="map.homework_title"></div>
              <div class="fr"> <em class="orange roomprice"  data-exp="map.n_homework_date"> </em> <a data-method="href" data-exp="map" class='btn btn-success iframe'></a> </div>
            </div>
            <img data-exp="map" data-method="img" src="Images/timg.jpg" width="100"/> </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<?php
require_once "WeiXin_reg.php";
?>
<div class="footer">

  <div class="gezifooter">
    <p style="color:#bbb;"> 版权所有</p>
  </div>
</div>
</body>
</html>
