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
        var_dump($logicName);
        return Loader::model($logicName, 'logic');
    }
}