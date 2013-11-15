$(function() {
	$('#filterOrders').change(function() {
		$(this).parent().submit();
	});
	$('.sold').children('a').click(function() {
		var element = $(this);
		var orderId = element.data('orderid');
		console.log(orderId);
		$('#soldDialog').dialog({
			modal: true,
			width: 400,
			open: function() {
				var row = element.parent().parent();
				var item = row.children('.item').text();
				var amount = parseInt(row.children('.amount').text());
				var amountSold = parseInt(row.children('.amountSold').text());

				$(this).find('.item').children('td:last').text(item);
				$(this).find('.offeredAmount').children('td:last').text(amount);
				$(this).find('.amountSold').children('td:last').text(amountSold);
				$(this).find('.amount').children('td:last').children('input').val(amount - amountSold);

				$(this).find('form').submit(function(e) {
					e.preventDefault();
					var amountToSell = parseInt($(this).find('.amount').children('td:last').children('input').val());
					var data = {
						orderId: orderId,
						amount: amountToSell
					};
					console.log(data);
					$.getJSON('ajax/markItemSold.php', data, function(response) {
						if (response === 'ok')
						{
							if (amountSold + amountToSell === amount)
								row.remove();
							else
								row.children('.amountSold').text(amountSold + amountToSell);

							$('#soldDialog').dialog('close');
						}
					});
				});
			},
			close: function() {
				$(this).find('form').unbind('submit');
				$(this).dialog('destroy');
			}
		});
	});
});