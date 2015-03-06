<?php

namespace Home\Controller;

class JsController extends BaseController{

        function userPlatForm(){
                $game_server_mod = D("GameServer");
                $user_info = session("user_info");
              
                $userPlatForm = $game_server_mod->getUserServerList($user_info['game_platform']);
                
                $dataList = array();
                foreach ($userPlatForm as $version => $platforms) {
                        $dataList[$version] = array();
                        foreach ($platforms as $ptCode => $platform) {
                                $dataList[$version][$ptCode]['name'] = $platform['name'];
                              foreach ($platform['servers'] as $key => $value) {
                                     $dataList[$version][$ptCode]['servers'][$value['ServerCode']] = $value['ServerName'];
                              }
                        }
                }
          
                echo "var select_data = ".json_encode($dataList);

        }
}