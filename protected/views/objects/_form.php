<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'Objects-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'obj_name'); ?>
		<?php echo $form->textField($model,'obj_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'obj_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'git_path'); ?>
		<?php echo $form->textField($model,'git_path',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'git_path'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'build_path'); ?>
		<?php echo $form->textField($model,'build_path',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'build_path'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'watcher(邮箱, 逗号分割)'); ?>
		<?php echo $form->textField($model,'watcher',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'watcher'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone_nums(手机号, 空格分割)'); ?>
		<?php echo $form->textField($model,'phone_nums',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'phone_nums'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'group_id'); ?>
		<?php echo $form->textField($model,'group_id',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'group_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type(1-小时级监控 2-天级监控 3-未跟踪)'); ?>
		<?php echo $form->textField($model,'type',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
