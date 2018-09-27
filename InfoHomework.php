<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
var phpdata = {};
function php(){

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
  <div class="container">
    <div id="jj" class="tab">
      <div class="hotel-prompt "> 
        <div id="slider" style="margin-top: 10px;">
          <div style="color:#099145; text-align:center;">
            <h3 v_key="homework_title" ></h3>
            <p v_key="homework_type" style="text-align:right;"></p>
            <p v_key="n_homework_date" style="text-align:right;"></p>
          </div>
        </div>
      </div>
      <div class="hotel-prompt "> 
        <p v_key="homework_info"></p>
      </div>
    </div>  
  </div>
</div>

<div class="footer">
  <div class="gezifooter">
    <p style="color:#bbb;"> 版权所有</p>
  </div>
</div>
</body>
</html>
