<?php
/**
 * Description of MarketImport
 *
 * @author Neithan
 */
class MarketImport
{
	/**
	 * @var string
	 */
	protected $file;

	/**
	 * @var CSVParser
	 */
	protected $csvParser;

	function __construct($file)
	{
		$this->file = $file;
		$this->csvParser = new \CSVParser($this->file);
		$this->csvParser->parseCSV();
	}

	public function import()
	{
		$user = \User::getUserById($_SESSION['userId']);
		$csv = $this->csvParser->getData();
		$activeOrders = \Orders::getOrderIdList($_SESSION['userId']);

		$counter = array(
			'ordersTotal' => count($csv) - 1,
			'ordersCreated' => 0,
			'ordersUpdated' => 0,
		);
		for ($i = 1; $i < count($csv); $i++)
		{
			$row = $csv[$i];

			if (!\Model\Order::checkOrder($row['orderID']))
			{
				$createDatetime = DateTime::createFromFormat(
					'Y-m-d H:i:s.u', $row['issueDate'], new DateTimeZone('GMT')
				);
				$endDatetime = clone $createDatetime;
				$endDatetime->add(new DateInterval('P'.$row['duration'].'D'));
				$sellingForUser = $user->getName();

				if ($row['isCorp'] == 'True')
					$sellingForUser = 'Corporation';

				$order = \Model\Order::createOrder(
					$user, $row['typeID'], $row['volEntered'], $row['price'], $createDatetime,
					$endDatetime, $sellingForUser, $row['orderID']
				);
				$counter['ordersCreated']++;
			}
			else
				$order = \Model\Order::getOrderByEveOrderId($row['orderID']);

			if ($row['volEntered'] != $row['volRemaining'])
			{
				$sold = $row['volEntered'] - $row['volRemaining'];
				$order->sell($sold);
				$counter['ordersUpdated']++;

				if (in_array($order->getOrderId(), $activeOrders))
					unset($activeOrders[$order->getOrderId()]);
			}
		}

		foreach ($activeOrders as $orderId)
		{
			$order = \Model\Order::getOrderById($orderId);
			$order->sell($order->getAmount() - $order->getAmountSold());
		}

		return $counter;
	}
}