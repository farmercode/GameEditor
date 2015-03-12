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

        /**
         * 添加掉落
         */
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

        /**
         * 导入Excel页面
         */
        function improtFromExcel(){
                $this->display();
        }

        /**
         * 处理导入Excel
         */
        function doImportFromExcel(){
                $rootPath = ROOT_PATH."/data/upload/excel/";
                $upload = new \Think\Upload();
                $upload->exts      =     array('xls','xlsx');
                $upload->rootPath = $rootPath;
                //$upload->savePath = ROOT_PATH."/data/upload/excel/";
                $upload->autoSub  = true;
                $upload->subName  = array('date','Ymd');
                $info   =   $upload->upload();

                if(!$info) {// 上传错误提示错误信息
                        $this->error($upload->getError());
                        exit();
                }

                $filePath = $rootPath.$info['excel']['savepath'].$info['excel']['savename'];
                
                vendor("Excel.PHPExcel");
                $PHPReader = new \PHPExcel_Reader_Excel5();  
                if(!$PHPReader->canRead($filePath)){         
                        echo 'no Excel';  
                         return ;   
                }  
                $PHPExcel = $PHPReader->load($filePath);
                $activeSheet = $PHPExcel->getSheet();
                $importData = $activeSheet->toArray();
                
                /*添加到数据库*/
                //print_r($importData);
                unset($importData[0]);
                unset($importData[1]);
                unset($importData[2]);
                $data = array();
                $doInsert = false;
                $index = 0;
                foreach ($importData as $key => $value) {
                        if(empty($value[0])) break;
                        $doInsert = true;
                        $data[$index]['atlasloot_id'] = $value[0];
                        $data[$index]['atlasloot_num'] = $value[1];
                        $data[$index]['content'] = $value[2];
                        $data[$index]['atlasloot_name'] = $value[3];
                        $data[$index]['data'] = $this->_contentToJson($value[2]);
                        $index++;
                }
                
                if($doInsert){
                        $model = D("Atlasloot");
                        $result = $model->addAll($data);                
                }
                unlink($filePath);
                redirect(U("Atlas/index"));
        }

        /**
         * excel导出
         */
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

        private function _contentToJson($str){
                $tmp1 = explode("|",$str);
                $json_data = array();
                $index=0;
                foreach ($tmp1 as $key => $value) {
                        $tmp2 = explode(",",$value);
                        $json_data[$index]["loot_id"] = $tmp2[0];
                        $json_data[$index]["lvl"] = $tmp2[1];
                        $json_data[$index]["type"] = $tmp2[2];
                        $json_data[$index]["min"] = $tmp2[3];
                        $json_data[$index]["max"] = $tmp2[4];
                        $json_data[$index]["is_alone"] = $tmp2[5];
                        $json_data[$index]["probability"] = $tmp2[6];
                        $index++;
                }
                return json_encode($json_data);
        }
}