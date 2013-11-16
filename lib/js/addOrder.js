$(function() {
	$('.setSellingForUser').children('a').click(function() {
		var name = $(this).data('username');
		$('#orderSellingForUser').val(name);
	});
	$('#tabs').tabs({
		active: activeTab
	});
});