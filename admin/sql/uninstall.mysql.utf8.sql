/**
 * @package    Joomla.Component
 * @copyright  (c) 2017 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

/**
 * Remove table for codebook repository.
 * Tables for individual codelists have been deleted in uninstallation method
 * of the script.php.
 */
DROP TABLE IF EXISTS `#__gbjcodes_codebooks`;
