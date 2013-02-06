if ($.fn.pagination){
	$.fn.pagination.defaults.beforePageText = 'Halaman';
	$.fn.pagination.defaults.afterPageText = 'dari {pages}';
	$.fn.pagination.defaults.displayMsg = 'Menampilkan {from} s/d {to} dari {total} data';
}
if ($.fn.datagrid){
	$.fn.datagrid.defaults.loadMsg = 'Sedang diproses, harap menunggu ...';
}
if ($.fn.treegrid && $.fn.datagrid){
	$.fn.treegrid.defaults.loadMsg = $.fn.datagrid.defaults.loadMsg;
}
if ($.messager){
	$.messager.defaults.ok = 'Ok';
	$.messager.defaults.cancel = 'Batal';
}
if ($.fn.validatebox){
	$.fn.validatebox.defaults.missingMessage = 'Field ini diperlukan.';
	$.fn.validatebox.defaults.rules.email.message = 'Harap masukkan alamat email yang valid.';
	$.fn.validatebox.defaults.rules.url.message = 'Harap masukkan URL yang valid.';
	$.fn.validatebox.defaults.rules.length.message = 'Harap masukkan sebuah nilai antara {0} dan {1}.';
	$.fn.validatebox.defaults.rules.remote.message = 'Please fix this field.';
}
if ($.fn.numberbox){
	$.fn.numberbox.defaults.missingMessage = 'Field ini diperlukan.';
}
if ($.fn.combobox){
	$.fn.combobox.defaults.missingMessage = 'Field ini diperlukan.';
}
if ($.fn.combotree){
	$.fn.combotree.defaults.missingMessage = 'Field ini diperlukan.';
}
if ($.fn.combogrid){
	$.fn.combogrid.defaults.missingMessage = 'Field ini diperlukan.';
}
if ($.fn.calendar){
	$.fn.calendar.defaults.weeks = ['M','S','S','R','K','J','S'];
	$.fn.calendar.defaults.months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
}
if ($.fn.datebox){
	$.fn.datebox.defaults.currentText = 'Hari Ini';
	$.fn.datebox.defaults.closeText = 'Tutup';
	$.fn.datebox.defaults.okText = 'Ok';
	$.fn.datebox.defaults.missingMessage = 'Field ini diperlukan.';
}
if ($.fn.datetimebox && $.fn.datebox){
	$.extend($.fn.datetimebox.defaults,{
		currentText: $.fn.datebox.defaults.currentText,
		closeText: $.fn.datebox.defaults.closeText,
		okText: $.fn.datebox.defaults.okText,
		missingMessage: $.fn.datebox.defaults.missingMessage
	});
}
