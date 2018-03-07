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
 * Table definition for single codebook.
 *
 * @since  3.7
 */
class GbjcodesTableCodebook extends GbjSeedTable
{
	/**
	 * Constructor.
	 *
	 * @param   pointer  &$db  Pointer to the current database object.
	 */
	public function __construct(&$db)
	{
		$this->errorMsgs['alias'] = 'COM_GBJCODES_ERROR_UNIQUE_ROOT';
		parent::__construct($db);
	}

	/**
	 * Method to delete a row from the database table by primary key value.
	 *
	 * @param   mixed  $pk  An optional primary key value to delete.  If not set the instance property value is used.
	 *
	 * @return  boolean  True on success.
	 *
	 * @since   11.1
	 * @throws  UnexpectedValueException
	 */
	public function delete($pk = null)
	{
		$table = clone $this;
		$table->load(array('id' => $pk));
		$tableCodes = Helper::getTable($table->alias);
		$this->getDbo()->dropTable($tableCodes);

		return parent::delete($pk);
	}
}
