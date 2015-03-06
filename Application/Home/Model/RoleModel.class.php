<?php

namespace Home\Model;
use Think\Model;

class RoleModel extends Model{

	protected $pk	= 'role_id';

	function getRoleList(){
		$condition['is_delete'] = 1;
		$data = $this->where($condition)
					->order("order_weight")
					->select();
		
		$list = array();
		foreach ($data as $key => $value) {
			$list[$value[$this->pk]] = $value;
		}
		
		return $list;
	}

	
}