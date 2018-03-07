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
