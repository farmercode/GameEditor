<?php

namespace Home\Model;
use Think\Model;

class CardPackageModel extends Model{

        protected $connection       =   'SGGAME_DB';
        // 实际数据表名（包含表前缀）
        protected $trueTableName    =   'CardTable';

        function getPlayerCardsByCharId($charid){
                $condition['CharId'] = $charid;
                $condition['CardKey'] = array("gt",0);
                $list = $this->where($condition)
                                ->order("Slot")
                                ->select();
                return $list;
        }

}