<?php
/* @var $this UserProcessController */
/* @var $model UserProcess */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-process-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_code'); ?>
		<?php echo $form->textField($model,'user_code',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'user_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'process'); ?>
		<?php echo $form->textArea($model,'process',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'process'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->