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
                vendor("Excel.PHPExcel");
                $model = D("Atlasloot");
                $list = $model->getAtlasLootList();
                //print_r($list);
                
                /*格式化数据*/
                $index=0;
                $data[$index] = C("EXPORT_EXCEL_HEADER1");
                $index++;
                $data[++$index] = array();
                $data[++$index] = array();
                foreach ($list as $key => $value) {
                        $loot_tmp = json_decode($value["data"],true);
                       $data[$index][] = $value["atlasloot_id"];
                       $data[$index][] = $value["atlasloot_num"];
                       $data[$index][] = $value["content"];
                       $data[$index][] = $value["atlasloot_name"];
                       $data[$index][] = null;
                       $data[$index][] = null;
                       foreach ($loot_tmp as $v) {
                               foreach ($v as $v1) {
                                       $data[$index][] = $v1;
                               }
                       }
                       $index++;
                }
                // print_r($data);
                // exit();

                $phpexcel = new \PHPExcel();
                //$activeSheetIndex = $phpexcel->getActiveSheetIndex();
                $activeSHeet = $phpexcel->getActiveSheet();
                $activeSHeet->fromArray($data,null,"A1",true);

                $objWriter = \PHPExcel_IOFactory::createWriter($phpexcel, 'Excel5');
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment; filename=game_config.xls');
                header('Pragma: no-cache');
                header('Expires: 0');
                $objWriter->save("php://output");
        }
}