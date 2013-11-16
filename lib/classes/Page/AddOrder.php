<?php
namespace Page;

/**
 * Description of AddOrder
 *
 * @author Neithan
 */
class AddOrder extends \Page
{
	protected $durations = array(
		'P1D' => 'oneDay',
		'P3D' => 'threeDays',
		'P7D' => 'oneWeek',
		'P14D' => 'twoWeeks',
		'P30D' => 'oneMonth',
		'P90D' => 'threeMonths',
	);

	public function __construct()
	{
		parent::__construct('addOrder');
	}

	public function process()
	{
		$this->template->loadJs('addOrder');

		if ($_POST['createOrder'])
		{
			$this->createOrder(
				$_POST['item'], $_POST['amount'], $_POST['price'], $_POST['sellingForUser'],
				$_POST['createDatetime'], $_POST['duration'], !!$_POST['saveSettings'],
				$_POST['createOrder']
			);
		}
		else
		{
			$this->importOrders($_FILES['marketLog'], $_POST['importOrders']);
		}
	}

	/**
	 * Create a new order.
	 *
	 * @param integer $itemId
	 * @param integer $amount
	 * @param float $price
	 * @param string $sellingForUser
	 * @param string $createDatetime
	 * @param string $duration
	 * @param boolean $saveSettings
	 * @param string $salt
	 */
	protected function createOrder($itemId, $amount, $price, $sellingForUser, $createDatetime,
		$duration, $saveSettings, $salt)
	{
		if (!$salt || $salt != $_SESSION['formSalts']['createOrder'])
			return;

		if (!$itemId || !$amount || !$price || !$sellingForUser || !$createDatetime || !$duration)
		{
			$this->template->assign('error', 'emptyFields');
			return;
		}

		$user = \User::getUserById($_SESSION['userId']);

		if ($saveSettings)
			$user->setOrderDuration($duration);

		$price = str_replace(',', '.', $price);
		$createDatetime = \DateTime::createFromFormat('U', strtotime($createDatetime));
		$endDatetime = clone $createDatetime;
		$endDatetime->add(new \DateInterval($duration));

		$order = \Model\Order::createOrder(
			$user, $itemId, $amount, $price, $createDatetime, $endDatetime, $sellingForUser
		);

		if ($order)
		{
			$this->template->assign('orderCreated', 'orderCreated');
			unset($_POST);
		}
	}

	/**
	 * Check and import an uploaded file.
	 *
	 * @param array  $file
	 * @param string $salt
	 */
	protected function importOrders($file, $salt)
	{
		if (!$salt || $salt != $_SESSION['formSalts']['importOrders'])
			return;

		if (!$file)
		{
			$this->template->assign('error', 'noFileSpecified');
			return;
		}

		$filename = __DIR__.'/../../tempFiles/'.$file['name'];
		move_uploaded_file($file['tmp_name'], $filename);
		$importer = new \MarketImport($filename);
		$result = $importer->import();
		unset($importer);
		unlink($filename);

		$translator = \Translator::getInstance();
		$successMessage = $translator->getTranslation('ordersTotal').': '.$result['ordersTotal'].'<br />';
		$successMessage .= $translator->getTranslation('ordersCreated').': '.$result['ordersCreated'].'<br />';
		$successMessage .= $translator->getTranslation('ordersUpdated').': '.$result['ordersUpdated'];
		$this->template->assign('ordersImported', $successMessage);
	}

	public function render()
	{
		$this->template->assign('user', \User::getUserById($_SESSION['userId']));
		$this->template->assign('durations', $this->durations);
		$this->template->assign('itemList', \Model\Item::getItemList());

		parent::render();
	}
}
