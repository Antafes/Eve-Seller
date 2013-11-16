<?php
namespace Model;

/**
 * Description of Item
 *
 * @author Neithan
 */
class Item
{
	/**
	 * @var integer
	 */
	protected $typeId;

	/**
	 * @var string
	 */
	protected $typeName;

	/**
	 * @param integer $itemId
	 * @return \self
	 */
	public static function getItemById($itemId)
	{
		$sql = '
			SELECT
				`typeID`,
				`typeName`
			FROM invtypes
			WHERE `typeID` = '.sqlval($itemId).'
		';
		$itemData = query($sql);

		if ($itemData)
		{
			$object = new self();
			$object->typeId   = $itemData['typeID'];
			$object->typeName = $itemData['typeName'];

			return $object;
		}
	}

	/**
	 * Fetch all published items and return a grouped list.
	 *
	 * @return array
	 */
	public static function getItemList()
	{
		$sql = '
			SELECT
				it.`typeID`,
				it.`typeName`,
				ig.groupName
			FROM invtypes AS it
			JOIN invgroups AS ig USING (groupID)
			JOIN invcategories AS ic USING (categoryID)
			WHERE ic.published
				AND ig.published
			ORDER BY ic.categoryName, ig.groupName, it.typeName
		';
		$items = query($sql, true);

		$groupedItems = array();
		foreach ($items as $item)
			$groupedItems[$item['groupName']][$item['typeID']] = $item['typeName'];

		return $groupedItems;
	}

	public function getTypeId()
	{
		return $this->typeId;
	}

	public function getTypeName()
	{
		return $this->typeName;
	}
}