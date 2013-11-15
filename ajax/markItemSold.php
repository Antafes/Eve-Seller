<?php
require_once(__DIR__.'/../lib/config.default.php');
require_once(__DIR__.'/../lib/util/mysql.php');

if ($_GET['orderId'] && $_GET['amount'])
{
	$order = \Model\Order::getOrderById($_GET['orderId']);

	if ($_GET['amount'] <= $order->getAmount() - $order->getAmountSold())
	{
		$order->sell($_GET['amount']);
		echo json_encode('ok');
	}
	else
		echo json_encode('amountTooHigh');
}