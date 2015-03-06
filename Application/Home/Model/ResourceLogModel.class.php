<?php

namespace Home\Model;
use Think\Model;

class ResourceLogModel extends Model{

/**
 * 资源消耗概况
 * @param  array $condition 查询资源消耗条件
 * @return array
 */
function expendResourceSurvey($condition){
        $field = "reason,SUM(number) as expend_num,COUNT(1) as person_time";
        $where["restype"] = $condition['resType'];
        $where["oper"] = $condition['oper'];
        $where['logtime'] = array("between",array(strtotime($condition['startTime']),strtotime($condition['endTime'])));
        $data = $this->field($field)
        	->group("reason")
        	->where($where)
        	->select();
        return $data;
}

/**
 * 玩家消耗资源查询
 * @param  array $condition 查询资源条件
 * @return array
 */
function roleResQuery($condition){
        $field = "`charid`,SUM(`number`) as total_number";
        $where['restype'] = $condition['resType'];
        $where['oper'] = $condition['oper'];
        $time = array();
        if(isset($condition['startTime']) && !empty($condition['startTime'])){
               $time[] = array("gt",strtotime($condition['startTime']));
       }
       if(isset($condition['endTime']) && !empty($condition['endTime'])){
               $time[] = array("lt",strtotime($condition['endTime']));
       }
       $time_num = count($time);
       if($time_num == 2){
               $where['logtime'] = $time;
       }else if($time_num == 1){
               $where['logtime'] = $time[0];
       }
       $data = $this->field($field)
       	->where($where)
       	->group("charid")
	->order("total_number DESC")
	->limit(500)
	->select();
        /*获得玩家名称*/
        $player_mod = D("player");
        foreach ($data as $value) {
                $player_ids .=$value["charid"].","; 
        }
        $player_ids = trim($player_ids,',');
        $playerList = $player_mod->getPlayersByIds($player_ids);
  
        foreach ($data as & $value) {
                $value['playerName'] = $playerList[$value['charid']]['CharName'];
        }

        return $data;
}
}