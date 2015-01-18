<?php
/* @var $this ObjectsController */

Yii::app()->clientScript->registerCoreScript('jquery.ui');

$this->breadcrumbs=array(
	'Objects'=>array('index'),
	$obj_model->obj_id =>array('view', 'id'=>$obj_model->obj_id),
	'Alarms',
);


?>
<style>
.grid-view table.items th, .grid-view table.items td{
     word-break: break-all;
 }
</style>

<p>
该Object所属的所有报警信息，对于有效报警，请<a id="create_event" title="创建Events" href=<?php echo $this->createUrl('events/create', array('obj_id'=>$obj_model->obj_id, 'type'=>0));?>>创建Events</a>与之关联
</p>

<div id="alarms_buttons">
<span><a id="alarms_unmark" title="unmark" href="<?php
echo $this->createUrl('alarms', array('id'=>$obj_model->obj_id, 'type'=>0));
?>">未处理报警</a></span>
<span>|</span>
<span><a id="alarms_valid" title="valid" href="<?php
echo $this->createUrl('alarms', array('id'=>$obj_model->obj_id, 'type'=>3));
?>">有效报警</a></span>
<span>|</span>
<span><a id="alarms_all" title="all" href="<?php
echo $this->createUrl('alarms', array('id'=>$obj_model->obj_id, 'type'=>4));
?>">全部报警</a></span>
</div>


<?php

$dp = new CArrayDataProvider($alarms_model);

$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'reports-grid',
	'dataProvider'=>$dp,
	#'filter'=>$dp,
	#'htmlOptions'=>array('style'=>'width:740px'),
        'pager'=>array( 'maxButtonCount'=>'7',),
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

                array(
                        'header'=>'报警日期',
                        'value'=>'$data->dt',
                        'htmlOptions'=>array('style'=>'width:80px'),
                ),
 
                array(
                        'header'=>'小时',
                        'value'=>'$data->hr',
                        'htmlOptions'=>array('style'=>'width:30px'),
                ), 
				
				
				#'sender',
                #'service',
                'content',
                #'type',
                #'reason',
                #'event_id',
                #'dt',
                #'hr',
                #'alarm_email',
                #'obj_id',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'header' => '操作',
			'template' => '{view} {update}',
			'viewButtonUrl'=>'Yii::app()->createUrl("/alarmStat/view", array("id" => $data->id))',
			'updateButtonUrl'=>'Yii::app()->createUrl("/alarmStat/update", array("id" => $data->id))',
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
