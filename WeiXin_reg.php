


<div id="weixin_reg" class="none scene">
  <div class="header">
    <div class="title" id="titleString">用户注册</div>
  </div>
  <div class="container  pt20">
    <form class="layui-form layui-form-pane" onsubmit="return false;" >
      <div class="layui-form-item">
        <label class="layui-form-label">身份</label>
        <div class="layui-input-block">
          <select name="user_type" lay-filter="user_type" lay-verify="required">
            <option  value="parent">家长</option>
            <option value="teacher">老师</option>
          </select>
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">姓名</label>
        <div class="layui-input-block">
          <input type="text" name="user_name" id="user_name" placeholder="请输入" autocomplete="off" class="layui-input">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">电话</label>
        <div class="layui-input-block">
          <input type="text" name="user_tel" id="user_tel" placeholder="请输入" autocomplete="off" class="layui-input">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">头像</label>
        <div class="layui-input-block" style="text-align:center"> <img width="70" style="border-radius:50%;" id="user_icon_img" />
          <input type="hidden" name="user_icon" id="user_icon">
          <input type="hidden" name="openid" id="openid">
        </div>
      </div>
      <div class="layui-form-item parent">
        <label class="layui-form-label">学生</label>
        <div class="layui-input-block">
          <select name="student_id" id="reg_students" xm-select="select1">
 <?php
require_once "data/Students.php";
$num = count($students); 
echo $num;
for($i=0;$i<$num;$i++){
	$stu_id = $students[$i]["student_id"];
	$stu_name = $students[$i]["student_name"];
	$stu_no = $students[$i]["student_no"];

	if(isset($stu_id)){
		echo "<option value=\"$stu_id\">$stu_name</option>\n";
	}
}
		  ?>

			
          </select>

        </div>
      </div>
      <div class="layui-form-item teacher">
        <label class="layui-form-label">任课</label>
        <div class="layui-input-block">
          <select name="teacher_type">
<?php
$def_subject = "";
include "data/subject.php";
?>
          </select>
        </div>
      </div>
      <div class="layui-form-item">
        <div class="layui-input-block">
          <button class="layui-btn" lay-submit="" lay-filter="weixin_reg">立即提交</button>
          <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
      </div>
    </form>
  </div>
  <link rel="stylesheet" href="layui/formSelects-v4.css" />

  <script type="text/javascript">
	layui.config({
		base: 'layui/',
	})
	layui.use(['multiSelect','formSelects']);
	
	function weiXinReg(){
		var form = layui.form;
		$(".scene").hide();
		$("#weixin_reg").show();
		$("#user_name","#weixin_reg").val(phpdata["nickname"]);
		$("#user_icon","#weixin_reg").val(phpdata["headimgurl"]);
		$("#openid","#weixin_reg").val(phpdata["openid"]);

		$("#user_icon_img","#weixin_reg").attr("src",phpdata["headimgurl"]);
		reg_check();
		form.on('select(user_type)', function(data){
			reg_check();
		});
		form.on('submit(weixin_reg)', function (data) {
			console.log($(data.field));
			$.post("data/add_user.php", $(data.field)[0],function(){
				window.location.reload();
			});
		});
	}
	
	function reg_check(){
		if($("[name='user_type']").val()=="teacher"){
			$(".teacher").show();
			$(".parent").hide();
		}else{
			$(".teacher").hide();
			$(".parent").show();
		}
		
	}
</script>
</div>

