<?php

namespace Home\Controller;
use Think\Controller;

class PlayerController extends BaseController{

        function test(){
             $mod = D("account");
             $data = $mod->test();
             print_r($data);
        }

        function queryInfo(){
                if(IS_POST){
                        $player_mod = D("Player");
                        $query['type'] = I("post.query_type");
                        $query['content'] = trim(I("post.query_content"));
                        $info = $player_mod->queryPlayerInfo($query);
                        $this->_queryCardPackage($info);
                        $this->_queryEquipPackage($info);
                        $this->_queryPropPackage($info);
                        $this->assign("player",$info);
                        $this->assign("query",$query);
                }
                $this->display();
        }

        /**
         * 查询玩家卡牌背包信息
         * @param  array $playerInfo 玩家信息数组
         * @return void
         */
        function _queryCardPackage($playerInfo){
            if(empty($playerInfo)) return;

            $card_pkg_mod = D("CardPackage");
            $card_info_mod = D("CardInfo");
            $card_list  = $card_pkg_mod->getPlayerCardsByCharId($playerInfo['CharId']);
            $CardKeys =array();
            foreach ($card_list as $value) {
                $CardKeys[]=$value['CardKey'];
            }
            $card_info_list = $card_info_mod->getCardListByGeneralID($CardKeys);
            //print_r($card_list);
            $this->assign("card_list",$card_list);
            $this->assign("card_info_list",$card_info_list);
        }

        /**
         * 查询玩家装备背包信息
         * @param  array $playerInfo 玩家信息数组
         * @return void
         */
        function _queryEquipPackage($playerInfo){
            if(empty($playerInfo)) return;

            $equip_pkg_mod = D("EquipPkg");
            $equip_info_mod = D("EquipInfo");
            $equip_list = $equip_pkg_mod->getPlayerEquipsByCharId($playerInfo['CharId']);
            $ItemKeys = array();
            foreach ($equip_list as $value) {
                $ItemKeys[] = $value['ItemId'];
            }
            $equip_info = $equip_info_mod->getEquipListByEquipIDs($ItemKeys);
            $this->assign("equip_list",$equip_list);
            $this->assign("equip_info",$equip_info);
        }

        function _queryPropPackage($playerInfo){
            if(empty($playerInfo)) return;

            $prop_pkg_mod = D("PropPackage");
            $prop_info_mod = D("PropInfo");
            $prop_list = $prop_pkg_mod->getPropListByCharId($playerInfo['CharId']);
            $ItemIDs = array();
            foreach ($prop_list as $value) {
                $ItemIDs[] = $value['ItemId'];
            }
            $prop_info = $prop_info_mod->getPropListByPropId($ItemIDs);
            //print_r($prop_list);
            $this->assign("prop_list",$prop_list);
            $this->assign("prop_info",$prop_info);
        }
}