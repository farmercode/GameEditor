<?php

namespace Home\Model;
use Think\Model;

class PlayerActionLogModel extends Model{
        function getPlayerActionList($condition){
                $where =  "oper_type = '".$condition['type']."'";
                $where.= " AND server_code='".session("current_server")."'";
                if(isset($condition['start_time']) AND empty($condition['start_time'])){
                        $where.=" AND login_date >= '".$condition['start_time']."'";
                }
                if(isset($condition['end_time']) AND empty($condition['end_time'])){
                        $where.=" AND login_date <= '".$condition['end_time']."'";
                }
                
                $field = "COUNT(1) AS num,login_date";
                $sql = "SELECT $field FROM (SELECT DISTINCT(charid),login_date FROM h_player_action_log where {$where}) tmp GROUP BY tmp.login_date;";
                $data = $this->db->query($sql);
                return $data;
        }

        function getPlayerActionByDay($type,$day){
                $condition['login_date'] = $day;
                $condition['oper_type'] = $type;
                $condition['server_code'] = session("current_server");
                $data = $this->where($condition)
                                ->order("login_time")
                                ->select();

                return $data;
        }
}