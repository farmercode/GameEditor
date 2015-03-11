<?php
namespace Home\Model;
use Think\Model;

class AtlaslootModel extends Model{

        function getAtlasLootList(){
                $list = $this->order("a_id desc")
                                ->select();
                return $list;
        }
}