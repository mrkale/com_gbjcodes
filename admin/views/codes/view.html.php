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
 * View for handling records of codebook.
 *
 * @since  3.7
 */
class GbjcodesViewCodes extends GbjSeedViewList
{
	/**
	 * Method to create the toolbar for handling agenda records.
	 *
	 * @param   array $blackList List of toolbar items to be ignored.
	 *
	 * @return  void
	 */
	protected function addToolbar()
	{
		$this->toolbarBlackList[] = 'batch';
		parent::addToolbar();
	}
}
