<?php

namespace Home\Model;
use Think\Model;

class GamePayRecordModel extends Model{

        protected $trueTableName = "PayRecord";

        protected $connection       =   'SGGAME_DB';

        function addRecordViaServer($server,$data){
                if(isset($data['state'])) unset($data['state']);
                if(isset($data['platform'])) unset($data["platform"]);
                $result = $this->add($data);
                return $result;
        }


        function getRecordListViaMin($day){
                $tables = $this->getTableName()." pr";
                $join = "LEFT JOIN CharTable player";
                $on = "ON pr.player_id=player.CharId";
                $condition = "FROM_UNIXTIME(create_time,'%Y-%m-%d')='$day'";
                $condition.=' AND server_code="'.session("current_server").'"';
                $field = "pr.create_time,player.CharName,pr.amount,pr.gold";
                $order = "create_time";
                
                $sql = "SELECT $field FROM $tables $join $on WHERE $condition ORDER BY $order";   
                $data = $this->query($sql);
                return $data;
        }
}
