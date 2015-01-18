<p>

需改的alarms id: <?php echo $ids; ?> </br>

字段说明如下：</br>
type(之前的valid):0-未处理，1-误报，脚本未优化，2-误报，脚本已优化，3-有效报警</br>
reason: 误报的原因，非误报的事件说明</br>
event_id: 有效报警对应的事故id</br>

<p>

<form method="post" action="/index.php?r=alarmStat/batch" >
<input type="hidden" name="ids" id="ids" value="<?php echo $ids; ?>" />
<label>type:</label> </br>
<input type="text" name="alarm_type" /> </br>
<label>reason:</label> </br>
<input type="text" name="alarm_reason" size="60" maxLength="200"/> </br>
<label>event_id: </label> </br>
<input type="text" name="alarm_event_id" /> </br>
<input type="submit" value="更新" />
</form>
