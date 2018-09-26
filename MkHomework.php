<?php session_start(); 
function create_uuid($prefix = ""){    //可以指定前缀
    $str = md5(uniqid(mt_rand(), true));   
    $uuid  = substr($str,0,8);   
    $uuid .= substr($str,8,4);   
    $uuid .= substr($str,12,4);   
    $uuid .= substr($str,16,4);   
    $uuid .= substr($str,20,12);   
    return $prefix . $uuid;
	
}
$uuid = 'hw_'.create_uuid();


?>
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
//不是老师
if(isset($_SESSION['Uuser_type'])&& $_SESSION["Uuser_type"]!="teacher"){
	echo "window.location.href = 'Homework.php';\n";
}
?>

};
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>布置作业</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta content="yes" name="apple-mobile-web-app-capable" />
<link href="styles/NewGlobal.css" rel="stylesheet" />
<script type="text/javascript" src="Scripts/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="layui/prismTemplete.js"></script>
<script src="layui/layui.js"></script>
<script type="text/javascript" src="MkHomework.js"></script>
<link rel="stylesheet" href="layui/css/layui.css"  media="all">
</head>
<body>

<div class="container scene">
  <div class="header">
    <div class="title" id="titleString">布置作业</div>
	<?php
		if(isset($_SESSION['Uuser_type'])&& $_SESSION["Uuser_type"]=="teacher"){
			echo '	<a href="MkHomework.php" class="back ">
							<span class="header-icon header-icon-return"></span>
							<span class="header-name">布置作业</span>
					</a>';
		}
	?>
  </div>

  <ul class="unstyled hotel-bar">
    <li class="first"> <a data-bar="mk" class="active">创建</a> </li>
    <li><a data-bar="gl">管理</a></li>
	<li><a data-bar="fh">返回</a></li>
  </ul>
  <div id="mk" class="tab pt20">
    <form id="mkfrm" class="layui-form layui-form-pane" onsubmit="return false;" action="xx">
      <?php
	echo "<input type='hidden' name='uuid' id='uuid' value='$uuid'>\n";
	echo "<input type='hidden' name='user_id' value='$_SESSION[Uuser_id]'>\n";
	echo "<input type='hidden' name='openid' value='$_SESSION[openid]'>\n";

	?>
      <div class="layui-form-item">
        <label class="layui-form-label">作业标题</label>
        <div class="layui-input-block">
          <input type="text" name="homework_title" lay-verify="title" autocomplete="off" placeholder="请输入作业标题" class="layui-input">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">主题图片</label>
        <div class="layui-input-block">
          <button type="button" class="layui-btn" id="test1">上传图片</button>
          <div class="layui-upload-list"> <img class="layui-upload-img" height="70" id="demo1">
            <input type="hidden" name="homework_title_img" id="homework_title_img"/>
            <p id="demoText"></p>
          </div>
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">学科</label>
        <div class="layui-input-block">
          <select name="homework_type"  lay-filter="homework_type" id="homework_type">
            <?php 
$def_subject = $_SESSION['Uteacher_type'];
include "data/subject.php";
?>
          </select>
        </div>
      </div>
      <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">作业内容</label>
        <div class="layui-input-block">
          <textarea class="layui-textarea" name="homwwork_info" id="LAY_demo1" style="display: none"></textarea>
        </div>
      </div>
      <div class="layui-form-item">
        <div class="layui-input-block">
          <button class="layui-btn" lay-submit="" lay-filter="mk_btn">立即提交</button>
          <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
      </div>
    </form>
  </div>
  <div id="gl" class="none tab">
    <ul class="unstyled roomlist" id="list" data-method="grid" data-exp="d" data-map="map">
      <li>
        <div class="roomtitle">
          <div class="roomname" data-exp="map.homework_title"></div>
          <div class="fr"> <em class="orange roomprice"> 共<span data-exp="map.homework_follow"></span>人签到 </em>
            <button class="layui-btn layui-btn-sm" data-exp="map.homework_id" data-method="attr" data-attr="homework_id">删除</button>
          </div>
        </div>
        <img data-exp="map" data-method="img" src="Images/timg.jpg" width="100">
		<div data-exp="map.homework_date"></div>
		</li>
    </ul>
  </div>
</div>
<?php
require_once "WeiXin_reg.php";
?>
</body>
</html>
