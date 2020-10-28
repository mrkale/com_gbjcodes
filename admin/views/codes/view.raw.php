<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2020 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;

/**
 * View for exporting agenda records
 *
 * @since  3.8
 */
class GbjcodesViewCodes extends GbjSeedViewRaw
{
	/**
	 * Method to compose export CSV file's base name from codelist name.
	 *
	 * @return  string
	 */
	protected function getRawBasename()
	{
		return $this->model->parent->title;
	}
}
