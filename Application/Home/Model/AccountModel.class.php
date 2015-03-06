<?php

namespace Home\Model;
use Think\Model;

class AccountModel extends Model{


        protected $trueTableName = "AccountTable";

        protected $connection       =   'SGGAME_DB';

        function test(){
                $condition = array("");
                $data = $this->where()->limit(10)->select();
                print_r($data);
        }
}