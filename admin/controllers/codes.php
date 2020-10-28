<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2017-2020 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;

use Joomla\String\Normalise;

/**
 * Methods supporting a list of codes
 *
 * @since  3.8
 */
class GbjcodesControllerCodes extends GbjSeedControllerAdmin
{
	/**
	 * Method to leave the current agenda and return to parent view
	 *
	 * @return  void
	 */
	public function enterCodebooks()
	{
		$this->enterAgendaParent(__FUNCTION__);
	}
}
