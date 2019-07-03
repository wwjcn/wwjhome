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
 * @param $model
 * @return Model
 */
if (!function_exists('logic')) {

    function logic($logicName)
    {
        $logicName = $logicName . 'Logic';
        return Loader::model($logicName, 'logic');
    }
}

/**
 * @desc 用于实例化访问者(visitor)模型类
 * @param $model
 * @return Model
 */
if (!function_exists('visitor')) {

    function visitor($visitorName)
    {
        $visitorName = $visitorName . 'Visitor';
        return Loader::model($visitorName, 'visitor');
    }
}