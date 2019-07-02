<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2017 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Table definition for single codebook.
 *
 * @since  3.8
 */
class GbjcodesTableCode extends GbjSeedTable
{
	/**
	 * Constructor.
	 *
	 * @param   pointer  &$db  Pointer to the current database object.
	 */
	public function __construct(&$db)
	{
		parent::__construct($db, $this->getTableName('alias'));
	}
}
