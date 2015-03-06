<?php

namespace Home\Model;
use Think\Model;

class SystemMailTmpModel extends Model{

        protected $connection       =   'SGGAME_DB';
        // 实际数据表名（包含表前缀）
        protected $trueTableName    =   'SystemMailTmp';

        function getMailList($query){
                $condition['server_code'] = session("current_server");
                $condition['is_delete'] = 1;
                $list = $this->where($condition)->order("mail_id desc")->select();

                return $list;
        }

        function getMailInfo($mail_id){
                $condition['mail_id'] = $mail_id;
                $field="CharId,Title,Content";
                $mail_info = $this->field($field)->where($condition)->find();
                return $mail_info;
        }
}