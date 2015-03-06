<?php

namespace Home\Model;
use Think\Model;

class PayRecordModel extends Model{

        function checkOrderRecord($order_info){
                $condition['order_sn'] = $order_info['order_sn'];
                $condition['server_code'] = $order_info['server_code'];

                $count = $this->where($condition)->count();

                return $count>0;
        }

        /**
         * 获得制定日期内的充值列表
         * @param  array $query [description]
         * @return [type]        [description]
         */
        function getPayListViaDay($query){
                $field = "amount,gold,create_time";
                $group = "create_time";
                $condition['state'] = 2;
                $condition['server_code'] = session("current_server");
                $condition['create_time'] = array("gt",strtotime($query['startTime']));
                $time_query['create_time']=array("lt",strtotime($query['endTime']));
                $condition['_complex'] = $time_query;

                $data = $this->field($field)
                                        ->where($condition)
                                        ->order("create_time")
                                        ->select();                         
                //echo $this->getLastSql();
                return $data;                                 
        }

        function getPayAmountViaMonth($query){
               $where = 'state=2';
                if($query['queryType'] == 1){
                        $where.= ' AND server_code="'.session("current_server").'"';
                }
                $where .=" AND FROM_UNIXTIME(create_time,'%Y-%m')='".$query["queryMonth"]."'";
                $field="SUM(amount) totalAmount,FROM_UNIXTIME(create_time,'%Y-%m') create_date";
                $sql = "SELECT $field FROM ".$this->getTableName()." WHERE $where";
                $data = $this->query($sql);
                return $data;
        }
}
