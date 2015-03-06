<?php

namespace Home\Controller;
use Think\Controller;

class PayController extends Controller{

        function index(){
                $payrecord_mod = D("PayRecord");

                $game_platform = I("platform");
                switch ($game_platform) {
                        case 'kuaiqin':
                                $data = $this->_testPlatform();
                                break;
                        
                        default:
                                exit("platform not exist!");
                                break;
                }

                //检查订单是否存在
                if($payrecord_mod->checkOrderRecord($data))   exit("Order exist!");
               
                $payrecord_mod->add($data);
                if(true){
                        $game_payrecord_mod = D("GamePayRecord");
                        $game_payrecord_mod->addRecordViaServer($data['server_code'],$data);
                        echo $game_payrecord_mod->getDbError();
                }
        }

        private function _testPlatform(){
                if(!IS_POST) exit("Access denied");

                $data['server_code'] = "kuaiqin_dev1001";
                $data['order_sn'] = date("YmdHis").rand(101,999);
                $data['platform'] = "kuaiqin";
                $data['player_id'] = "28428972647776263";
                $data['amount'] = rand(1,100)*10;
                $data['gold'] = $data['amount']*10;
                $data['state'] = 1;
                $data['create_time'] = time();
                return $data;
        }

        function generateTestData(){
                $url = "http://192.168.0.81:8082/index.php?m=Home&c=Pay&a=index";
                $count = rand(1,10);
                $handles = array();
                $i=0;
                while($i<$count){
                        $handles[$i] = curl_init();
                        curl_setopt($handles[$i],CURLOPT_URL,$url);
                        curl_setopt($handles[$i], CURLOPT_HEADER, 0);
                        curl_setopt($handles[$i],CURLOPT_POST,1);
                        curl_setopt($handles[$i], CURLOPT_POSTFIELDS, http_build_query(array("platform"=>"kuaiqin")));
                        //curl_setopt($handles[$i],CURLOPT_RETURNTRANSFER,true);
                        $i++;
                }

                $mh = curl_multi_init();
                foreach ($handles as $key => $value) {
                        curl_multi_add_handle($mh, $value);
                }

                $active = null;
                // 执行批处理句柄
                do {
                    $mrc = curl_multi_exec($mh, $active);
                } while ($mrc == CURLM_CALL_MULTI_PERFORM);

                while ($active && $mrc == CURLM_OK) {
                    if (curl_multi_select($mh) != -1) {
                        do {
                            $mrc = curl_multi_exec($mh, $active);
                        } while ($mrc == CURLM_CALL_MULTI_PERFORM);
                    }
                }

                foreach ($handles as $h) {
                        curl_multi_remove_handle($mh,$h);
                }
                curl_multi_close($mh);
                echo "<br>$count finished!";
        }

        function html(){
                $this->display();
        }
}