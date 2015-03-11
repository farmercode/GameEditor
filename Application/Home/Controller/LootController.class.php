<?php
namespace Home\Controller;
use Think\Controller;

class LootController extends Controller{

        /**
         * 添加物品
         */
        function lootAdd(){
                $lootTypes = C("LOOTTYPES");
                //print_r($lootTypes);
                $this->assign("LootTypes",$lootTypes);
                $this->display();
        }

        function submitLoot(){
                if(IS_POST){
                        $model = D("Lootbase");
                        $data['loot_id'] = intval(I("LootID"));
                        $data['loot_name'] = I("LootName");
                        $data['loot_type'] = intval(I("LootType"));
                        $data['img_info'] = get_player_img($data['loot_id'],$data['loot_type']);
                        $result = $model->add($data);
                        redirect(U("Loot/lootList"));
                }
        }

        /**
         * 物品编辑
         */
        function lootEdit(){
                $aid = intval(I("aid"));
                $lootTypes = C("LOOTTYPES");
                $model = D("Lootbase");

                $lootInfo = $model->find($aid);
                $this->assign("lootInfo",$lootInfo);
                $this->assign("LootTypes",$lootTypes);
                $this->display();
        }

        function doLootEdit(){
                 if(IS_POST){
                       $model = D("Lootbase");
                       $data['loot_id'] = intval(I("LootID")); 
                       $data['loot_name'] = trim(I("LootName"));
                       $data['loot_type'] = intval(I("LootType"));
                       $data['img_info'] = get_player_img($data['loot_id'],$data['loot_type']);
                       $condition['auto_id'] = intval(I("auto_id"));
                       $result = $model->where($condition)->save($data);
                       redirect(U("Loot/lootList"));
                 }
        }

        /**
         * 物品列表
         */
        function lootList(){                
                $model = D("Lootbase");
                $lootTypes = C("LOOTTYPES");
                $list = $model->getLootList();
                //print_r($list);
                $this->assign("LootTypes",$lootTypes);
                $this->assign("list",$list);
                $this->display();
        }

        function excelImport(){
                $lootTypes = C("LOOTTYPES");

                 $this->assign("LootTypes",$lootTypes);
                $this->display();
        }

        
        
        /**
         * 导入Excel数据到数据表
         */
        function doExcelImport(){
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
                $allColumn = $activeSheet->getHighestColumn();     
                $allRow = $activeSheet->getHighestRow();
                $all = array();
                $importData = $activeSheet->toArray();
                unlink($filePath);
                /*添加到数据库*/
                unset($importData[0]);
                $data = array();
                $doInsert = false;
                foreach ($importData as $key => $value) {
                        if(empty($value[0])) break;
                        $doInsert = true;
                        $index = $key-1;
                        $data[$index]['loot_id'] = $value[0];
                        $data[$index]['loot_name'] = $value[1];
                        $type = $value[2]?$value[2]:intval(I("LootType"));
                        $data[$index]['loot_type'] = $type;
                        $data[$index]['img_info'] = get_player_img($value['0'],$type);
                }
                        
                if($doInsert){
                        $model = D("Lootbase");
                        $result = $model->addAll($data);                
                }
                
        }

        /**
         * 删除物品
         * @此处请特别注意，此处由于做的是物理的数据删除，不是逻辑删除
         */
        function lootDel(){
                $model = D("Lootbase");
                $condition['auto_id'] = intval(I("auto_id"));
                $result = $model->where($condition)->delete();
                redirect(U("Loot/lootList"));
        }
}
