<?php

namespace Home\Model;
use Think\Model;

class LogFileInfoModel extends Model{

	function get_logfile_by_path($filepath){
		$where['file_path'] = $filepath;
		$result = $this->where($where)->find();
		
		return $result;
	}
}