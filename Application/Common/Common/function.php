<?php

function is_log($filename){
        $basename = basename($filename);
        return preg_match("%(.*)\.log%", $basename);
}

/**
 * 菜单按权重排序
 * @param  array $array1 第一个菜单数组
 * @param  array $array2 第二个菜单数组
 * @return int
 */
function sortByWeight($array1,$array2){
       if($array1['order_weight'] == $array2['order_weight']) return 0;
       return $array1['order_weight']>$array2['order_weight'] ? 1: -1;
}

function create_filled_array_with_interval($value,$start,$len,$interval=60){
        $array = array();
        $index = $start;
        while (count($array)< $len) {
                $array[$index] = $value;
                $index+=$interval;
        }
        return $array;
}

function create_array_with_date($start,$end,$type="date"){
       $start = strtotime($start);
       $end = strtotime($end);
       switch ($type) {
               case 'date':
                       $format = "Y-m-d";
                       $interval = 3600*24;
                       break;
               default:
                       $format = "Y-m-d H:i";
                       $interval = 60;
               	break;
       }
       $index = $start;
       $array = array();
       while (true) {
               $key = date($format,$index);
               $array[$key] = 0;
               if($index>=$end){
               	break;
               }
               $index=$index+$interval;
       }
       return $array;
}

/**
 * 获得玩家的相关图片
 * @param  string  $img_key 图片的key，一般为图片的名字
 * @param  integer $type    类型，1为卡牌的头像url，2为装备icon的url
 * @return string 图片的url
 */
function get_player_img($img_key,$type=1){
    $prefix = "";
    switch ($type) {
      case 1:
      case 2:
      case 9:
        $prefix = C("PROP_IMG_URL")."item_";
        break;
      case 3:
        $prefix = C("CARD_HEADPORTRAIT_URL")."h";
        break;
      case 4:
        $prefix = C("EQUIPICON_URL")."zb_";
        break;
      default:
        return C("PROP_IMG_URL")."unknown.png";
        break;
    }
    $url = $prefix.$img_key.".jpg";
    return $url;
}

function curl_post($url,$data=array()){
    $content = null;
    if(is_array($data)){
        $content = http_build_query($data);
    }
    $link = curl_init();
    curl_setopt($link, CURLOPT_URL, $url);
    curl_setopt($link, CURLOPT_POST, true);
    curl_setopt($link, CURLOPT_POSTFIELDS, $content);
}
