layui.use(['form','element','layedit'], function(){

  init();
  php();
});

function init(){
	php();
	dqd();
	$("[data-bar]").click(function(){
		var k = $(this).attr("data-bar");
		$("[data-bar]").removeClass("active");
		$(this).addClass("active");
		$(".tab").hide();
		$("#"+k).show();
		
		dtbar[k]();
	});
	$("[data-bar='jj']").trigger("click");
}
function dqd(){
	$("#dqd").click(function(){
		if($("[qd_user_id='"+ phpdata["user_id"]+"']").length!=0){
			layer.alert("已经签到");
			return;
		}
		var  req = {};
		req["type"] = "dqd";
		req["homework_id"] = $.getUrlParam("homework_id");
		req["user_id"] = phpdata["user_id"];
		
		json(req,function(data){
			$("[data-bar='qd']").trigger("click");
		});
	});
}
var dtbar = {};
dtbar["fh"] = function(){
	window.location.href='Homework.php';
};
dtbar["xx"] = function(){
	var  req = {};
	req["type"] = "xx";
	req["id"] = $.getUrlParam("homework_id");
	json(req,function(data){

		//数据
		var cmd = new prismTemplete();
		cmd.data("d", data);
		cmd.data("title", function(e,v){
		
		   if(v.user_id==phpdata["user_id"]){
			   e.html(v.homework_info_title+"   <span class=\"layui-badge-dot\" style=\"margin-left: 3px;\"></span>");
		   }else{
			   e.html(v.homework_info_title);
		   }
									   
	   });
		cmd.data("img", function(e,v){
			e.attr("src",v);
		});
		cmd.data("del", function(e,v){
			if(v.user_id==phpdata["user_id"]){
				e.attr("hi_id",v.homework_info_id);
				e.show();
			}
		});
		cmd.preview($("#xxList"));
		$("[hi_id]").click(function(){delHwinfo($(this).attr("hi_id"));});
		var element = layui.element;
		element.init();
	});
	$("#sayHomework").click(function(){
		var perContent= layer.open({
		  type: 1, 
		  title:"我要说话",
		  maxmin: true,
		  success: function(layero, index){
			  addHwinfo();
		  },
		  content: $("#sayHomeworkWin") //这里content是一个普通的String
		});
		layer.full(perContent);
		
	});
};
function delHwinfo(id){
	layer.confirm('您是否删除？', function(){
		$.post("data/del_HomeworkInfo.php",{"hi_id":id},function(){
			$("[data-bar='xx']").trigger("click");
			layer.closeAll();
		});
	});
}
function addHwinfo(){
	var layedit = layui.layedit;
	var form = layui.form;
	var homwwork_info_index = layedit.build('LAY_demo1',{
		tool: [
		  'strong' //加粗
		  ,'italic' //斜体
		  ,'underline' //下划线
		  ,'del' //删除线
		  ,'|' //分割线
		  ,'left' //左对齐
		  ,'center' //居中对齐
		  ,'right' //右对齐
		  ,'link' //超链接
		  ,'unlink' //清除链接
		  ,'image' //插入图片
		]});
	
	form.on('submit(add_homework_info_btn)', function (data) {
		var param = $(data.field)[0];
		param["homework_info"] = layedit.getContent(homwwork_info_index);
		param["homework_id"] = $.getUrlParam("homework_id");
		param["user_id"] =  phpdata["user_id"];
		
		layer.msg('加载中', {icon: 16 ,shade: 0.01});
		$.post("data/add_HomeworkInfo.php",param,function(data){
			layer.closeAll();
			$("[data-bar='xx']").trigger("click");
		});
	});
}
dtbar["jj"] = function(){
	var  req = {};
	req["type"] = "jj";
	req["id"] = $.getUrlParam("homework_id");
	json(req,function(data){
		var v = data[0];
		if(v!=null){		
			
			$("[v_key]").each(function(){
				var key = $(this).attr("v_key");
				var attr = $(this).attr("v_attr");
				
				if(attr==undefined){
					$(this).html(v[key]);
				}else{
					$(this).attr(attr,v[key]);
				}
				
			});
		}
	});
};
dtbar["qd"] = function(){
	var  req = {};
	req["type"] = "qd";
	req["id"] = $.getUrlParam("homework_id");
	json(req,function(data){
		$("#dqd").html("签到("+data.length+")");
		//数据
		var cmd = new prismTemplete();
		cmd.data("d", data);
		cmd.data("img", function(ele, val) {
			if(val.user_icon!=null){
				ele.attr("src",val.user_icon);
			}
		});
		cmd.data("parent", function(ele, val) {
			ele.attr("qd_user_id",val.user_id);
			ele.html(val.user_name);
		});
		cmd.data("student", function(ele, val) {
			
			var stu_ids = val["student_id"].split(",");
			var html = "";
			for(var i=0;i<stu_ids.length;i++){
				
				var stu_name = $("option[value='"+stu_ids[i]+"']","#reg_students").html();

				html +="<span class='dq_stu layui-badge layui-bg-orange' style='margin:1px;'>"+stu_name+"</span>";
			}
			ele.html(html);
		});
		cmd.preview($("#qdList"));

		if(data.length>0){
			
			minigrid('.grid', '.grid-item', 6, null, 
			  function(){
			  }
			);
		}

	});

};
function json(req,func){
	$.post("data/InfoHomework.php", req, function(data) {
		if(data!=null){
			
			func(data);
			
		}
	}, "json");
}