<?php
/* @var $this ObjectsController */

Yii::app()->clientScript->registerCoreScript('jquery.ui');

$this->breadcrumbs=array(
	'Objects'=>array('index'),
	$obj_model->obj_id =>array('view', 'id'=>$obj_model->obj_id),
	'Reports',
);
/*
$this->menu=array(
	array('label'=>'List Streams', 'url'=>array('index')),
);*/
?>


<p>
表格：是该stream的所有的历史数据，以供查看，后续会选取一部分数据展现，目前还没处理<br>

</p>



<?php

#$dp = new CArrayDataProvider($reports_model);
 $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'reports-grid',
	'dataProvider'=>$reports_model->search(),
	'filter'=>$reports_model,
        'pager'=>array( 'maxButtonCount'=>'7',),
        'columns'=>array(
                array(
                        'header'=>'Report_ID',
                        'value'=>'$data->report_id',
                ),
				array(
                        'header'=>'Content',
                        'value'=>'$data->content_map',
                        'htmlOptions'=>array('style'=>'width:500px'),
                ),
                'obj_id',
                'dt',
                'hr',

                array(
                        'class'=>'bootstrap.widgets.TbButtonColumn',
                        'header' => '操作',
                        'template' => '{view}',
                ),
        )

));

?>
