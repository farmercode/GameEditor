<?php

namespace Home\Model;
use Think\Model;

class EquipInfoModel extends Model{

        function getEquipListByEquipIDs($equipIDs){
                $condition['equip_id'] = array("in",$equipIDs);
                $data = $this->where($condition)
                                        ->select();
                $list = array();
                foreach ($data as $key => $value) {
                        $list[$value['equip_id']] = $value;
                }
                return $list;
        }
}