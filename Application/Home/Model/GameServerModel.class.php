<?php

namespace Home\Model;
use Think\Model;

class GameServerModel extends Model{

        protected $trueTableName="GameServer";

        /**
         * 配置服务器dsn
         * @var string
         */
        protected $connection = 'mysql://game_config:b20n93s31@192.168.0.240:3308/game_config#UTF8';

        /**
         * 获得当前所有可用平台
         * @return array 平台列表数组
         */
        function getAllPlatform(){
                $condition['GameCode'] = C("GAME_CODE");
                $field = "distinct(gs.SiteCode),s.SiteName";
                $join = "Site s ON (gs.SiteCode=s.SiteCode AND IsActive = 'YES')";
                $list = $this->field($field)
                                ->alias('gs')
                                ->join($join)
                                ->where($condition)
                                ->select();
                return $list;
        }


       function  getUserServerList($user_server_codes){
                $condition['gs.SiteCode'] = array('in',$user_server_codes);
                $condition['gs.GameCode'] = C("GAME_CODE");
                $field = "gs.*,s.SiteName";
                 $join = "Site s ON (gs.SiteCode=s.SiteCode AND IsActive = 'YES')";
                $dataList = $this->field($field)
                                        ->alias('gs')
                                        ->join($join)
                                        ->where($condition)
                                        ->select();
               $data = array();
               foreach ($dataList as $value) {
                      $data[$value['Version']][$value['SiteCode']]['name'] = $value['SiteName'];
                      $data[$value['Version']][$value['SiteCode']]['servers'][] = $value;
               }
               
                return $data;
       }

       /**
        * 获得服务器信息
        * @param  array 搜索服务器条件
        * @return array
        */
       function getUserServerInfo($condition){
            $condition['Status'] = array("neq","CLOSE");
            $condition['GameCode'] = C("GAME_CODE");
            $server_info = $this->where($condition)
                                        ->find();
            //echo $this->getLastSql();
            return $server_info;
       }

}