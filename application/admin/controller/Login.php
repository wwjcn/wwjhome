<?php

/**
 * Created by PhpStorm.
 * User: wangwj
 * Date: 2019/6/28
 * Time: 11:49
 * Desc: 认证登录控制器
 */

namespace app\admin\controller;

use think\Request;

class Login extends Base
{
    /**
     * User: wangwj
     * Date: 2019/6/28
     * Time: 11:49
     * Desc: 登录页面
     */
    public function login()
    {
        return $this->fetch();
    }

    /**
     * User: wangwj
     * Date: 2019/6/28
     * Time: 11:49
     * Desc: 登录操作(ajax)
     */
    public function doLogin()
    {
        $user = logic('AdminUser')->login();
        if (!$user) {
            return $this->fetch();
        }
        $this->_visitor->assign($user);
        return $this->ajaxReturn($user);
    }
}