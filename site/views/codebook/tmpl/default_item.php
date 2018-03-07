<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2017 Libor Gabaj. All rights reserved.
 * @license    GNU General Public License version 2 or later. See LICENSE.txt, LICENSE.php.
 * @since      3.7
 */

// No direct access
defined('_JEXEC') or die;

$layoutBasePath = Helper::getLayoutBase();
$tparams = $this->params;
$pageclass_sfx = htmlspecialchars($tparams->get('pageclass_sfx'));
$class = strtolower(Helper::getClassPrefix()). '_dl' . $pageclass_sfx;
?>
<dl class="<?php echo $class; ?>">
	<?php
		$this->item->alias = Helper::getTableName($this->item->alias, true);
		echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field'=>'alias'));
	?>
</dl>
