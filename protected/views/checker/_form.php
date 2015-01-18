<?php
/* @var $this EventsController */
/* @var $model Events */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'Checker-Create-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'keyword'); ?>
		<?php echo $form->textField($model,'keyword',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'keyword'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'threshold'); ?>
		<?php echo $form->textField($model,'threshold',array('size'=>60,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'threshold'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type',array('同比增加','同比减少','环比增加', '环比减少', '绝对值大于', '绝对值小于'),array('size'=>1,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_running'); ?>
		<?php echo $form->dropDownList($model,'is_running',array(0,1),array('size'=>1,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'is_running'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
