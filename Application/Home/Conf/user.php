<?php
/**
 * 用户相关定义
 * @author dk <wangchangchun@nenxun.com>
 */

return array(
		/**
		 * 用户状态
		 */
		"USER_STATUS"	=> array(
			1	=> '正常',
			2	=> '冻结',
		),
		/**
		 * 用户登录默认url
		 */
		"USER_LOGIN_DEFAULT_URL"	=> "System/userList",
		/**
		 * 未登录允许访问controller
		 */
		"UNCKECK_CONTROLLER"	=> "Index,Js",
		/**
		 * 未登录允许访问方法
		 */
		"UNCHECK_ACCESS"	=> "Report_scanfData",
	);