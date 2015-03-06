<?php
namespace Home\Controller;
//use Think\Controller;

class IndexController extends BaseController {

    public function index(){
       
    	$this->display();
    }

    /**
     * 用户登录
     */
    public function login_validate(){
    	if(IS_POSt){
            $user_mod = D("user");
            $condition['user_name'] = trim(I("post.username"));
            $userInfo = $user_mod->where($condition)->find();
            if(empty($userInfo)){                
                redirect(U("Index/index"),2,"用户不存在");
                exit;
            }else if($userInfo['status'] == 2){
                redirect(U("Index/index"),2,"用户已冻结");
                exit;
            }
            $passwd = trim(I("post.passwd"));
            if($passwd ==  $userInfo['user_password']){
                $role_mod = D("role");                
                $role_info = $role_mod->find($userInfo['role_id']);

                session('user_info',$userInfo);
                session('role_name',$role_name);
                session('permission',$role_info['had_permission']);
                //获得上次用户所登录服务器
                if(!empty($userInfo['current_server'])) {
                    $game_server_mod = D("GameServer");
                    $where['ServerCode'] = $userInfo['current_server'];                
                    $server_info = $game_server_mod->getUserServerInfo($where);

                    session("cur_server_name",$server_info['ServerName']);
                    session('current_server',$userInfo['current_server']);
                }
                $data['last_login_time'] = date("Y-m-d H:i:s");
                $data['last_login_ip'] = get_client_ip();
                $user_mod->where("user_id=".$userInfo['user_id'])->save($data);

                redirect(U("System/userList"));
            }else{
                redirect(U("Index/index"),2,"用户密码错误");
            }
            
            exit;
        }
    	redirect(U("Index/index"));
    }

    public function logout(){
        session('[destroy]');
        redirect(U("Index/index"));
    }

    public function test(){
    	
    	var_dump(get_client_ip());
    }
}