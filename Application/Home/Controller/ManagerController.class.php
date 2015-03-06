<?php
/**
 * 运营管理
 */
namespace Home\Controller;
use Think\Controller;

class ManagerController extends BaseController{

        /**
         * 系统邮件
         * @return [type] [description]
         */
        function sysMail(){
                //print_r($_SESSION);
                $mail_tmp_mod = D("SystemMailTmp");
                $mail_list = $mail_tmp_mod->getMailList(null);
                $this->assign("list",$mail_list);
                $this->display();
        }

        function sendSysMail(){
                $mail_id = I("mid");
                $mail_tmp_mod = D("SystemMailTmp");
                if(IS_POST){
                        $mail_mod = D("SystemMail");
                        $base_info = $mail_tmp_mod->getMailInfo($mail_id);                        
                        $base_info['CreateTime'] = time();
                        $base_info['Status'] = 1;
                        $mail_mod->add($base_info);
                        $update['Status'] = 2;
                        $mail_tmp_mod->where("mail_id=$mail_id")->save($update);
                        redirect(U("Manager/sysMail"));
                }
                $mail_info = $mail_tmp_mod->find($mail_id);
                $game_loottypes = C("GAME_LOOTTYPE");
                $this->assign("info",$mail_info);
                $this->assign("lootTypes",$game_loottypes);
                $this->display();
        }

        /**
         * 发送系统邮件
         */
        function newSysMail(){
                if(IS_POST){
                        $mail_tmp_mod = D("SystemMailTmp");
                        $send_range = I("post.send_range");
                        $data = array();

                        $data['Title'] = I("post.title");
                        $data['Content'] = $this->_getMailContent();
                        $data['Status'] = 1;
                        $data['CreateTime'] = time();
                        $data['server_code'] = session("current_server");
                        if($send_range == 2){
                                $data['CharId'] = 0;
                                $data['CharName'] = "全部";
                               
                                $mail_tmp_mod->add($data);                                
                        }else{
                                $player_mod = D("player");
                                $player_list = I("post.player_list");
                                $player_list = str_replace("\r", '', $player_list);
                                $player_list = explode("\n", $player_list);
                                $players = $player_mod->getPlayerIds($player_list);
                          
                                $allData = array();
                                foreach ($players as $key => $value) {
                                        $data['CharId'] = $value["CharId"];
                                        $data['CharName'] = $value["CharName"];
                                        $allData[] = $data;
                                }
                                $mail_tmp_mod->addAll($allData);
                        }
                        
                        redirect(U("Manager/sysMail"));
                }
                $game_loottypes = C("GAME_LOOTTYPE");
                $this->assign("lootTypes",$game_loottypes);
                $this->display();
        }

        /**
         * 获得邮件的内容和附件
         */
        function _getMailContent(){
                $mail_add = I("post.mail_add");
                $content = trim(I("post.mail_body"));
                if(empty($mail_add['ID'])) return $content;
                $add_str="";
                foreach ($mail_add['ID'] as $key => $value) {
                        $add_str .=$value." ".$mail_add['type'][$key]." ".$mail_add['count'][$key]." ";
                }
                return $content."|".$add_str;
        }

        /**
         * 删除邮件
         */
        function delSysMail(){
                $mail_id = I("mailID");
                $mail_tmp_mod = D("SystemMailTmp");

                $condition['mail_id'] = intval($mail_id);
                $data['is_delete'] = 2;
                $mail_tmp_mod->where($condition)->save($data);
                 redirect(U("Manager/sysMail"));
        }
}