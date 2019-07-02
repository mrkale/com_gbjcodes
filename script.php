<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2017-2018 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Installation script for component COM_GBJCODES
 *
 * @since  3.8
 */
class Com_GbjcodesInstallerScript
{
	/**
	 * Actions at uninstalling the component
	 *
	 * @param   jadapterinstance  $adapter  Installer object
	 *
	 * @return  void
	 */
	public function uninstall(jadapterinstance $adapter)
	{
		include_once 'helpers/main.php';
		$this->uninstallTables();
	}

	/**
	 * Uninstall tables of codelists registered in the codebook repository
	 *
	 * @return  void
	 */
	private function uninstallTables()
	{
		$db = JFactory::getDbo();
		$tableName = Helper::getTable(Helper::AGENDA_MAIN);
		$query = $db->getQuery(true)
			->select('alias')
			->from($db->quoteName($tableName));
		$db->setQuery($query);
		$aliasRows = $db->loadRowList();

		foreach ($aliasRows as $aliasRow)
		{
			$baseName = $aliasRow[0];
			$tableName = Helper::getTableName($baseName);
			$db->dropTable($tableName);
		}

		echo '<p>' . JText::_('COM_GBJCODES_UNINSTALL_TEXT') . '</p>';
	}
}
