<?php

namespace Home\Model;
use Think\Model;

/**
* 
*/
class LootbaseModel extends Model
{
        
        function getLootList(){
                $data = $this->select();
                return $data;
        }

        function getLootsJsonData(){
                $result = $this->order("loot_type ASC,loot_id ASC")
                                        ->select();
                $data = array();
                foreach ($result as $value) {
                        $type = $value['loot_type'];
                        $data[$type][$value['loot_id']] = array('id'=>$value['loot_id'],'name'=>$value['loot_name'],'img'=>$value
                                ['img_info']);
                }
                //print_r($data);
                return json_encode($data);
        }
        
}