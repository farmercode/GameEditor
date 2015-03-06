<?php

namespace Home\Controller;

use Think\Controller;

class AjaxController extends BaseController{

        /**
         * 选择服务器
         */
        function choseServer(){
                $user_info = session("user_info");
                $user_mod = D("user");
                $user_platform = explode(',', $user_info['game_platform']);
                $game_server_mod = D("GameServer");
                $server_code = I("post.code");
                $condition['ServerCode'] = $server_code;                
                $server_info = $game_server_mod->getUserServerInfo($condition);
                if(in_array($server_info['SiteCode'], $user_platform)){
                        session("current_server",$server_code);
                        session("cur_server_name",$server_info['ServerName']);
                        $user_mod->updateByUserID($user_info['user_id'],array("current_server"=>$server_code));
                        $this->ajaxReturn(array("status"=>1));
                }else{
                        $this->ajaxReturn(array("status"=>0));
                }
        }
}
