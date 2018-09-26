<?php session_start(); ?>
<!DOCTYPE html>
<html lang="zh">
<head>
<script type="text/javascript">
var phpdata = {};
function php(){
<?php
require_once "WeiXin1809.php";
$wx = new WeiXin1809();
$wx->getUser();
$user_id = $_SESSION['Uuser_id'];
echo "phpdata['user_id'] = '$user_id';\n";
?>

};
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>家庭作业</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta content="yes" name="apple-mobile-web-app-capable" />
<link href="styles/NewGlobal.css" rel="stylesheet" />
<script type="text/javascript" src="Scripts/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="Scripts/minigrid.js"></script>
<script type="text/javascript" src="layui/prismTemplete.js"></script>
<script src="layui/layui.js"></script>
<script type="text/javascript" src="InfoHomework.js"></script>
<link rel="stylesheet" href="layui/css/layui.css"  media="all">
<style type="text/css">
.grid {
		  position: relative;
		  /* fluffy */
		  margin: 0 auto;
		  
		  /* end fluffy */
		}

.grid-item {
position: absolute;
top: 0;
left: 0;
border-width: 1px;
border-style: solid;
border-color: #e6e6e6;
/* fluffy */
width: 30%;
min-height:130px;

border-radius: 3px;
text-align:center;

/* end fluffy */
-webkit-transition: .3s ease-in-out;
-o-transition: .3s ease-in-out;
transition: .3s ease-in-out;

}

</style>
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
  <ul class="unstyled hotel-bar">
    <li class="first"> <a data-bar="jj" class="active">简介</a> </li>
    <li><a data-bar="qd">签到</a></li>
    <li><a data-bar="xx">信息</a></li>
    <li><a data-bar="fh">返回</a></li>
  </ul>
  <div class="container">
    <div id="jj" class="tab">
      <div class="hotel-prompt "> <span class="hotel-prompt-title">作业标题</span>
        <div id="slider" style="margin-top: 10px;">
          <div style="color:#099145; text-align:center;">
            <h3 v_key="homework_title" ></h3>
            <p v_key="homework_type" style="text-align:right;"></p>
            <p v_key="n_homework_date" style="text-align:right;"></p>
          </div>
        </div>
      </div>
      <div class="hotel-prompt "> <span class="hotel-prompt-title">主题</span>
        <div id="slider" style="margin-top: 10px;">
          <div style="color:#099145; text-align:center;"> <img v_key="homework_title_img" width="141" v_attr="src" src="Images/timg.jpg" /> </div>
        </div>
      </div>
      <div class="hotel-prompt "> <span class="hotel-prompt-title">作业介绍</span>
        <p v_key="homework_info"></p>
      </div>
    </div>
    <div id="qd" class="tab none">
      <div class="hotel-prompt "> <span class="hotel-prompt-title " id="dqd">签到</span>
        <div id="qdList" class="grid" style="margin-top: 10px;" data-method="grid" data-exp="d" data-map="map">
          <div class="grid-item"> <img data-method="img" data-exp="map" style=" border-radius: 50%; margin-top:10px; width:80%" />
            <div style=" font-size:1em; color:#099145;">
              <div data-method="parent" data-exp="map"></div>
              <div style="text-align:right;" data-exp="map" data-method="student">XX</div>
            </div>
          </div>
        </div>
        <div style="clear:both"></div>
      </div>
    </div>
    <div id="xx" class="tab none">
      <div class="layui-collapse" lay-accordion data-method="grid" data-exp="d" data-map="map"  id="xxList">
        <div class="layui-colla-item">
          <h2 class="layui-colla-title" ><span data-method="title" data-exp="map"></span> </h2>
          <div class="layui-colla-content" >
            <div>
              <div style="float:left"><img width="40" style="border-radius:50%;" data-exp="map.user_icon" data-method="img" /><span data-exp="map.user_name"></span></div>
              <div style="float:right"><i class="layui-icon none" data-exp="map" data-method="del" ></i></div>
            </div>
            <div  style="clear:both; height:5px;"></div>
            <div data-exp="map.homework_info"></div>
          </div>
        </div>
      </div>
      <div style="text-align:right; margin:5px;">
        <button class="layui-btn layui-btn-sm" id="sayHomework">我要说话</button>
        <div id="sayHomeworkWin" class="none">
          <form class="layui-form layui-form-pane" onSubmit="return false;" >
            <div class="layui-form-item">
              <label class="layui-form-label">标题</label>
              <div class="layui-input-block">
                <input type="text" name="homework_info_title"  placeholder="请输入标题" autocomplete="off" class="layui-input">
              </div>
            </div>
            <div class="layui-form-item layui-form-text">
              <label class="layui-form-label">内容</label>
              <div class="layui-input-block">
                <textarea class="layui-textarea" name="homwwork_info" id="LAY_demo1" style="display: none"></textarea>
              </div>
            </div>
            <div class="layui-form-item">
              <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="add_homework_info_btn">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
              </div>
            </div>
          </form>
        </div>
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
