<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]

//开启调试
define('APP_DEBUG', true);

// 绑定Home模块到当前入口文件
define('BIND_MODULE', 'api');

// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');

//配置文件路径
define('CONF_PATH', APP_PATH . BIND_MODULE . '/config/');

// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';
