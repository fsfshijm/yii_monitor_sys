<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Objects'=>array('index'),
	$model->obj_id=>array('view','id'=>$model->obj_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Objects', 'url'=>array('index')),
	array('label'=>'View Object', 'url'=>array('view', 'id'=>$model->obj_id)),
);
?>

<h1>Update Object <?php echo $model->obj_id; ?></h1>

<p>
type:1-小时级监控 2-天级监控 3-未跟踪<br>
status: enum('Normal','UnWached','Warning','Error')  

</p>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
