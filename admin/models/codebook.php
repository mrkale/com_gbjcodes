<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2017-2019 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;

use Joomla\String\Normalise;

/**
 * Methods handling the record of a codebook.
 *
 * @since  3.8
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
		$table->alias = Helper::plural(Normalise::toKey($table->alias));

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
				try
				{
					$this->getDbo()->renameTable($oldTable, $newTable);
				}
				catch (RuntimeException $e)
				{
					// Other than ER_NO_SUCH_TABLE
					if ($e->getCode() <> 1146)
					{
						$app->enqueueMessage($e->getMessage(), 'warning');
					}
				}
			}
		}
	}
}
