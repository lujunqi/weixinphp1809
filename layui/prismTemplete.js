var prismTemplete = function() {
	this.$prism__property = {};
	this.currentElement = null;
	this.html = function(obj, val) {
		this.currentElement = obj;
		obj.html(val);
		this.def(obj, val);
	};// html
	this.def = function(obj, val) {
		this.currentElement = obj;
		if (val == null) {
			var def = obj.attr("data-default");
			if (def != null) {
				obj.html(this.getValue(def));
			}
		}
	};// def默认
	this.hash = function(obj,val){
		this.currentElement = obj;
		var h1 = obj.attr("data-hash").split(",");
		var map = {};
		for(var i=0;i<h1.length;i++){
			var h2 = h1[i].split(":");
			map[h2[0]]=h2[1];			
		}
		obj.html(map[val]);
	};// 哈希
	/**layer UI控件定制 begin **/
	this.TEXT = function(obj, val) {
		obj.val(val);
	};//文本控件
	this.RADIO = function(obj, val) {

		$(":radio",obj).each(function(){
			 if($(this).val()==val){
				 $(this).attr("checked","checked");
			 }
		});
	};//单选框
	/**layer UI控件定制 end **/
	this.attr = function(obj, val) {
		this.currentElement = obj;
		var data_attr = obj.attr("data-attr");
		obj.attr(data_attr,val);
	};// 设置属性
	this.text = function(obj, val) {
		this.currentElement = obj;
		obj.text(val);
		this.def(obj, val);
	};// text
	this.val = function(obj, val) {
		this.currentElement = obj;
		obj.val(val);
	};// val
	this.format = function(obj, val) {
		this.currentElement = obj;
		var str = obj.html();
		for (m in val) {
			var re = new RegExp('\\{\\{' + m + '\\}\\}', 'gm');
			str = str.replace(re, val[m]);
		}
		obj.html(str);
	};// format
	this.list = function(obj, val) {// 废弃
		this.currentElement = obj;
		var map = obj.attr("data-map");
		if (obj.data("templete_prism_$$") == null) {
			obj.data("templete_prism_$$", obj.html());
		}
		obj.html("");
		this.$prism__property.map = [];
		for (i in val) {
			var list_templete = obj.data("templete_prism_$$");
			var $div = $("<div></div>");
			
			$div.html(list_templete);
			$("[data-exp]",$div).each(function(){
				var exp = $(this).attr("data-exp");
				var maps = exp.split(".");
				if($.inArray(map,maps)!=-1){
					maps.splice($.inArray(map,maps)+1,0,i);
				}
				$(this).attr("data-exp",maps.join("."));
			});
			obj.append($div.children());
			this.$prism__property.map.push(val[i]);
		}

	};// loop
	this.grid = function(obj, val) {
		this.currentElement = obj;
		var map = obj.attr("data-map");
		
		if (obj.data("templete_prism_$$") == null) {
			obj.data("templete_prism_$$", obj.html());
		}
		obj.html("");
		for (i in val) {
			
			var $cmd = new prismTemplete();
			var $templete = $(obj.data("templete_prism_$$"));
			var $div = $("<div></div>");
			$div.html($templete);
			for (key in this.$prism__property) {
				
				if (!$cmd[key]) {
					if (typeof this.$prism__property[key] == "function") {
						$cmd[key] = this.$prism__property[key];
						this[key] = function(obj, val) {
						};
					}
				}

			}
			//val[i]["_index"] = i;
			$cmd.data(map, val[i]);
			$cmd.preview($div);
			
			obj.append($div.html());
		}

	}// grid
	this.data = function(key, val) {
		this.$prism__property[key] = val;
	};// data

	this.preview = function($this) {
		var self = this;
		
		if ($this.attr("data-exp") != null) {
			var that = $this;
			var data_exp = that.attr("data-exp");
			var data_method = that.attr("data-method");
			var exp111 = data_exp.split(":");
			if(exp111.length==2){
				data_exp = exp111[1];
				data_method = exp111[0];
			}
			var val = self.getValue(data_exp);
			if (data_method == null) {
				data_method = "html";
			}
			self[data_method](that, val);
		}
		$("[data-exp]", $this).each(function() {
			var that = $(this);
			var data_exp = that.attr("data-exp");
			var data_method = that.attr("data-method");
			var exp111 = data_exp.split(":");
			if(exp111.length==2){
				data_exp = exp111[1];
				data_method = exp111[0];
			}
			var val = self.getValue(data_exp, that);
			if (data_method == null) {
				data_method = "html";
			}
			try {
				self[data_method](that, val);
			} catch (e) {
//				if (this.debug)
					console.log(data_method + "===" + e);
			}
		});
	};// preview
	this.debug = false;
	this.getValue = function(data_exp, that) {
		var self = this;
		var exps = data_exp.split(".");
		var val = null;
		try {
			for (i in exps) {
				var ex = exps[i];
				
				if (val == null) {
					val = self.$prism__property[ex];
				} else {
					val = val[ex];
				}
				if (typeof val == "function") {
					val = val(that);
				}
				if (val == null) {
					break;
				}
			}
		} catch (e) {
			if (this.debug) {
				console.log(e)
			}

			val = null;
		}
		return val;
	};// getValue
};
if (typeof define == "function") {
	define("prismTemplete", [], function() {
		return prismTemplete;
	});
}

String.prototype.replaceAll = function(s1, s2) {
	return this.replace(new RegExp(s1, "gm"), s2);
}

$.getUrlParam = function(name)
{
	var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
	var r = window.location.search.substr(1).match(reg);
	if (r!=null) return unescape(r[2]); return '';
};
// 对Date的扩展，将 Date 转化为指定格式的String
// 月(M)、日(d)、小时(h)、分(m)、秒(s)、季度(q) 可以用 1-2 个占位符， 
// 年(y)可以用 1-4 个占位符，毫秒(S)只能用 1 个占位符(是 1-3 位的数字) 
Date.prototype.Format = function (fmt) { //author: meizz 
    var o = {
        "M+": this.getMonth() + 1, //月份 
        "d+": this.getDate(), //日 
        "H+": this.getHours(), //小时 
        "m+": this.getMinutes(), //分 
        "s+": this.getSeconds(), //秒 
        "q+": Math.floor((this.getMonth() + 3) / 3), //季度 
        "S": this.getMilliseconds() //毫秒 
    };
    if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o)
    if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
    return fmt;
}
 
