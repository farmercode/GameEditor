<?php

namespace Home\Model;
use Think\Model;

class PlayerModel extends Model{
	//数据库配置
    protected $connection       =	"SGGAME_DB";
    // 实际数据表名（包含表前缀）
    protected $trueTableName    =   'CharTable';

    /**
     * 根据玩家id获得玩家列表
     * @param  mix $ids 玩家id,逗号分隔的字符串或者一个一维数组
     * @return array 
     */
    function getPlayersByIds($ids){
    	if(is_array($ids)){
    		$ids = implode(",", $ids);
    	}
    	$condition['CharId'] = array("IN",$ids);
    	$option = array("index"=>"CharId");
	$data =$this->where($condition)
	   		->select($option);
	  // echo $this->getDbError(); 
	    return $data;
    }

    /**
     * 等级概况统计
     * @return array 
     */
    function getPlayerLevelList(){
    	$field = "COUNT(1) AS count_num,`Level`";
    	$data = $this->field($field)
    		      ->group('Level')
    		      ->order('Level')
    		      ->select();
    				
    	return $data;
    }

    /**
     * 玩家创建概况
     * @param  array $date 搜索条件
     * @return [type]       [description]
     */
    function getPlayersCreateSurvey($date){
        $startTime = strtotime($date);
        $endTime = $startTime+3600*24;
        $condition['CreateTime'] = array("between","$startTime,$endTime");
        $data = $this->where($condition)
                    ->order("CreateTime")
                    ->select();

        $dataList = create_filled_array_with_interval(0,$startTime,60*24,60);

        foreach ($data as $value) {
            $index = strtotime(date("Y-m-d H:i",$value['CreateTime']));
            $dataList[$index]++;
        }
        return $dataList;
    }

    function queryPlayerInfo($conditions){
        if(empty($conditions['content'])) return null;
        switch ($conditions['type']) {
            //角色名称
            case 1:
                $where['player.CharName'] = array("like",$conditions['content']."%");
                break;
            case 2:
                $where['acc.AccountName'] = array("like",$conditions['content']."%");
                break;
            case 3:
                $where['player.CharId'] = array("like",$conditions['content']."%");
                break;
            default:
                return null;
                break;
        }
        $join = "LEFT JOIN AccountTable acc ON (player.Uid = acc.Uid)";
        $info = $this->alias("player")->join($join)->where($where)->find();
        return $info;
    }

    function getPlayerIds($playernames){
        $condition['CharName'] = array("in",$playernames);
        $data = $this->where($condition)->limit(1000)->select();
        
        return $data;
    }
}