<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2017 Libor Gabaj. All rights reserved.
 * @license    GNU General Public License version 2 or later. See LICENSE.txt, LICENSE.php.
 * @since      3.7
 */

// No direct access
defined('_JEXEC') or die;

JHtml::_('formbehavior.chosen', 'select');

$tabSetName = 'editTabSet';
$tabNameDetails = 'details';
$tabNamePublishing = 'publishing';
$tabNameActive = $tabNameDetails;
?>

<form action="<?php echo JRoute::_(
	Helper::getUrl(
		array(
			'layout' => Helper::COMMON_LAYOUT_EDIT,
			'id' =>	(int) $this->item->id
		)
	)
);?>"
	method="post" name="adminForm" id="adminForm" class="form-validate">
	<?php echo JLayoutHelper::render('joomla.edit.title_alias', $this); ?>
	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', $tabSetName, array('active' => $tabNameActive)); ?>

		<?php echo JHtml::_('bootstrap.addTab', $tabSetName, $tabNameDetails,
			empty($this->item->id) ? JText::_('COM_GBJCODES_RECORD_CODE_NEW') : JText::sprintf('COM_GBJCODES_RECORD_CODE_EDIT', $this->item->id)
			);
		?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span9">
			<?php echo $this->form->renderField('description'); ?>
			</div>
			<div class="span3">
				<?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php echo JHtml::_('bootstrap.addTab', $tabSetName, $tabNamePublishing, JText::_('JGLOBAL_FIELDSET_PUBLISHING', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
		<?php echo JLayoutHelper::render('joomla.edit.publishingdata', $this); ?>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>

		<?php echo JHtml::_('bootstrap.endTabSet'); ?>
	</div>
</form>