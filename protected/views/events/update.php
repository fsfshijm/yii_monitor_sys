<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Events'=>array('index'),
	$model->event_id=>array('view','id'=>$model->event_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Events', 'url'=>array('index')),
	array('label'=>'View Event', 'url'=>array('view', 'id'=>$model->event_id)),
);
?>

<h1>Update alarm <?php echo $model->event_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
