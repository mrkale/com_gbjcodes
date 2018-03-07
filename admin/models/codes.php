<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2017 Libor Gabaj. All rights reserved.
 * @license    GNU General Public License version 2 or later. See LICENSE.txt, LICENSE.php.
 * @since      3.7
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Methods handling list of codebooks.
 *
 * @since  3.7
 */
class GbjcodesModelCodes extends GbjSeedModelList
{
	/**
	 * Method for processing parent agenda relationship.
	 *
	 * @return  void
	 */
	public function processParent()
	{
		parent::processParent();
		$this->createCodeTable();
	}

	/**
	 * Creation of the new code table based on the codebooks table.
	 *
	 * @return  void
	 */
	private function createCodeTable()
	{
		if (!isset($this->parentType) || !is_object($this->parent))
		{
			return;
		}

		$tableSeed = Helper::getTable($this->parentType);
		$tableName = Helper::getTable($this->parent->alias);

		if ($tableName === $tableSeed)
		{
			return;
		}

		try
		{
			$db = $this->getDbo();
			$query = 'CREATE TABLE IF NOT EXISTS '
				. $db->quoteName($db->escape($tableName))
				. ' LIKE '
				. $db->quoteName($db->escape($tableSeed));
			$db->setQuery($query);
			$db->execute();
		}
		catch (Exception $e)
		{
			JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');

			return;
		}

		$this->cleanCache();
	}
}
