<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/2
 * Time: 20:15
 */
namespace app\common\logic;

class AdminUserLogic extends BaseLogic {

    public function login()
    {
        $userInfo = array(
            'user_id' => 1,
            'user_name' => 'wwj',
            'is_super' => 0,
            'user_roles' => array()
        );
        return $userInfo;
    }
}