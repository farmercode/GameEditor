<?php

namespace Home\Controller;
use Think\Controller;

class ReportController extends BaseController {

var $file_filter=array(".","..");

public function index(){

}

/**
 * 资源消耗概况
 * @return [type] [description]
 */
public function resSurvey(){
	$resource_log_mod = D("ResourceLog");
	$resource_types = C("GAME_RESOURCE_TYPE");
	$resource_reason = C("GAME_RESOURCE_REASON");

	/*搜索相关条件*/
	if(IS_POST){
		$search['resType'] = I("post.resourceType");
		$search['oper'] = I("post.Oper");
		$search['startTime'] = I("post.start_time");
		$search['endTime'] = I("post.end_time");
	}else{//搜索默认值
		$search['resType'] = 1;
		$search['oper'] = 1;
		$now = time();
		$search['endTime'] = date("Y-m-d");
		$search['startTime'] = date("Y-m-d",$now-7*24*3600);
	}

	$data = $resource_log_mod->expendResourceSurvey($search);
	$total = 0;
	foreach ($data as $value) {
		$total+= $value['expend_num'];
	}

	$this->assign("search",$search);
	$this->assign("ResourceTypes",$resource_types);
	$this->assign("total",$total);
	$this->assign("list",$data);
	$this->assign("reason",$resource_reason);
	$this->display();
}

/**
 * 角色资源消耗排行榜
 * @return [type] [description]
 */
public function roleResRank(){
        $resource_types = C("GAME_RESOURCE_TYPE");
        $ResLog_mod = D("ResourceLog");
        /*搜索相关条件*/
        if(IS_POST){
                $search['resType'] = I("post.resourceType");
                $search['oper'] = I("post.Oper");
                $search['startTime'] = I("post.start_time");
                $search['endTime'] = I("post.end_time");
         }else{//搜索默认值
                 $search['resType'] = 1;
                 $search['oper'] = 1;
        }
        $dataList = $ResLog_mod->roleResQuery($search);
        $this->assign("search",$search);
        $this->assign("ResourceTypes",$resource_types);
        $this->assign("list",$dataList);
        $this->display();
}

/**
 * 玩家等级分布
 */
public function playerLevel(){
        $player_mod = D('player');
        $dataList = $player_mod->getPlayerLevelList();
        $levelArea = array();
        $total = 0;
        foreach ($dataList as $value) {
                $Tens = floor($value['Level']/10);
                $key = ($Tens*10)."-".($Tens*10+9);
                $levelArea[$key] += $value['count_num']; 
                $total+=$value['count_num'];
        }
        $this->assign('total',$total);
        $this->assign('levelArea',$levelArea);
        $this->assign('list',$dataList);
        $this->display();
}

/**
 * 实时创建
 */
public function dynamicNewPlayer(){
        $player_mod = D('player');
        /*搜索相关条件*/
        if(IS_POST){
                $queryDate = I("post.queryDate");
        }else{//搜索默认值
                $queryDate = date("Y-m-d");
        }
        $dataList = $player_mod->getPlayersCreateSurvey($queryDate);
        $hList = array();
        foreach ($dataList as $key=>$value) {
                $index = intval(date("H",$key));
                $hList[$index]+=$value;
        }
        $this->assign('mlist',$dataList);
        $this->assign('hlist',$hList);
        $this->assign('queryDate',$queryDate);
        $this->display();
}

/**
 * 24小时在线玩家
 */
public function onlinePlayer(){
        $online_player_mod = D("OnlinePlayers");
         /*搜索相关条件*/
        if(IS_POST){
                $queryDate = I("post.queryDate");
        }else{//搜索默认值
                $queryDate = date("Y-m-d");
        }
        $query['queryDate'] = $queryDate;
        $query['server_code'] = 'test';


        $dataList = $online_player_mod->getOnlinePlayersList($query);
        $hList = array();
        foreach ($dataList as $key=>$value) {
                $index = intval(date("H",$key));
                if(isset($hList[$index])){
                	$hList[$index] = $value;          	
                }else{
                	if($value>$hList[$index]) $hList[$index] = $value;           
                }
        }
        $this->assign('mlist',$dataList);
        $this->assign('hlist',$hList);
        $this->assign('queryDate',$queryDate);
        $this->display();
}

/**
 * 玩家每日登录数
 */
public function dailyLoginSurvey(){
      $player_action_log_mod = D("PlayerActionLog");

      /*搜索相关条件*/
        if(IS_POST){
            $search['startTime'] = I("post.start_time");
            $search['endTime'] = I("post.end_time");
        }else{//搜索默认值
            $now = time();
            $search['endTime'] = date("Y-m-d");
            $search['startTime'] = date("Y-m-d",$now-7*24*3600);
        }
      $end = date("Y-m-d");
      $start = date("Y-m-d",strtotime($end)-7*24*3600);
      $condition['type'] = "login";
      $condition['start_time'] = $search['startTime'];
      $condition['end_time'] = $search['endTime'];
      $dataList = $player_action_log_mod->getPlayerActionList($condition);
      $data = create_array_with_date($search['startTime'],$search['endTime']);
     
      foreach ($dataList as $key => $value) {
            $data[$value['login_date']] = intval($value['num']);
      }
      $this->assign("search",$search);
      $this->assign("list",$data);
      $this->display();
}

/**
 * 玩家24小时登录统计
 */
public function wholeDayLoginSurvey(){
    $player_action_log_mod = D("PlayerActionLog");
     /*搜索相关条件*/
    if(IS_POST){
        $search_date = I("post.searchDate");
    }else{//搜索默认值
        $search_date = date("Y-m-d");
    }

    $list = $player_action_log_mod->getPlayerActionByDay("login",$search_date);
    $hList = array();
    foreach ($list as $value) {
        $index = date("Y-m-d H时",$value['login_time']);
        $hList[$index]++;
    }

    $this->assign("list",$hList);
    $this->assign("search_date",$search_date);
    $this->display();
}
    
    /**
     * 玩家实时充值
     */
    function realtimePayrecord(){
        $game_pr_mod = D("GamePayRecord");
          if(IS_POST){
                $queryDate = I("post.queryDate");
            }else{//搜索默认值
                    $queryDate = date("Y-m-d");
            }
            $list = $game_pr_mod->getRecordListViaMin($queryDate);
            /*生成图标所需数据*/
            $chart_list = create_filled_array_with_interval(0,strtotime($queryDate),60*24);
            foreach ($list as $key => $value) {
                $index = strtotime(date("Y-m-d H:i",$value['create_time']));
                $chart_list[$index]++;
            }
            $this->assign("chart_list",$chart_list);
            $this->assign("real_list",$list);
            $this->assign('queryDate',$queryDate);
            $this->display();
    }

    /**
     * 每日玩家充值
     */
    function payrecordViaDay(){
        $payrecord_mod = D("PayRecord");

        /*搜索*/
        if(IS_POST){
            $search['startTime'] = I("post.start_time");
            $search['endTime'] = I("post.end_time");
        }else{//搜索默认值
            $now = time();
            $search['endTime'] = date("Y-m-d");
            $search['startTime'] = date("Y-m-d",$now-7*24*3600);
        }
       $len = (strtotime($search['endTime'])-strtotime($search['startTime']))/(24*60*60);

        $list = $payrecord_mod->getPayListViaDay($search);

        $chart_amount = create_filled_array_with_interval(0,strtotime($search['startTime']),$len,24*60*60);
        $chart_count = $chart_amount;
        $show_list = array();
        foreach ($list as $key => $value) {
            $index_date = date("Y-m-d",$value['create_time']);
            $index= strtotime($index_date);

            $chart_count[$index]++;
            $chart_amount[$index]+=$value['amount'];
            $show_list[$index]['count']++;
            $show_list[$index]['amount']+=$value['amount'];
        }

        $this->assign("list",$list);
        $this->assign('chart_count',$chart_count);
        $this->assign('chart_amount',$chart_amount);
        $this->assign('show_list',$show_list);
        $this->assign("search",$search);
        $this->display();
    }

    function payrecordViaMonth(){
        $payrecord_mod = D("PayRecord");
        print_r($_POST);
        if(IS_POST){
            $search['queryMonth'] = trim(I("post.queryMonth"));
            $search['queryType'] =intval(I("post.queryType"));
        }else{
             $search['queryMonth'] = date("Y-m");
             $search['queryType'] =1;
        }
        $list = $payrecord_mod->getPayAmountViaMonth($search);
        $this->assign("query",$search);
        $this->assign("list",$list);
        $this->display();
    }

public function scanfData(){
        $file_mod = D("LogFileInfo");
        $resource_log_mod = M("ResourceLog");
        $online_player_mod = M("onlinePlayers");
        $palyer_login_log_mod = D("palyerActionLog");

        $scanf_dir = ROOT_PATH."/data/";
        $parseLoger = new \Org\Extend\ParseLog;
        if(!is_dir($scanf_dir))
             throw_exception("Scanf dir is not exists!");
        $dh = opendir($scanf_dir);
        while (($file = readdir($dh)) !== false) {
                /*过滤非log文件*/
                if(in_array($file, $this->file_filter) || !is_log($file)) continue;
                $file_path = realpath($scanf_dir.$file);
                if(is_file($file_path)){
                        $file_md5 = md5_file($file_path);
                        $file_info = $file_mod->get_logfile_by_path($file_path);
	$parseLoger->init();
	/*添加log文件记录和添加log*/
	if(empty($file_info)){					
                	$parseLoger->parseFile($file_path);
                	//添加文件信息
                	$file_info = $parseLoger->getFileInfo();
                	$file_result = $file_mod->add($file_info);
                	/*添加资源日志信息*/
                	if(!empty($parseLoger->data['resLog'])){
                	        $log_result = $resource_log_mod->addAll($parseLoger->data['resLog']);
                	}				
                	/*添加在线玩家日志信息*/
                	if(!empty($parseLoger->data['onlinePlayers'])){
                	        $online_player_mod->addAll($parseLoger->data['onlinePlayers']);
                	}
                	/*添加玩家登入登出信息*/
                	if(!empty($parseLoger->data['playerLogin'])){
                	        $palyer_login_log_mod->addAll($parseLoger->data['playerLogin']);
                	}
	
            }else{//更新log文件记录信息和添加日志文件内容中多的内容				
	$parseLoger->parseFile($file_path,$file_info['file_seek']);
	//更新文件信息
	$file_info = $parseLoger->getFileInfo();
	$file_result = $file_mod->where(array("file_path" => $file_path))->save($file_info);
	/*添加资源日志信息*/
	if(!empty($parseLoger->data['resLog']))	{
	        $log_result = $resource_log_mod->addAll($parseLoger->data['resLog']);
	}
	/*添加在线玩家日志信息*/
	if(!empty($parseLoger->data['onlinePlayers'])){
	       $online_player_mod->addAll($parseLoger->data['onlinePlayers']);
	}
	/*添加玩家登入登出信息*/
	if(!empty($parseLoger->data['playerLogin'])){
	        $palyer_login_log_mod->addAll($parseLoger->data['playerLogin']);
	}
          }
        }
}
        closedir($dh);
}

}