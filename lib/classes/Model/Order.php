<?php
namespace Model;

/**
 * Description of Order
 *
 * @author Neithan
 */
class Order
{
	/**
	 * @var integer
	 */
	protected $orderId;

	/**
	 * @var integer
	 */
	protected $userId;

	/**
	 * @var string
	 */
	protected $item;

	/**
	 * @var integer
	 */
	protected $amount;

	/**
	 * @var integer
	 */
	protected $amountSold;

	/**
	 * @var float
	 */
	protected $price;

	/**
	 * @var float
	 */
	protected $sum;

	/**
	 * @var \DateTime
	 */
	protected $createDatetime;

	/**
	 * @var \DateTime
	 */
	protected $endDatetime;

	/**
	 * @var string
	 */
	protected $sellingForUser;

	/**
	 * Get an order by its id
	 *
	 * @param integer $id
	 * @return \self
	 */
	public static function getOrderById($id)
	{
		$sql = '
			SELECT
				*,
				price * amount AS sum
			FROM es_orders
			WHERE `orderId` = '.sqlval($id).'
				AND !deleted
		';
		$data = query($sql);

		$order = new self();
		$order->orderId        = intval($data['orderId']);
		$order->userId         = intval($data['userId']);
		$order->item           = $data['item'];
		$order->amount         = intval($data['amount']);
		$order->amountSold     = intval($data['amountSold']);
		$order->price          = floatval($data['price']);
		$order->sum            = floatval($data['sum']);
		$order->createDatetime = \DateTime::createFromFormat('Y-m-d H:i:s', $data['createDatetime']);
		$order->endDatetime    = \DateTime::createFromFormat('Y-m-d H:i:s', $data['endDatetime']);
		$order->sellingForUser = $data['sellingForUser'];

		return $order;
	}

	/**
	 * Create a new order.
	 *
	 * @param \User     $user
	 * @param string    $item
	 * @param integer   $amount
	 * @param float     $price
	 * @param \DateTime $createDatetime
	 * @param \DateTime $endDatetime
	 * @param string    $sellingForUser
	 * @return \self
	 */
	public static function createOrder(\User $user, $item, $amount, $price,
		\DateTime $createDatetime, \DateTime $endDatetime, $sellingForUser)
	{
		$sql = '
			INSERT INTO es_orders
			SET userId = '.sqlval($user->getUserId()).',
				item = '.sqlval($item).',
				amount = '.sqlval($amount).',
				price = '.sqlval($price).',
				sellingForUser = '.sqlval($sellingForUser).',
				createDatetime = '.sqlval($createDatetime->format('Y-m-d H:i:s')).',
				endDatetime = '.sqlval($endDatetime->format('Y-m-d H:i:s')).'
		';
		$orderId = query($sql);

		return self::getOrderById($orderId);
	}

	/**
	 * Mark this order deleted
	 */
	public function remove()
	{
		$sql = '
			UPDATE es_orders
			SET deleted = 1
			WHERE `orderId` = '.sqlval($this->orderId).'
		';
		query($sql);
	}

	/**
	 * Sell the specified amount.
	 *
	 * @param integer $amount
	 */
	public function sell($amount)
	{
		$sql = '
			UPDATE es_orders
			SET amountSold = amountSold + '.sqlval($amount).'
			WHERE `orderId` = '.sqlval($this->orderId).'
		';
		query($sql);
	}

	public function getOrderId()
	{
		return $this->orderId;
	}

	public function getUserId()
	{
		return $this->userId;
	}

	public function getItem()
	{
		return $this->item;
	}

	public function getAmount()
	{
		return $this->amount;
	}

	public function getFormattedAmount()
	{
		$translator = \Translator::getInstance();
		return number_format(
			$this->amount, 0, $translator->getTranslation('decimalSign'),
			$translator->getTranslation('thousandsSeparator')
		);
	}

	public function getAmountSold()
	{
		return $this->amountSold;
	}

	public function getFormattedAmountSold()
	{
		$translator = \Translator::getInstance();
		return number_format(
			$this->amountSold, 0, $translator->getTranslation('decimalSign'),
			$translator->getTranslation('thousandsSeparator')
		);
	}

	public function getPrice()
	{
		return $this->price;
	}

	public function getFormattedPrice()
	{
		$translator = \Translator::getInstance();
		return number_format(
			$this->price, 2, $translator->getTranslation('decimalSign'),
			$translator->getTranslation('thousandsSeparator')
		);
	}

	public function getSum()
	{
		return $this->sum;
	}

	public function getFormattedSum()
	{
		$translator = \Translator::getInstance();
		return number_format(
			$this->sum, 2, $translator->getTranslation('decimalSign'),
			$translator->getTranslation('thousandsSeparator')
		);
	}

	public function getCreateDatetime()
	{
		return $this->createDatetime;
	}

	public function getFormattedCreateDatetime()
	{
		$translator = \Translator::getInstance();
		return $this->createDatetime->format($translator->getTranslation('datetimeFormat'));
	}

	public function getEndDatetime()
	{
		return $this->endDatetime;
	}

	public function getFormattedEndDatetime()
	{
		$translator = \Translator::getInstance();
		return $this->endDatetime->format($translator->getTranslation('datetimeFormat'));
	}

	public function getSellingForUser()
	{
		return $this->sellingForUser;
	}
}
