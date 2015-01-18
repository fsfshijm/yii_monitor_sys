<?php
/* @var $this ObjectsController */

$this->breadcrumbs=array(
	'Objects',
);

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array( 
    'type' => 'inline',
    'htmlOptions'=>array('class'=>'well'),
    //'action'=>Yii::app()->createUrl($this->route), 
    'method'=>'get', 
));
?>
<style>
.grid-view table.items th, .grid-view table.items td{
	word-break: break-all;
}
</style>

<?php echo "Object: 指的是监控对象，或者监控对象中某个特定监控项目.此处列出了qmm 目前接入的所有object。"?>


<div class="pull-right">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType' => 'link',
		'type' => 'primary',
		'label' => '分组浏览',
		'url' => Yii::app()->createUrl('groups/index'),
	));
	?>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType' => 'link',
		'type' => 'primary',
		'label' => '创建Object',
		'url' => Yii::app()->createUrl('objects/create'),
	));
	?>


</div>

<?php $this->endWidget(); ?>

<?php 
$dp = $model->search();
$dp->pagination->setPageSize(50);
$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'objects-grid',
	'dataProvider'=>$dp,
	'filter'=>$model,
        'pager'=>array( 'maxButtonCount'=>'7',),
        'columns'=>array(
                array(
                    'header'=>'ID',
                    'value'=>'$data->obj_id',
					'htmlOptions'=>array('style'=>'width:20px'),
                ),

                'obj_name',
                'description',
                'watcher',
                #'group_id',
                #'type',

                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'header' => '操作',
                    'template' => '{view} {update}',
                ),
				array(
					'type' => 'raw',
					'header' => '状态',
					'value' => '($data->type == 3) ? "<img src=\"".Yii::app()->baseUrl.Yii::app()->params["objStatus"]["UnWached"]."\" />" : "<img src=\"".Yii::app()->baseUrl.Yii::app()->params["objStatus"][$data->status]."\" />"',
		),
        )

));

?>
