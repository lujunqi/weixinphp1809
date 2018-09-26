layui.define("form", function(exports) {
	var MOD_NAME = "multiSelect",
		o = layui.jquery,
		form = layui.form;

	o('select[multiple]').each(function() {
		var t = o(this),
			s = t.next();

		// 初始化渲染下拉项
		s.find('.layui-anim dd').each(function() {
			var dt = o(this),
				checked = dt.hasClass('layui-this') ? 'checked' : '',
				title = dt.text(),
				disabled = dt.attr('lay-value') === '' ? 'disabled' : '';

			dt.html('<input type="checkbox" lay-skin="primary" title="' + title + '" ' + checked + ' ' + disabled + '>');
		})

		form.render('checkbox');

		s.find('dd').click(function() {
			var dt = o(this),
				st = dt.parents('.layui-form-select'),
				val = dt.attr('lay-value'),
				status = dt.find('.layui-form-checkbox').hasClass('layui-form-checked');
			// 禁止下拉框收回
			st.addClass('layui-form-selected');
			// 禁止行选中
			dt.removeClass('layui-this');
			// 处理下拉元素真实值
			if(val !== '') {
				t.find('option[value=' + val + ']').prop('selected', status);
			}
			// 显示选择项
			var arr = [];
			dt.parent().find('.layui-form-checkbox').each(function() {
				if(!o(this).parents('dd').hasClass('layui-select-tips') && o(this).hasClass('layui-form-checked')) {
					arr.push(o(this).find('span').text());
				}
			})
			dt.parent().prev().find('input').val(arr.join(','));

		}).find('.layui-form-checkbox').css({
			'width': '100%'
		})
	})

	exports(MOD_NAME)
});