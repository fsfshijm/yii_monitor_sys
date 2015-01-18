<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Alarm Stat'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Alarm', 'url'=>array('index')),
	array('label'=>'View Alarm', 'url'=>array('view', 'id'=>$model->id)),
);
?>


<p>
        字段说明如下：<br>
                obj_id: 流或者模块，<br>
                type(之前的valid):0-未处理，1-误报，脚本未优化，2-误报，脚本已优化，3-有效报警<br>
                reason: 误报的原因，非误报的事件说明<br>
                event_id: 有效报警对应的事故id<br>
</p>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
