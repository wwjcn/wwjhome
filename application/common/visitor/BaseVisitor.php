<?php
/**
 * Created by PhpStorm.
 * User: wangwj
 * Date: 2019/6/28
 * Time: 11:49
 * Desc:  * 访问者基础类，集合了当前访问用户的操作
 */
namespace app\common\visitor;

abstract class BaseVisitor
{
    public $hasLogin = false;
    protected $_info = null;
    protected $_privilege = null;
    protected $_infoKey = 'userInfo';

    public function __construct()
    {
        $info = session($this->_infoKey);
        if (!empty($info) && !empty($info['user_id'])) {
            $this->_info = $info;
            $this->hasLogin = true;
        } else {
            $this->_info = array(
                'user_id' => 0,
                'username' => ''
            );
            $this->hasLogin = false;
        }
    }

    /**
     * 注册登录管理员信息
     */
    public function assign(array $userInfo)
    {
        session($this->_infoKey, $userInfo);
    }

    /**
     * 获取当前登录用户的详细信息
     *
     * @return array 用户的详细信息
     */
    public function get_detail()
    {
        /* 未登录，则无详细信息 */
        if (!$this->hasLogin) {
            return array();
        }

        /* 取出详细信息 */
        static $detail = null;

        if ($detail === null) {
            $detail = $this->_get_detail();
        }

        return (array)$detail;
    }

    /**
     * 获取用户详细信息
     *
     * @return string
     */
    protected function _get_detail()
    {
        return session($this->_infoKey);
    }


    /**
     * 获取当前用户的指定信息
     *
     * @param string $key 指定用户信息
     *
     * @return string 如果值是字符串的话
     *         array 如果是数组的话
     */
    public function get($key = null)
    {
        $info = null;
        if (empty($key)) {
            /* 未指定key，则返回当前用户的所有信息：基础信息＋详细信息 */
            $info = array_merge((array)$this->_info, (array)$this->get_detail());
        } else {
            /* 指定了key，则返回指定的信息 */
            if (isset($this->_info[$key])) {
                /* 优先查找基础数据 */
                $info = $this->_info[$key];
            } else {
                /* 若基础数据中没有，则查询详细数据 */
                $detail = $this->get_detail();
                $info = isset($detail[$key]) ? $detail[$key] : null;
            }
        }
        return $info;
    }

    /**
     * 登出
     *
     * @return void
     */
    public function logout()
    {
        session($this->_infoKey, null);
    }
}