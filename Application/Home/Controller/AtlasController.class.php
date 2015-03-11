<?php

namespace Home\Controller;
use Think\Controller;

class AtlasController extends Controller{

        function index(){
                $model = D("Atlasloot");
                $list = $model->getAtlasLootList();

                $this->assign("list",$list);
                $this->display();
        }

        function atlasLootAdd(){
                $lootTypes = C("LOOTTYPES");
                //print_r($lootTypes);
                $this->assign("LootTypes",$lootTypes);
                $this->display();
        }

        function doAtlasLootAdd(){
                if(IS_POST){
                        $model = M("Atlasloot");
                        $lootInfo = $this->_getLootInfo();
                        $data['atlasloot_id'] = I("AtlasLootID");
                        $data['atlasloot_name'] = I("AtlasLootName");
                        $data['atlasloot_num'] = I("AtlasLootNun");
                        $data['content'] = $lootInfo['config_str'];
                        $data['data'] = $lootInfo['config_json'];
                        $a_id = $model->add($data);
                        if(!$a_id){
                                $msg = $model->getDbError();
                                redirect(U("Atlas/index"),3,$msg);
                        }else{
                                redirect(U("Atlas/index"));
                        }
                }
        }

        /**
         * 获得掉落物品信息
         * @return array
         */
        private function _getLootInfo(){
                $loot_add = I("loot_add");
                $data = array();
                $json_data = array();
                $config_data = array();
                foreach ($loot_add['type'] as $key => $value) {
                        $json_data[$key] = array(
                                "loot_id"=>$loot_add['ID'][$key]?$loot_add['ID'][$key]:0,
                                "lvl" => $loot_add['level'][$key]?$loot_add['level'][$key]:0,
                                "type" => $loot_add["type"][$key]?$loot_add["type"][$key]:0,
                                "min"   => $loot_add["min_num"][$key]?$loot_add["min_num"][$key]:0,
                                "max"   => $loot_add["max_num"][$key]?$loot_add["max_num"][$key]:0,
                                "is_alone"      => $loot_add["is_alone"][$key]?$loot_add["is_alone"][$key]:0,
                                "probability"   => $loot_add["probability"][$key]?$loot_add["probability"][$key]:0
                                );
                        $config_data[$key] = implode(",",$json_data[$key]);
                }
                $data["config_str"] = implode("|",$config_data);
                $data['config_json'] = json_encode($json_data);
                
                return $data;
        }

        function exportToExcel(){
                $model = D("Atlasloot");
                $list = $model->getAtlasLootList();

                print_r($list);
        }
}