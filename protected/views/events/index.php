<?php
/* @var $this EventsController */
/* @var $dataProvider CActiveDataProvider */

if ($model->obj_id!=1){

	$this->breadcrumbs=array(
		'Objects'=>array('objects/index'),
		$model->obj_id =>array('objects/view', 'id'=>$model->obj_id),
		'Events',
	);

}
else {
	$this->breadcrumbs=array(
		'Events',
	);
	}

$this->menu=array(
	array('label'=>'List Events', 'url'=>array('index')),
	array('label'=>'Create Events', 'url'=>array('create')),
);

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array( 
    'type' => 'inline',
    'htmlOptions'=>array('class'=>'well'),
    //'action'=>Yii::app()->createUrl($this->route), 
    'method'=>'get', 
));

?>
<?php echo "本页面创建和更新事故。"; ?>

<div class="pull-right">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType' => 'link',
		'type' => 'primary',
		'label' => '创建Event',
		'url' => Yii::app()->createUrl('events/create',array("obj_id"=>(isset($model->obj_id) ? $model->obj_id : 1))),
	));
	?>
</div>

<?php $this->endWidget(); ?>

<?php 

$dp = $model->search();
$dp->pagination->setPageSize(50);

$this->widget('bootstrap.widgets.TbGridView', array(
        'id'=>'events-grid',
        #'dataProvider'=>$dataProvider,
        'dataProvider'=>$dp,
	'filter'=>$model,
        'pager'=>array( 'maxButtonCount'=>'7',),
        'columns'=>array(
                array(
                        'header'=>'ID',
                        'value'=>'$data->event_id',
                ),
                'description',
                'dt',
                'hr',

                array(
                        'class'=>'bootstrap.widgets.TbButtonColumn',
                        'header' => '操作',
                        'template' => '{view} {update} ',
                ),
        )

));
?>
