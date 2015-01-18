<?php
/* @var $this EventsController */
/* @var $model Events */

$this->breadcrumbs=array(
	'Events'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Events', 'url'=>array('index')),
	array('label'=>'Create Events', 'url'=>array('create')),
);
?>


<p>
Description: 不要超过200字<br>
dt的格式: 2014-08-12, 错了后面读不出数据了<br>
hr: 正常数字即可,eg 9<br>
</p>

<?php $this->renderPartial('_create_form', array('model'=>$model)); ?>

