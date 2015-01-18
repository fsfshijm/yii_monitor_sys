<?php
/* @var $this EventsController */
/* @var $model Events */

$this->breadcrumbs=array(
	'Objects'=>array('objects/index'),
	$obj_id => array('objects/view', 'id'=>$obj_id),
	'Checker'=> array('checker/index', 'obj_id'=>$obj_id),
	'Create',
);

$this->menu=array(
	array('label'=>'List Checkers', 'url'=>array('index', 'obj_id'=>$obj_id)),
);
?>


<p>
</p>

<?php $this->renderPartial('_form', array('model'=>$model, 'obj_id'=>$obj_id)); ?>
