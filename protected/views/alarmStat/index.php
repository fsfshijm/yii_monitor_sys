<?php
/* @var $this AlarmStatController */
/* #@var $dataProvider CActiveDataProvider */
/* @var $model AlarmStat */

$this->breadcrumbs=array(
	'Alarm Stat',
);

$this->menu=array(
	array('label'=>'List Alarms', 'url'=>array('index')),
	array('label'=>'List Events', 'url'=>array('events/index')),
	array('label'=>'Create Events', 'url'=>array('events/create')),
);
?>

<style>
.grid-view table.items th, .grid-view table.items td{
        word-break: break-all;
}
</style>

<p>
	本页面展示所有的报警信息: 
	<li>报警信息有监控程序自动生成, 所有报警需要被标记;</li>
	<li>对于有效报警，建议创建Events与其关联;</li>
	<li>对于无效报警，请说明误报的原因。</li>
 
</p>

<div class="pull-right">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType' => 'link',
		'type' => 'primary',
		'label' => '创建Events',
		'url' => Yii::app()->createUrl('events/create'),
	));
	?>

	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType' => 'link',
		'type' => 'primary',
		'label' => '展现Events',
		'url' => Yii::app()->createUrl('events/index'),
	));
	?>
</div>

<div id="alarms_buttons">
<span><a id="alarms_unmark" title="unmark" href="<?php
echo $this->createUrl('index', array('type'=>0));
?>">未处理报警</a></span>
<span>|</span>
<span><a id="alarms_valid" title="valid" href="<?php
echo $this->createUrl('index', array('type'=>3));
?>">有效报警</a></span>
<span>|</span>
<span><a id="alarms_all" title="all" href="<?php
echo $this->createUrl('index', array('type'=>4));
?>">全部报警</a></span>
</div>



<?php 

$dp = $model->search();
$dp->pagination->setPageSize(50);


$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'alarms-grid',
	'dataProvider'=>$dp,
	'filter'=>$model,
	#'htmlOptions'=>array('style'=>'width:740px'),
	'pager'=>array( 'maxButtonCount'=>'7',),
	'ajaxUpdate' => false,
	'columns'=>array(
                array(
                        'selectableRows' => 2,
                        'footer' => '<div class="btn-group btn-mini">
                        <button class="btn" id="modify">批量修改</button>
                        </div>',
                        'class' => 'CCheckBoxColumn',
                        'headerHtmlOptions' => array('width'=>'80px'),
                        'checkBoxHtmlOptions' => array('name' => 'selectjob[]'),
                        ),

		'sender',
		#'service',
		'content',
		#'type',
		#'reason',
		#'event_id',
		'dt',
		#'hr',
		'alarm_email',	
		#'obj_id',	

		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'header' => '操作',
			'template' => '{view} {update}',
		),
	)

));
?>

<script type="text/javascript">
/*<![CDATA[*/
$("#modify").click(function(){
	var ids = GetCheckbox();
	if(ids.length > 0){
		console.log(ids);
		var url = "/index.php?r=alarmStat/modify&ids=" + ids;
		window.location = url;}
	else {
		alert("请选择要操作的任务!");
	}
});
var GetCheckbox = function(){
        var data=new Array();
        $("input:checkbox[name='selectjob[]']").each(function (){
                        if($(this).attr("checked")=="checked"){
                        data.push($(this).val());
                        }
                        });
	return data;
}
/*]]>*/
</script>
