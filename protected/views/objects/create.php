<?php
/* @var $this EventsController */
/* @var $model Events */

$this->breadcrumbs=array(
	'Objects'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Objects', 'url'=>array('index')),
	array('label'=>'Create Objects', 'url'=>array('create')),
);
?>


<p>
obj_name: 不要超过100字<br>
type:1-小时级监控 2-天级监控 3-未跟踪 <br>
status: enum('Normal','UnWached','Warning','Error') <br>

</p>

<?php 
$this->renderPartial('_form', array('model'=>$model)); 



?>

