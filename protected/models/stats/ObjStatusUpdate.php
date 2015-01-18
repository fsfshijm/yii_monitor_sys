<?php

class ObjStatusUpdate extends CFormModel
{
	private $ids;

	public function __construct($ids) {
		$this->ids = $ids;
	}

	public function execute() {
		foreach ($this->ids as $obj_id) {
			$this->update_object_status($obj_id);
		}
	}


	public function update_object_status($obj_id) {
		$objects_sql = "SELECT obj_id, type, status from objects where obj_id= ?";
		$command = Yii::app()->db->createCommand($objects_sql);
		$command->bindParam(1, $obj_id, PDO::PARAM_INT);
		$cur_row = $command->queryRow();

		$cur_time = time();
		$exist_alarms_sql = "select count(*) as alarms_count from alarm_stat where obj_id = ? and type = 0"; #未处理的报警
		$exist_reports_sql = "select count(*) as reports_count from reports where ((dt = ? and hr >= ?) or (dt > ?) ) and obj_id = ?";
		$update_obj_status_sql = "update objects set status=? where obj_id = ?";
	
		$obj_status = 'Normal'; #'Normal','UnWached','Warning','Error'
		if ((int)($cur_row['type']) == 1) { #小时级
			$pre_time = $cur_time - 3600*3; #看前三个小时是否有报警
		}elseif ((int)($cur_row['type']) == 2) {  #2 天级
			$pre_time = $cur_time - 86400*3; #看前三天是否有报警
		}else {   #没有数据的
			$obj_status = 'UnWached';
			if ($obj_status != $cur_row['status']){
				$command = Yii::app()->db->createCommand($update_obj_status_sql);
				$command->bindParam(1, $obj_status, PDO::PARAM_STR);
				$command->bindParam(2, $obj_id, PDO::PARAM_INT);
				$command->execute();
			}
			return 0;
		}
		$pre_dt = date('Y-m-d', $pre_time);
		$pre_hr = (int)(date('H',$pre_time));
		$command = Yii::app()->db->createCommand($exist_reports_sql);
		$command->bindParam(1, $pre_dt, PDO::PARAM_STR);
		$command->bindParam(2, $pre_hr, PDO::PARAM_INT);
		$command->bindParam(3, $pre_dt, PDO::PARAM_STR);
		$command->bindParam(4, $obj_id, PDO::PARAM_INT);
		$reports_row = $command->queryRow();

		$command = Yii::app()->db->createCommand($exist_alarms_sql);
		$command->bindParam(1, $obj_id, PDO::PARAM_INT);
		$alarms_row = $command->queryRow();
		if ((int)($reports_row['reports_count']) == 0) {
			$obj_status = 'Warning';
		}
		if ((int)($alarms_row['alarms_count']) > 0) {
			$obj_status = 'Error';
		}
		
		if ($obj_status != $cur_row['status']) {
			$command = Yii::app()->db->createCommand($update_obj_status_sql);
			$command->bindParam(1, $obj_status, PDO::PARAM_STR);
			$command->bindParam(2, $obj_id, PDO::PARAM_INT);
			$command->execute();
		}
	}



}
