<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2017 Libor Gabaj. All rights reserved.
 * @license    GNU General Public License version 2 or later. See LICENSE.txt, LICENSE.php.
 * @since      3.7
 */

// No direct access
defined('_JEXEC') or die;

use Joomla\String\Normalise;

/**
 * Methods supporting a list of codes
 *
 * @since  3.7
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
		// Check for request forgeries
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Go to parent view without parent filter
		$parts = explode(' ', Normalise::fromCamelCase(__FUNCTION__));
		$this->setRedirect(Helper::getUrlViewParentDel(strtolower(end($parts)), $this->input->getWord('view')));
	}
}
