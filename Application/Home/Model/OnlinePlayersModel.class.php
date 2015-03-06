<?php

namespace Home\Model;
use Think\Model;
class OnlinePlayersModel extends Model{

        /**
         * 获得在线玩家列表
         * @param  array $condition [description]
         * @return [type]            [description]
         */
        function getOnlinePlayersList($condition){
               $startTime = strtotime($condition['queryDate']);
               $endTime = $startTime+3600*24;
               $where['server_code'] = $condition['server_code'];
               $where['logtime'] = array("between","$startTime,$endTime");
               $data = $this->where($where)
                                        ->order("logtime")
                                        ->select();                
                $dataList = create_filled_array_with_interval(0,$startTime,60*24,60);

                foreach ($data as $value) {
                    $dataList[$value['logtime']] = intval($value['count']);
                }
                return $dataList;
        }
}