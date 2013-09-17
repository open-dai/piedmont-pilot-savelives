<?php
/* @var $this UserProcessController */
/* @var $data UserProcess */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_code')); ?>:</b>
	<?php echo CHtml::encode($data->user_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('process')); ?>:</b>
	<?php echo CHtml::encode($data->process); ?>
	<br />


</div>