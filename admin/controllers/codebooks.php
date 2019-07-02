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
 * Methods supporting a list of codebooks.
 *
 * @since  3.8
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
		$this->enterAgendaChild(__FUNCTION__);
    }
}
