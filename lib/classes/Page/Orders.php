<?php
namespace Page;

/**
 * Description of Orders
 *
 * @author Neithan
 */
class Orders extends \Page
{
	/**
	 * @var \Orders
	 */
	protected $orders;

	function __construct()
	{
		parent::__construct('orders');

		$this->orders = new \Orders($_SESSION['userId'], $_GET['orderBy']);
	}

	/**
	 * Process possibly entered data of the page.
	 */
	public function process()
	{
		$this->template->loadJs('orders');
		$this->template->assign('sellingForList', $this->orders->getSellingForList());
		$this->template->assign('orders', $this->orders->getOrderList());

		if (!$_GET['filterOrders'])
			return;

		$this->template->assign(
			'orders',
			\Orders::getOrdersBySellingFor(
				$_SESSION['userId'], $_GET['filterOrders'], $_GET['orderBy']
			)
		);
	}

	public function render()
	{
		parent::render();
	}
}
