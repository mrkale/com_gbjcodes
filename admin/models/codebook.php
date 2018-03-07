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
 * Methods handling the record of a codebook.
 *
 * @since  3.7
 */
class GbjcodesModelCodebook extends GbjSeedModelAdmin
{
	/**
	 * Method to sanitize the table data prior to saving.
	 *
	 * @param   JTable  $table  A reference to a JTable object.
	 *
	 * @return  void
	 */
	protected function prepareTable($table)
	{
		parent::prepareTable($table);

		// Clean and pluralize table root
		$table->alias = Helper::plural(JStringWrapperNormalise::toKey($table->alias));

		if ($table->id)
		{
			$app = JFactory::getApplication();
			$paramName = Helper::getAgendaPrmEditData($this->getName());
			$recordOrig = (array) $app->getUserState($paramName, array());

			// Rename code table
			$oldTable = Helper::getTable($recordOrig['alias']);
			$newTable = Helper::getTable($table->alias);

			if ($oldTable !== $newTable)
			{
				$this->getDbo()->renameTable($oldTable, $newTable);
			}
		}
	}
}
