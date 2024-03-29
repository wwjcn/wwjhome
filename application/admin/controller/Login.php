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
        $userName = input('post.username/s');
        $password = input('post.password/s');
        $logic = logic('AdminUser');
        $user = $logic->login($userName, $password);
        if (!$user) {
            return $this->fail($logic->getErrorMsg());
        }
        $this->_visitor->assign($user);
        return $this->ajaxReturn($user);
    }

    /**
     * User: wangwj
     * Date: 2019/6/28
     * Time: 11:49
     * Desc: 登出
     */
    public function logout()
    {
        $this->_visitor->logout();
        return redirect(url('login/login'));
    }

    public function register()
    {
        $userName = input('post.username/s');
        $password = input('post.password/s');
        $user = logic('AdminUser')->registerAdmin($userName, $password);
    }
}