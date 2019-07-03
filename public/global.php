<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/2
 * Time: 17:28
 */
defined('IN_TPC') or die('Hacking!');

//兼容PATH_INFO
if (!isset($_SERVER['PATH_INFO'])) {
    $filename = '/' . basename($_SERVER['SCRIPT_FILENAME']);
    $_SERVER['PATH_INFO'] = substr(strstr($_SERVER['REQUEST_URI'], $filename), strlen($filename));
}

// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');
//配置文件路径
define('CONF_PATH', __DIR__ . '/../config/');
//公共模块函数
//define('COMMON_PATH', APP_PATH . '/common/');
//禁用缓存
define('DB_FIELD_CACHE', false);
define('HTML_CACHE_ON', false);

//公共函数文件
//include_once COMMON_PATH . 'common/function.php';

// 加载框架基础文件
require __DIR__ . '/../thinkphp/base.php';
// 执行应用
\think\App::run()->send();