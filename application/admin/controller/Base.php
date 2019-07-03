<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/28
 * Time: 11:49
 */

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Base extends Controller
{
    protected $_visitor = null;
    protected $_loginController = 'login';
//    protected $_loginAction = 'dologin';

    /**
     * Desc: 控制器初始化
     */
    public function _initialize(){

        //注册访问者
        $this->_initVisitor();

        //验证是否登录
        $this->_checkLogin();

    }

    /**
     * Desc: 验证是否登录
     * @return boolean
     */
    public function _checkLogin()
    {
        $request = Request::instance();
        $requestController = strtolower($request->controller());
//        $requestAction = strtolower($request->action());
        if (($requestController == $this->_loginController)
            /*&& ($requestAction == $this->_loginAction)*/) {
            return true;
        }
        if (!($this->_visitor->hasLogin)){
            //未登录跳转登录页面
            $this->redirect(url('login/login'));
        }
        return true;
    }

    /**
     * Desc: 注册访问者
     * @return boolean
     */
    public function _initVisitor()
    {
        $this->_visitor = visitor('AdminUser');
        return true;
    }

    /**
     * Desc: 接口json数据返回
     * @return boolean
     */
    public function ajaxReturn($data, $errorCode = 0, $errorMsg = '')
    {
        return json(compact('data', 'errorCode', 'errorMsg'));
    }

}