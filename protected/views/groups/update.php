<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Groups'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Groups', 'url'=>array('index')),
	array('label'=>'View Group', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Update Group <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
