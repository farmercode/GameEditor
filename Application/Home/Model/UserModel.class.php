<?php

namespace Home\Model;
use Think\Model;

class UserModel extends Model{
        protected $pk = "user_id";

        function updateByUserID($userid,$data){
                $condition['user_id'] = $userid;
                $result = $this->where($condition)->save($data);
                return $result;
        }
}
