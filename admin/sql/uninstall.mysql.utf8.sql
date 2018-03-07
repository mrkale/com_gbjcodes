/**
 * @package    Joomla.Component
 * @copyright  (c) 2017 Libor Gabaj. All rights reserved.
 * @license    GNU General Public License version 2 or later. See LICENSE.txt, LICENSE.php.
 * @since      3.7
 */

/**
 * Remove table for codebook repository.
 * Tables for individual codelists have been deleted in uninstallation method
 * of the script.php.
 */
DROP TABLE IF EXISTS `#__gbjcodes_codebooks`;
