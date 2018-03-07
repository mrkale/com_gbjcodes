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
 * Installation script for component COM_GBJCODES
 *
 * @since  3.7
 */
class Com_GbjcodesInstallerScript
{
	/**
	 * Actions at installing the component
	 *
	 * @param   object  $parent  Installer object
	 *
	 * @return  none
	 */
	public function install($parent)
	{
		echo '<p>' . JText::_('COM_GBJCODES_INSTALL_TEXT') . '</p>';
	}

	/**
	 * Actions at uninstalling the component
	 *
	 * @param   object  $parent  Installer object
	 *
	 * @return  none
	 */
	public function uninstall($parent)
	{
		include_once 'helpers/main.php';
		$this->uninstallTables();
	}

	/**
	 * Actions at updating the component
	 *
	 * @param   object  $parent  Installer object
	 *
	 * @return  none
	 */
	public function update($parent)
	{
//		echo '<p>' . JText::_('COM_GBJCODES_UPDATE_TEXT') . '</p>';
	}

	/**
	 * Actions before installing the component
	 *
	 * @param   string  $type    Type of action (DISCOVER, INSTALL, UNINSTALL, UPDATE)
	 * @param   object  $parent  Installer object
	 *
	 * @return  none
	 */
	public function preflight($type, $parent)
	{
//		echo '<p>' . JText::_('COM_GBJCODES_PREFLIGHT_' . strtoupper($type) . '_TEXT') . '</p>';
	}

	/**
	 * Actions after installing the component
	 *
	 * @param   string  $type    Type of action (DISCOVER, INSTALL, UNINSTALL, UPDATE)
	 * @param   object  $parent  Installer object
	 *
	 * @return  none
	 */
	public function postflight($type, $parent)
	{
//		echo '<p>' . JText::_('COM_GBJCODES_POSTFLIGHT_' . strtoupper($type) . '_TEXT') . '</p>';
	}

	/**
	 * Uninstall tables of codelists registered in the codebook repository
	 *
	 * @return  none
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
