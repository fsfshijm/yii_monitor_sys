<?php
/* @var $this UserController */
/* @var $model User */
/* @var $objects_model Objects */

$this->breadcrumbs=array(
	'Groups'=>array('index'),
	$model->id,
);

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array( 
    'type' => 'inline',
    'htmlOptions'=>array('class'=>'well'),
    //'action'=>Yii::app()->createUrl($this->route), 
    'method'=>'get', 
));

?>


<?php echo "Groups下所对应的Objects,每个Object对应一个监控对象。"; ?>

<div class="pull-right">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType' => 'link',
		'type' => 'primary',
		'label' => '创建Object',
		'url' => Yii::app()->createUrl('objects/create',array("groupid"=>$model->id)),
	));
	?>
</div>

<?php $this->endWidget(); ?>

<?php

$dp = $objects_model->search();
$dp->pagination->setPageSize(50);

$this->widget('bootstrap.widgets.TbGridView', array(
        'id'=>'reports-grid',
        'dataProvider'=>$dp,
        'filter'=>$objects_model,
        'pager'=>array( 'maxButtonCount'=>'7'),
        'columns'=>array(
                array(
			'header'=>'ID',
			'value'=>'$data->obj_id',
			'htmlOptions'=>array('style'=>'width:20px'),
                ),
                array(
			'class' => 'CLinkColumn',
			'header'=>'obj_name',
			'labelExpression'=>'$data->obj_name',
			'urlExpression'=>'Yii::app()->controller->createUrl("objects/view", array("id"=>$data->obj_id))',
                ),

                'description',
                'watcher',
              array(
                       'class'=>'bootstrap.widgets.TbButtonColumn',
                       'header' => '操作',
                       'template' => '{view} {update}',
                       'viewButtonUrl'=>'Yii::app()->createUrl("/objects/view", array("id" => $data->obj_id))',
                       'updateButtonUrl'=>'Yii::app()->createUrl("/objects/update", array("id" => $data->obj_id, "from"=>"groups"))',
                ),
		array(
                        'type' => 'raw',
                        'header' => '状态',
                        'value' => '($data->type == 3) ? "<img src=\"".Yii::app()->baseUrl.Yii::app()->params["objStatus"]["UnWached"]."\" />" : "<img src=\"".Yii::app()->baseUrl.Yii::app()->params["objStatus"][$data->status]."\" />"',
                ),	
        )

));



?>
