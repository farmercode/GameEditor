<?php

namespace Home\Model;
use Think\Model;

class MenuModel extends Model{

        protected $pk	= "pid";
        /**
         * 获得模块列表
         * @return array 模块列表数组
         */
        function getModuleList(){
                $condition['module_id'] = 0;
                //$condition['is_show'] = 1;
                $condition['is_delete'] = 1;
                $list = $this->where($condition)
                	        ->order("is_show,order_weight")
                	        ->select(array("index" => $this->pk));
                return $list;
        }

/**
 * 获得菜单列表
 * @param int $type 获得菜单类型，1为显示菜单，2为权限相关
 * @return array 菜单数组
 */
function getMenuList($type=1){
        switch ($type) {
                case 1:
                        $condition['is_show'] = 1;
                        $condition['is_delete'] = 1;
                        break;
                case 2:
                        $condition['is_delete'] = 1;
                        break;
                default:
                $condition = 1;
                break;
        }
        $list = $this->where($condition)
                        ->order("module_id,order_weight")
                        ->select();
                        foreach ($list as $value) {
                                if(!$value['module_id']){
                                        $data[$value['pid']] = $value;
                                }else{
                                        $data[$value['module_id']]['children'][$value['pid']] = $value;
                                }
                        }
        return $data;
}

        /**
         * 获得用户菜单列表
         * @param  string $permissions 用户权限
         * @return array
         */
        function getUserMenu($permissions){
                $condition['menu_code'] = array('in',explode(",", $permissions));
                $condition['is_show'] = 1;
                $condition['is_delete'] = 1;
                $dataList = $this->where($condition)
                                        ->order('order_weight')
                                        ->select(array("index" => $this->pk));
                return $dataList;
        }
}