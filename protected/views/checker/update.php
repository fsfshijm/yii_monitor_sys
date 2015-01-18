<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Objects'=>array('objects/index'),
	$obj_id => array('objects/view', 'id'=>$obj_id),
	'Checker'=> array('checker/index', 'obj_id'=>$obj_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Checkers', 'url'=>array('index', 'obj_id'=>$obj_id)),
);
?>


<?php $this->renderPartial('_form', array('model'=>$model, 'obj_id'=>$obj_id)); ?>
