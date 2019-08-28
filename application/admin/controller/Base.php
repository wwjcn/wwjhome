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
use think\View;

class Base extends Controller
{
    protected $_visitor = null;
    protected $_outAuthController = array('login');

    /**
     * Desc: 控制器初始化
     */
    public function _initialize(){

        //注册访问者
        $this->_initVisitor();

        //验证是否登录
        $this->_checkLogin();

        //share公共模板变量
        $this->_shareGlobalVariable();

    }

    /**
     * Desc: 注册访问者
     * @return boolean
     */
    public function _initVisitor()
    {
        $this->_visitor = SEnv('visitor', visitor('AdminUser'));
        return true;
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
        if (in_array($requestController, $this->_outAuthController)
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
     * Desc: 公共模板变量
     * @return boolean
     */
    public function _shareGlobalVariable()
    {
        View::share('adminInfo', $this->_visitor->_get_detail());
    }

    /**
     * Desc: 接口json数据返回
     * @return boolean
     */
    public function ajaxReturn($data = [], $errorCode = 0, $errorMsg = '')
    {
        header('Content-type:application/json;charset=uft-8');
        return json(compact('data', 'errorCode', 'errorMsg'));
    }

    /**
     * Desc: 失败，接口json数据
     * @return boolean
     */
    public function fail($errorMsg = '')
    {
        $data = [];
        $errorCode = 99;
        header('Content-type:application/json;charset=uft-8');
        return json(compact('data', 'errorCode', 'errorMsg'));
    }
}