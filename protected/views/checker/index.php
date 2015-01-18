<?php
/* @var $this CheckerController */

$this->breadcrumbs=array(
	'Groups'=>array('groups/index'),
	$group_id=>array('groups/view','id'=>$group_id),
	$obj_id => array('objects/view', 'id'=>$obj_id),
	'Checker',
);

?>

<p>
object 对应的同比环比信息:</br>
<blockquote>
<li>同比增: 表示同比增加幅度如果超过阈值就报警</li>
<li>同比减: 表示同比减少幅度如果超过阈值就报警</li>
<li>环比增: 表示环比增加幅度如果超过阈值就报警</li>
<li>环比减: 表示环比减少幅度如果超过阈值就报警</li>
<li>绝对值大于: 表示绝对值大于阈值就报警</li>
<li>绝对值小于: 表示绝对值小于阈值就报警</li>
</blockquote>
阈值: </br>
<blockquote>
<li>观察类型为同比或者环比时：阈值为百分比的分子,比如期望阈值不超过30%，填30即可 </li>
<li>观察类型为绝对值时：具体的一个数值，比如期望绝对值不小于1000，填1000即可 </li>
</blockquote>
实际比例: 实际同比或环比得增减幅度，会和阈值比较 </br>
状态: </br>
<blockquote>
<li>蓝色: 正常 </li>
<li>灰色: 配置处于停止状态 </li>
<li>黄色: 前一个周期或者当前周期数据丢失 </li>
<li>红色: 超出阈值，报警 </li>
</blockquote>
</p>

<?php
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array( 
    'type' => 'inline',
    'htmlOptions'=>array('class'=>'well'),
    //'action'=>Yii::app()->createUrl($this->route), 
    'method'=>'get', 
));
?>

<div class="pull-right">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType' => 'link',
		'type' => 'primary',
		'label' => '创建Checker',
		'url' => Yii::app()->createUrl('checker/create',array('obj_id'=>$obj_id)),
	));
	?>
</div>

<?php $this->endWidget(); ?>
<?php

$dp = new CArrayDataProvider($model);
 $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'checker-grid',
	'dataProvider'=>$dp,
	#'filter'=>$dp,
	#'htmlOptions'=>array('style'=>'width:740px'),
        'pager'=>array( 'maxButtonCount'=>'7',),
        'columns'=>array(
                array(
                        'header'=>'ID',
                        'value'=>'$data->id',
                        'htmlOptions'=>array('style'=>'width:15px'),
                ),
                array(
                        'header'=>'关键字',
                        'value'=>'$data->keyword',
                ),
                array(
                        'header'=>'观察类型',
                        'value'=>'Yii::app()->baseUrl.Yii::app()->params["CheckerTypes"][$data->type]',
                ),
                array(
                        'header'=>'前个周期',
                        'value'=>'$data->pre_cycle',
                ),
                array(
                        'header'=>'当前周期',
                        'value'=>'$data->cur_cycle',
                ),
                array(
                        'header'=>'实际比例(%)',
                        'value'=>'$data->real_rate',
                ),
                array(
                        'header'=>'阈值(%)',
                        'value'=>'$data->threshold',
                ),
                array(
                        'header'=>'是否运行',
                        'value'=>'$data->is_running == 0 ? "False" : "True"',
                ),
                array(
                        'header'=>'状态',
                        'type'=>'raw',
                        #'value'=>'$data->status',
                        'value'=>'"<img src=\"".Yii::app()->baseUrl.Yii::app()->params["CheckerStatus"][$data->status]."\" />"',
                ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'header' => '操作',
			'template' => '{update} {delete}',
			#'viewButtonUrl'=>'Yii::app()->createUrl("/checker/view", array("id" => $data->id))',
			'updateButtonUrl'=>'Yii::app()->createUrl("/checker/update", array("id" => $data->id, "obj_id"=>$data->obj_id))',
		),
        )

));

?>



