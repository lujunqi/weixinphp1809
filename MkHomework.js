
layui.use(['form','upload','layedit'], function(){
  

  init();
  php();
  mk();
  add();
});
function add(){
	var layedit = layui.layedit;
	var form = layui.form;
	form.on('submit(mk_btn)', function (data) {
		var param = $(data.field)[0];
		param["homework_info"] = layedit.getContent(homwwork_info_index);
		layer.msg('加载中', {icon: 16 ,shade: 0.01});
		var url = $("#mkfrm").attr("action");
		$.post(url,param,function(data){
			layer.closeAll();
			window.location.href='MkHomework.php';
		});
	});
};
function init(){
	var form = layui.form;
	$("#demo1").attr("src","Images/"+ hexencode($("#homework_type").val())+".jpg");
	$("#homework_title_img").val("Images/"+ hexencode($("#homework_type").val())+".jpg");
	$("#homework_title").val(new Date().Format("yyyy-MM-dd")+$("#homework_type").val()+"作业");
	form.on('select(homework_type)', function(data){
		if($("#demo1").attr("data-up")!="true"){
			$("#demo1").attr("src","Images/"+ hexencode($("#homework_type").val()) +".jpg");
			$("#homework_title_img").val("Images/"+ hexencode($("#homework_type").val()) +".jpg");
			
		}
		$("#homework_title").val(new Date().Format("yyyy-MM-dd")+$("#homework_type").val()+"作业");
	});
	$("[data-bar]").click(function(){
   		$(".active",".hotel-bar").removeClass("active");
		$(this).addClass("active");
		key = $(this).attr("data-bar");
		$(".tab").hide();
		$("#"+key).show();
		tab[key]();
		
	});
}
function hexencode(str){
　　　　var val="";
	   
　　　　for(var i = 0; i < str.length; i++){
　　　　　　if(val == "")
　　　　　　　　val = str.charCodeAt(i).toString(16);
　　　　　　else
　　　　　　　　val += "" + str.charCodeAt(i).toString(16);
　　　　}
　　　　return val;
}
var tab = {};
tab["mk"]=function(){
	$("#mkfrm").attr("action","data/add_Homework.php");
	$("#mk_btn").html("新增");
};
tab["fh"]=function(){
	window.location.href='Homework.php';
};

tab["gl"]=function(){
	var req = {};
	req["openid"] = phpdata['openid'];
	$.post("../data/MyHomework.php", req, function(data) {
		var cmd = new prismTemplete();
		cmd.data("d", data);
		cmd.data("img", function(ele, val) {
			if(val.homework_title_img!=null){
				ele.attr("src",val.homework_title_img);
			}
		});
		cmd.data("href", function(ele, val) {
			ele.attr("href","javascript:func_href("+val.homework_id+");");	
		});
		cmd.data("mod", function(ele, val) {
			ele.attr("data-val",JSON.stringify(val));
		});
		cmd.preview($("#list"));
		$("[mod]").click(function(){
			var val = $(this).attr("data-val");
			$("[data-bar='mk']").trigger("click");
			$("#mkfrm").attr("action","data/upt_Homework.php");
			$("#mk_btn").html("修改");
			var form = layui.form;
			form.val("mkfrm", JSON.parse(val));
//			homework_info
		$("#LAY_demo1").val("val.homework_info");
//			$("#homework_title").val("cccccccccccc");
			var j = JSON.parse(val);
			
			console.log(val);
			
		});
		$("[view]").click(function(){
				var homework_id = $(this).attr("homework_id");
			//	window.location.href='InfoHomework.php?homework_id='+homework_id;
			var perContent = layer.open({type: 2,
					    maxmin: true,
			   content: 'InfoHomework.php?homework_id='+homework_id
			});	
			 layer.full(perContent);
		});
		$("[del]").click(function(){
			var homework_id = $(this).attr("homework_id");

			layer.confirm('您是否删除？', function(){
			  $.post("data/del_homework.php",{"homework_id":homework_id},function(data){
			  	tab["gl"]();
				layer.closeAll();
			  });
			}, function(){
			  
			});
		});
	}, "json");

}
var homwwork_info_index = "";
function mk(){
   var layedit = layui.layedit;
    layedit.set({
	uploadImage: {
			url: 'up_file.php?uuid='+$("#uuid").val()
		  , type: 'post' //默认post
		}
   });

   var upload = layui.upload;
   homwwork_info_index = layedit.build('LAY_demo1',{
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
   
//普通图片上传
  var uploadInst = upload.render({
    elem: '#test1'
    ,url: 'up_file.php?uuid='+$("#uuid").val()
    ,before: function(obj){
      //预读本地文件示例，不支持ie8
      obj.preview(function(index, file, result){
        $('#demo1').attr('src', result); //图片链接（base64）
      });
    }
    ,done: function(res){
      //如果上传失败
      if(res.code > 0){
        return layer.msg('上传失败');
      }
	  $("#homework_title_img").val(res.data.src);
      //上传成功
	  $("#demo1").attr("data-up","true");
    }
    ,error: function(){
      //演示失败状态，并实现重传
      var demoText = $('#demoText');
      demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
      demoText.find('.demo-reload').on('click', function(){
        uploadInst.upload();
		
      });
    }
  });
}