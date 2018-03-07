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
 * Methods supporting a list of codebooks.
 *
 * @since  3.7
 */
class GbjcodesControllerCodebooks extends GbjSeedControllerAdmin
{
	/**
	 * Method to create and enter to the selected codebook
	 *
	 * @return  void
	 */
	public function enterCodes()
	{
		// Check for request forgeries
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$viewName = $this->input->get('view', '', 'word');
		$parentType = Helper::singular($viewName);
		$ids = $this->input->get('cid', array(), 'array');
		JArrayHelper::toInteger($ids);
		$parentId = $ids[0];

		// Go to child agenda
		$this->setRedirect(Helper::getUrlViewParent('codes', $parentType, $parentId));
	}
}
