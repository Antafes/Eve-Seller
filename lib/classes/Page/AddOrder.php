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
		'P1W' => 'oneWeek',
		'P2W' => 'twoWeeks',
		'P1M' => 'oneMonth',
		'P3M' => 'threeMonths',
	);

	public function __construct()
	{
		parent::__construct('addOrder');
	}

	public function process()
	{
		$this->template->loadJs('addOrder');

		$this->createOrder(
			$_POST['item'], $_POST['amount'], $_POST['price'], $_POST['sellingForUser'],
			$_POST['createDatetime'], $_POST['duration'], $_POST['saveSettings'],
			$_POST['createOrder']
		);
	}

	protected function createOrder($item, $amount, $price, $sellingForUser, $createDatetime,
		$duration, $saveSettings, $salt)
	{
		if (!$salt || $salt != $_SESSION['formSalts']['createOrder'])
			return;

		if (!$item || !$amount || !$price || !$sellingForUser || !$createDatetime || !$duration)
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
			$user, $item, $amount, $price, $createDatetime, $endDatetime, $sellingForUser
		);

		if ($order)
		{
			$this->template->assign('orderCreated', 'orderCreated');
			unset($_POST);
		}
	}

	public function render()
	{
		$this->template->assign('user', \User::getUserById($_SESSION['userId']));
		$this->template->assign('durations', $this->durations);

		parent::render();
	}
}
