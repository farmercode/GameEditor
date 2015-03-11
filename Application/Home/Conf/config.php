<?php
return array(
        //'配置项'=>'配置值'
        'URL_MODEL'	=> 0, //URL模式
        'LOAD_EXT_CONFIG' => "game,template,user,db",
        /*主数据库配置*/
        'DB_TYPE'   => 'mysql', // 数据库类型
        'DB_HOST'   => '192.168.0.81', // 服务器地址
        'DB_NAME'   => 'game_tool',	// 数据库名
        'DB_USER'   => 'root', // 用户名
        'DB_PWD'    => '123456', // 密码
        'DB_PORT'   => 3306, // 端口
        'DB_PREFIX' => 't_', // 数据库表前缀
        'DB_CHARSET'=> 'utf8', // 字符集

        'GAME_CODE' => 'sg',
        "CARD_HEADPORTRAIT_URL"     => "/Public/headportrait/",  //卡牌图片的URL路径     
        "EQUIPICON_URL" => "/Public/EquipIcon/",        //装备图片存放URL路径
        "PROP_IMG_URL"  => "/Public/Prop/",
);