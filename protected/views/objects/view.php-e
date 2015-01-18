<?php
/* @var $this ObjectsController */

Yii::app()->clientScript->registerCoreScript('jquery.ui');

$this->breadcrumbs=array(
	'Groups' =>array('groups/index'),
	$obj_model->group_id =>array('groups/view', 'id'=>$obj_model->group_id),
	#'Objects'=>array('index'),
	$obj_model->obj_id,
);

$this->menu=array(
	array('label'=>'Update Object', 'url'=>array('update', 'id'=>$obj_model->obj_id)),
);
?>

<head>
<script type="text/javascript" src="http://sm.xxxxxxxx.cn/libs/js/highcharts/3.0.7/js/highcharts.js"></script>
<script type="text/javascript" src="http://sm.xxxxxxxx.cn/libs/js/highcharts/3.0.7/js/modules/exporting.js"></script>
<script type="text/javascript" src="http://xxxxxxxx-202.xxxxxxxx-inc.cn:8675/js/chart/chart.js"></script>
</head>

<p>
曲线图: 都是以小时为单位出的，其中过去1个月的是聚合成天级数据出<br>
表格：是该stream的所有的历史数据，以供查看，后续会选取一部分数据展现，目前还没处理
<div class="pull-right">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType' => 'link',
		'type' => 'primary',
		'label' => '更新Object',
		'url' => Yii::app()->createUrl('objects/update',array("id"=>$obj_model->obj_id)),
	));
	?>
</div>
</p>

<br>
<br>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
        'data'=>$obj_model,
        'attributes'=>array(
                'obj_id',
                'obj_name',
                'git_path',
                'build_path',
                'description',
                'watcher',
                'phone_nums',
				array(            
							'label'=>'Group',
							'type'=>'raw',
							'value'=>CHtml::link(CHtml::encode($obj_model->group_id),
										 array('groups/view','id'=>$obj_model->group_id)),
					),
				array(            
							'label'=>'历史数据',
							'type'=>'raw',
							'value'=>CHtml::link(CHtml::encode('reports'),
										 array('objects/reports','id'=>$obj_model->obj_id)),
					),
				array(            
							'label'=>'历史报警',
							'type'=>'raw',
							'value'=>CHtml::link(CHtml::encode('alarms'),
										 array('objects/alarms','id'=>$obj_model->obj_id)),
					),

				array(            
									'label'=>'历史事件',
									'type'=>'raw',
									'value'=>CHtml::link(CHtml::encode('events'),
												 array('events/index','obj_id'=>$obj_model->obj_id)),
					),

				array(            
							'label'=>'数据校验配置',
							'type'=>'raw',
							'value'=>CHtml::link(CHtml::encode('数据校验配置'),
										 array('checker/index','obj_id'=>$obj_model->obj_id)),
					),

        ),
)); ?>


<p>

</p>

<div id="time_buttons">
<span><a id="ts_12hour" title="Last 12 hours" href="<?php
echo $this->createUrl('chart', array('id'=>$obj_model->obj_id, 'span'=>12));
?>">过去12小时</a></span>
<span><a id="ts_24hours" title="Last 24 hours" href="<?php
echo $this->createUrl('chart', array('id'=>$obj_model->obj_id, 'span'=>24));
?>">过去24小时</a></span>
<span><a id="ts_48hours" title="Last 48 hours" href="<?php
echo $this->createUrl('chart', array('id'=>$obj_model->obj_id, 'span'=>48));
?>">过去48小时</a></span>
<span><a id="ts_week" title="Last week" href="<?php
echo $this->createUrl('chart', array('id'=>$obj_model->obj_id, 'span'=>24*7));
?>">过去1周</a></span>
<span><a id="ts_month" title="Last month" href="<?php
echo $this->createUrl('chart', array('id'=>$obj_model->obj_id, 'span'=>24*31));
?>">过去1月</a></span>
<span><a id="ts_six_month" title="Last six month" href="<?php
echo $this->createUrl('chart', array('id'=>$obj_model->obj_id, 'span'=>24*31*6));
?>">过去6月</a></span>
</div>



<div id="chart_monitor" style="min-width: 200px; height: 400px; margin: 0 auto">
</div>

