<?php
/* @var $this EventsController */
/* @var $model Events */

$this->breadcrumbs=array(
	'Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Groups', 'url'=>array('index')),
	array('label'=>'Create Group', 'url'=>array('create')),
);
?>


<p>
</p>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
