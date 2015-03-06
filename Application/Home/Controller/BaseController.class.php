<?php
/**
 * 
 */
namespace Home\Controller;
use Think\Controller;

class BaseController extends Controller {
        public function __construct(){
                parent::__construct();
        }

        protected function _initialize(){
                $access = CONTROLLER_NAME."_".ACTION_NAME;

                return true;
                
                $unckeck_controllers = explode(',',C("UNCKECK_CONTROLLER"));
                $uncheck_access = explode(',',C("UNCHECK_ACCESS"));
                if(in_array(CONTROLLER_NAME, $unckeck_controllers) || in_array($access, $uncheck_access)) return true;
                if(!session("?permission")){
                        redirect(U("Index/index"),3,"您尚未登录");
                        exit;
                }

                $permission = explode(",", session("permission"));
                if(!in_array($access, $permission)){
                        redirect(U("System/userList"),3,"您没有权限访问这个页面");
                        exit;
                }
                $this->_initUserInfo();
        }

        private function _initUserInfo(){
                 $permission = session('permission');
                 $menu_mod = D('menu');
                 $userMenu = $menu_mod->getUserMenu($permission);
                 $Modules = $menu_mod->getModuleList();
                 /*获取玩家的菜单信息*/
                 $menus = array();
                 foreach ($userMenu as $key => $value) {
	if(!isset($menus[$value['module_id']])){
	        $menus[$value['module_id']] = $Modules[$value['module_id']];
	        $menus[$value['module_id']]['children']	= array();
	}
                 	$menus[$value['module_id']]['children'][$value['pid']] = $value;
                }
                /*对模块进行按权重排序*/
                usort($menus, 'sortByWeight');
                $this->assign("menus",$menus);

                $this->_setPlatform();
        }

        protected function _setPlatform(){
                $game_server_mod = D("GameServer");
                $current_server = session("current_server");
                $condition['ServerCode'] = $current_server;  
                $userPlatForm = $game_server_mod->getUserServerInfo($condition);
                $this->assign("userPlatForm",$userPlatForm);
        }
}