<?php

namespace Home\Model;
use Think\Model;

class SystemMailModel extends Model{

        protected $connection       =   'SGGAME_DB';
        // 实际数据表名（包含表前缀）
        protected $trueTableName    =   'SystemMail';

}