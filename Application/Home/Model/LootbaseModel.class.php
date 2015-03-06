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
        
}