<?php
/**
 * Created by PhpStorm.
 * User: * Date: 2019/7/2
 * Time: 11:57
 * Desc: 公共函数
 */

use think\Loader;

/**
 * @desc 用于实例化逻辑(Logic)模型类
 * @param $logicName
 * @return object Logic
 */
if (!function_exists('logic')) {

    function logic($logicName)
    {
        $logicName = $logicName . 'Logic';
        return Loader::model($logicName, 'logic');
    }
}

/**
 * @desc 用于实例化(Model)模型类
 * @param $model
 * @return object Model
 */
if (!function_exists('model')) {

    function model($modelName)
    {
        return Loader::model($modelName);
    }
}

/**
 * @desc 用于实例化访问者(visitor)模型类
 * @param $model
 * @return object Visitor
 */
if (!function_exists('visitor')) {

    function visitor($visitorName)
    {
        $visitorName = $visitorName . 'Visitor';
        return Loader::model($visitorName, 'visitor');
    }
}

/**
 * desc 为SQL查询创建LIMIT条件
 * @param int $page
 * @param int $limit
 * @return array
 */
if (!function_exists('buildLimit')) {

    function buildLimit($page = 1, $limit = 10)
    {
        $page = $page >= 1 ? $page : 1;
        $return = array(
            'begin' => ($page - 1) * $limit,
            'offset' => $limit
        );
        return $return;
    }
}

/**
 * desc 获取自建环境变量
 * @param int $page
 * @param int $limit
 * @return array
 */
if (!function_exists('SEnv')) {

    function SEnv($key , $val = null)
    {
        !isset($GLOBALS['S_ENV']) && $GLOBALS['S_ENV'] = array();
        if ($val === null) {
            /* 返回该指定环境变量 */
            return isset($GLOBALS['S_ENV'][$key]) ? $GLOBALS['S_ENV'][$key] : null;
        } else {
            /* 设置指定环境变量 */
            $GLOBALS['S_ENV'][$key] = $val;
            return $val;
        }
    }
}
