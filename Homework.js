
layui.use(['form'], function(){
  
  init();
  php();
});
function init(){
	var req = {};
	$.post("../data/Homework.php", req, function(data) {
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
		cmd.preview($("#list"));
	}, "json");
}
function func_href(id){
    window.location.href = "InfoHomework.php?homework_id="+id;
}