<?php

namespace Home\Model;
use Think\Model;

class PropInfoModel extends Model{

        function getPropListByPropId($ItemIDs){
                $condition['prop_id'] = array("in",$ItemIDs);
                $data = $this->where($condition)
                                        ->select();
                $list = array();
                foreach ($data as $key => $value) {
                        $list[$value['prop_id']] = $value;
                }
                return $list;
        }
}