<?php

namespace Home\Controller;
use Think\Controller;

class SystemController extends BaseController {

        public function index(){

        }
        /**
         * 添加用户
         */
        public function addUser(){
                if(IS_POST){
                	$data['user_name'] = trim(I('post.username'));
                	$passwd =trim(I('post.userpassword'));
                	$passwd2 =trim(I('post.userpassword2'));
                	if($passwd != $passwd2){
                	        $this->show("两次输入密码不一致！");
                	}else{
	        $data['user_password'] = $passwd;
	}
	$data['last_login_ip'] = get_client_ip();
	$data['last_login_time'] = date("Y-m-d H:i:s");
	$data['role_id'] = I('post.role');
	$data['email'] = trim(I('post.email'));
	$data['phone'] = trim(I('post.phone'));
	$data['real_name'] = trim(I("post.truename"));
	$game_platform = I('post.game_platform');
	$data['game_platform'] = implode(",", $game_platform);
	$user_mod = M("user");
	$result = $user_mod->add($data);
	
	redirect(U("System/userList"));
	exit;
                }
                $role_mod = D("role");
                $game_server_mod = D("GameServer");
                //所有平台列表
                $platforms = $game_server_mod->getAllPlatform();
                //所有角色列表
                $roleList = $role_mod->getRoleList();
                $this->assign("roleList",$roleList);
                $this->assign("platforms",$platforms);
                $this->display();
        }

        /**
          * 编辑用户信息
          */
        public function editUser(){
                $user_mod = D('user');
                if(IS_POST){
                	$userId = intval(I("post.userId"));
                	$data['user_name'] = trim(I('post.username'));
                	$data['role_id'] = I('post.role');
                	$data['email'] = trim(I('post.email'));
                	$data['phone'] = trim(I('post.phone'));
                	$data['real_name'] = trim(I("post.truename"));
                	$game_platform = I('post.game_platform');
                	$data['game_platform'] = implode(",", $game_platform);
                	$user_mod = M("user");
                	$condition['user_id'] = $userId;
                	$result = $user_mod->where($condition)->save($data);
                	redirect(U("System/userList"));
                	exit;
                }
                $userId = intval(I("get.userId"));
                $role_mod = D("role");
                $game_server_mod = D("GameServer");
                //所有平台列表
                $platforms = $game_server_mod->getAllPlatform();
                 //所有角色列表
                $roleList = $role_mod->getRoleList();
                $userInfo = $user_mod->find($userId);
                $this->assign('userInfo',$userInfo);
                $this->assign("roleList",$roleList);
                 $this->assign("platforms",$platforms);
                $this->display();
        }
        /**
         * 冻结账户
         */
        public function freezeUser(){
                $user_mod = D('user');
                $userId = intval(I("get.userId"));
                $data['status'] = intval(I("get.type"));
                $user_mod->where($userId)->save($data);
                redirect(U("System/userList"));
        }
        /**
         * 用户列表
         */
        public function userList(){
                $role_mod = D("role");
                $user_mod = M("user");
                $data = $user_mod->select();
                $roleList = $role_mod->getRoleList();
                $this->assign("roleList",$roleList);
                $this->assign("list",$data);
                $this->assign("user_status", C("USER_STATUS"));
                $this->display();
        }
        /**
         * 添加角色
         */
        public function addRole(){
                $menu_mod = D("Menu");
                if(IS_POST){
                	$role_mod = M("role");
                	$data['role_name'] = trim(I("post.roleName"));
                	$data['had_permission'] = implode(',', I("post.permission"));
                	$data['add_time'] = date("Y-m-d H:i:s");
                	$result = $role_mod->add($data);
                	redirect(U("System/roleList"));
                	exit();
                }
                $list = $menu_mod->getMenuList(2);
                $this->assign('list',$list);
                $this->display();
        }

        /**
         * 编辑角色信息
         */
        public function editRole(){
                $role_mod = M("role");
                if(IS_POST){
                	$data['role_name'] = trim(I("post.roleName"));
                	$data['had_permission'] = implode(',', I("post.permission"));
                	$condition['role_id'] = I("post.roleId");
                	$result = $role_mod->where($condition)->save($data);
                	redirect(U("System/roleList"));
                	exit();
                }
                $menu_mod = D("Menu");
                $roleId = I("get.roleId");
                /*获得角色信息*/
                $roleInfo = $role_mod->find($roleId);
                $roleInfo['permissions'] = explode(",", $roleInfo['had_permission']);
                $list = $menu_mod->getMenuList(2);
                $this->assign('list',$list);
                $this->assign("role_info",$roleInfo);
                $this->display();
        }

        /**
         * 删除指定角色
         */
        public function delRole(){
                $role_mod = M("role");
                $roleId = I("get.roleId");
                $condition['role_id'] = intval($roleId);
                $role_mod->where($condition)->save(array("is_delete"=>2));
                redirect(U("System/roleList"));
        }

	/**
	 * 角色列表
	 */
	public function roleList(){
		$role_mod = M("role");

		$list = $role_mod->select();
		$this->assign('list',$list);
		$this->display();
	}

	/**
	 * 添加菜单
	 */
	public function addMenu(){
		$menu_mod = D("Menu");
		$module_list = $menu_mod->getModuleList();

		if(IS_POST){
			$data['module_id'] = I("post.moduleId");
			$data['menu_code'] = trim(I("post.menuCode"));
			$data['menu_title'] = trim(I("post.menu_title"));
			$data['order_weight'] = trim(I("post.orderWeight"));
			$data['is_show'] = I("post.isShow",2);
			$data['is_new'] = I("post.isNew",2);
			$data['add_time'] = date("Y-m-d H:i:s");
			$result = $menu_mod->add($data);
			$this->redirect("System/menuList");
			exit;
		}
		$this->assign("moduleList",$module_list);
		$this->display();
	}

	/**
	 * 菜单列表
	 */
	public function menuList(){
		$menu_mod = D("Menu");
		$DataList = $menu_mod->getMenuList(2);
		
		$this->assign("list",$DataList);
		$this->display();
	}

        function editMenu(){
            $menu_id = intval(I("menu_id"));
            $menu_mod = D("Menu");
            if(IS_POST){
                $data['module_id'] = I("post.moduleId");
                $data['menu_code'] = trim(I("post.menuCode"));
                $data['menu_title'] = trim(I("post.menu_title"));
                $data['order_weight'] = trim(I("post.orderWeight"));
                $data['is_show'] = I("post.isShow",2);
                $data['is_new'] = I("post.isNew",2);
                $condition['pid']=$menu_id;
                $result = $menu_mod->where($condition)->save($data);

                $this->redirect("System/menuList");
                exit;
            }
            $module_list = $menu_mod->getModuleList();
            $menu_info = $menu_mod->find($menu_id);
            
            $this->assign("info",$menu_info);
            $this->assign("moduleList",$module_list);
            $this->display();
        }
}