<?php
/* @var $this EventsController */
/* @var $model Events */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'Events-Create-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dt'); ?>
		<?php echo $form->dateField($model,'dt',array('size'=>60,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'dt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hr'); ?>
		<?php echo $form->textField($model,'hr',array('size'=>60,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'hr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'group_id'); ?>
		<?php echo $form->textField($model,'group_id',array('size'=>60,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'group_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'obj_id'); ?>
		<?php echo $form->textField($model,'obj_id',array('size'=>60,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'obj_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
