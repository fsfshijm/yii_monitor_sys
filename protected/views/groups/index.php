<?php
/* @var $this ObjectsController */

/*控制导航栏的显示*/
$this->breadcrumbs=array(
	'Groups',
);


$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array( 
    'type' => 'inline',
    'htmlOptions'=>array('class'=>'well'),
    //'action'=>Yii::app()->createUrl($this->route), 
    'method'=>'get', 
)); ?>

    <?php echo "通过Group找到相关的监控Objects"; ?>

    <div class="pull-right">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'link',
            'type' => 'primary',
            'label' => '创建组',
            'url' => Yii::app()->createUrl('groups/create'),
        ));
        ?>
    </div>

<?php $this->endWidget(); ?>



<style>
.grid-view table.items th, .grid-view table.items td{
        word-break: break-all;
}
</style>



<?php 


$dp = $model->search();
$dp->pagination->setPageSize(50);

$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'groups-grid',
	'dataProvider'=>$dp,
	'enableSorting'=>true,
	'filter'=>$model,
    'pager'=>array( 'maxButtonCount'=>'7',),
    'columns'=>array(
				#'id'
                array(
                        'header'=>'ID',
                        'value'=>'$data->id',
						'htmlOptions'=>array('style'=>'width:30px'),
                ),
                #'group_name',
                array(
						'class' => 'CLinkColumn',
                        'header'=>'group_name',
						'labelExpression'=>'$data->group_name',
						//处理点击后的跳转链接
						'urlExpression'=>'Yii::app()->controller->createUrl("view", array("id"=>$data->id))',
                ),
                'description',

                array(
                        'class'=>'bootstrap.widgets.TbButtonColumn',
                        'header' => '操作',
                        'template' => '{view} {update}',
                ),
        )

));

?>
