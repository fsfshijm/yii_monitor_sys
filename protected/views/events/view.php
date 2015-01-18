<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Events'=>array('index'),
	$model->event_id,
);

?>

<h1>View Alarm #<?php echo $model->event_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'event_id',
		'group_id',
		'obj_id',
		'description',
		'dt',
		'hr',
	),
)); ?>
