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

//兼容PATH_INFO
if (!isset($_SERVER['PATH_INFO'])) {
    $_SERVER['PATH_INFO'] = substr(strstr($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME']), strlen($_SERVER['SCRIPT_NAME']));
}

//开启调试
define('APP_DEBUG', true);

// 绑定Home模块到当前入口文件
define('BIND_MODULE', 'admin');

// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');

//配置文件路径
define('CONF_PATH', __DIR__.'/../config/');

//禁用缓存
define('DB_FIELD_CACHE',false);
define('HTML_CACHE_ON',false);

// 加载框架基础文件
require __DIR__ . '/../thinkphp/base.php';

// 绑定当前入口文件到admin模块
\think\Route::bind('admin');

// 关闭admin模块的路由
\think\App::route(false);


// 执行应用
\think\App::run()->send();

