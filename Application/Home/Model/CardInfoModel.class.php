<?php

namespace Home\Model;
use Think\Model;

class CardInfoModel extends Model{

        function getCardListByGeneralID($generalIDs){
                $condition['general_id'] = array("in",$generalIDs);
                $data = $this->where($condition)
                                        ->select();
                $list = array();
                foreach ($data as $key => $value) {
                        $list[$value['general_id']] = $value;
                }
                return $list;
        }
}