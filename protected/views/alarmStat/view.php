<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Alarm Stat'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Alarms', 'url'=>array('index')),
	array('label'=>'Update Alarm', 'url'=>array('update', 'id'=>$model->id)),
);
?>

<h1>View Alarm #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'sender',
		'service',
		'content',
		'type',
		'reason',
		'event_id',
		'dt',
		'hr',
		'alarm_email',
		'obj_id',
	),
)); ?>
