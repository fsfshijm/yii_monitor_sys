<?php

class MonitorChart extends BaseChart
{
	private $id;
	private $span;

	public function __construct($id, $span) {
		$this->id = $id;
		$this->span = $span;
	}

	public function loadData() {
		$now = time();
		if ($this->span == 12) {
			$start_time = ($now-$now%3600)-3600*$this->span;
			$after_dt = date('Y-m-d', $start_time + 86400);
			$start_dt = date('Y-m-d', $start_time);
			$start_hr = (int)(date('H', $start_time));
			$cycle = 3600;
			$datasize = 12;
			#$sql = "SELECT content_map, dt, hr from reports where dt >=? and hr>=? and obj_id=?";
			$sql ="select content_map, dt, hr from reports where ((dt = ? and hr >=?) or (dt >= ?)) and obj_id = ? order by dt, hr";
		}
		elseif ($this->span == 24) {
			$start_time = ($now-$now%3600)-86400;
			$after_dt = date('Y-m-d', $start_time + 86400);
			$start_dt = date('Y-m-d', $start_time);
			$start_hr = (int)(date('H', $start_time));
			$cycle = 3600;
			$datasize = 24;
			#$sql = "SELECT content_map, dt, hr from reports where dt >=? and hr>=? and obj_id=?";
			$sql ="select content_map, dt, hr from reports where ((dt = ? and hr >=?) or (dt >= ?)) and obj_id = ? order by dt, hr";
		}
		elseif ($this->span == 48) {
			$start_time = ($now-$now%3600)-3600*$this->span;
			$after_dt = date('Y-m-d', $start_time + 86400);
			$start_dt = date('Y-m-d', $start_time);
			$start_hr = (int)(date('H', $start_time));
			$cycle = 3600;
			$datasize = 48;
			#$sql = "SELECT content_map, dt, hr from reports where dt >=? and hr>=? and obj_id=?";
			$sql ="select content_map, dt, hr from reports where ((dt = ? and hr >=?) or (dt >= ?)) and obj_id = ? order by dt, hr";
		}
		elseif ($this->span == 24*7) {
			// 一周
			$cycle = 3600;
			$start_time = ($now-$now%$cycle)-3600*$this->span;
			$after_dt = date('Y-m-d', $start_time + 86400);
			$start_dt = date('Y-m-d', $start_time);
			$start_hr = (int)(date('H', $start_time));
			$datasize = 7*24;
			#$sql = "SELECT content_map, dt, hr from reports where dt >=? and hr>=? and obj_id=?";
			$sql ="select content_map, dt, hr from reports where ((dt = ? and hr >=?) or (dt >= ?)) and obj_id = ? order by dt, hr";
		}
		elseif ($this->span == 31*24) {
			// 一月
			$cycle = 86400;
			$start_time = ($now-$now%$cycle)-3600*8-3600*$this->span;
			$after_dt = date('Y-m-d', $start_time + 86400);
			$start_dt = date('Y-m-d', $start_time);
			$start_hr = date('H', $start_time);
			$start_hr = 0;
			$datasize = 32;
			$sql ="select content_map, dt, hr from reports where ((dt = ? and hr >=?) or (dt >= ?)) and obj_id = ? order by dt, hr";
		}
		elseif ($this->span == 31*24*6) {
			// 一月
			$cycle = 86400;
			$start_time = ($now-$now%$cycle)-3600*8-3600*$this->span;
			$after_dt = date('Y-m-d', $start_time + 86400);
			$start_dt = date('Y-m-d', $start_time);
			$start_hr = date('H', $start_time);
			$start_hr = 0;
			$datasize = 31*6 +1;
			$sql ="select content_map, dt, hr from reports where ((dt = ? and hr >=?) or (dt >= ?)) and obj_id = ? order by dt, hr";
		}
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(1, $start_dt, PDO::PARAM_STR);
		$command->bindParam(2, $start_hr, PDO::PARAM_INT);
		$command->bindParam(3, $after_dt, PDO::PARAM_STR);
		$command->bindParam(4, $this->id, PDO::PARAM_INT);
		$data = $command->queryAll();
		$ret = $this->fillData($data, $datasize, $start_time, $start_dt, $start_hr, $cycle);
		return $ret;
	}
}
