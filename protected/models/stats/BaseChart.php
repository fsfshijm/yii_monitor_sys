<?php

class BaseChart extends CFormModel
{
	public function fillData($data, $datasize, $start_time, $start_dt, $start_hr, $cycle) {
		$retdata = array();
		#die();
		foreach($data as $row){
			$real_data = $this->parseContent($row['content_map']);
			foreach($real_data as $x=>$x_value) {
				if (!array_key_exists($x,$retdata)){
					$retdata[$x] = array_fill(0, $datasize, 0);
				}
			}
		}
		/*$retdata = array(
			'bytes_read' => array_fill(0, $datasize, 0),
			'message_sent' => array_fill(0, $datasize, 0),
		);*/
		$unitmap = array(
			3600 => '小时',
			86400 => '天',
		);
		// 初始的时间比开始时间早一个周期
		$cur_time = $start_time-$cycle;
		if ($cycle == 86400) {
			$retdata = $this->fill_day_cycle_data($data, $retdata, $cycle, $cur_time);
		}
		else {
		$offset = 0;
		foreach ($data as $d) {
			$dt = explode('-',$d['dt']);
			$row_time = mktime((int)($d['hr']),0,0,$dt[1],$dt[2],$dt[0]);
			if ($row_time-$cur_time > $cycle) {
				# 有丢失的数据，补充0
				$offset += ($row_time-$cur_time)/$cycle-1;
			}
			$real_data = $this->parseContent($d['content_map']);
			foreach($real_data as $x=>$x_value) {
				$retdata[$x][$offset] = (int)($x_value);
			}
			$offset += 1;
			$cur_time = $row_time;
		}
		}

		$unit = $unitmap[$cycle];
		$ret = array(
			'data' => $retdata,
			'data_keys' =>array_keys($retdata),
			'start_time' => ($start_time+8*3600)*1000,
			'cycle' => $cycle*1000,
			'unit' => $unit,
		);

		return $ret;
	}
	
	public function fill_day_cycle_data($data, $retdata, $cycle, $cur_time)
	{
		$offset = 0;
		#var_dump(count($data));
		foreach ($data as $d) {
			$dt = explode('-',$d['dt']);
			$row_time = mktime((int)($d['hr']),0,0,$dt[1],$dt[2],$dt[0]);
			if ($row_time-$cur_time > $cycle) {
				# 有丢失的数据，补充0
				$offset = floor(($row_time-$cur_time)/$cycle)-1;
			}
			$real_data = $this->parseContent($d['content_map']);
			foreach($real_data as $x=>$x_value) {
				$retdata[$x][$offset] += (int)($x_value);
			}
		}
		return $retdata;
	}

	public function parseContent($str)
	{
		#str: "{'logtailer': 141201, 'nginx': 141337, 'dispatcher': 141871, 'mysql': 141870}";
		#$b = explode(',',explode('}', explode('{',$str)[1])[0]);
		$b = explode('{',$str);
		$b = explode('}',$b[1]);
		$b =explode(',', $b[0]);
		$c = array();
		foreach($b as $value){
		        $tmp = explode(':', $value);
		        $key = explode("'",$tmp[0]);
		        $c[$key[1]] = (int)($tmp[1]);
		        #$c[explode("'",$tmp[0])[1]] = (int)($tmp[1]);
		}
		return $c;
	}		




}
