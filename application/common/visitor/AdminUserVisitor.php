<?php
/**
 * Created by PhpStorm.
 * User: wangwj
 * Date: 2019/6/28
 * Time: 11:49
 * Desc: 后台访问者对象
 */
namespace app\common\visitor;

class AdminUserVisitor extends BaseVisitor
{

    protected $_infoKey = 'adminUserInfo';

    //构造函数
    public function __construct()
    {
        $info = session($this->_infoKey);
        if (!empty($info) && !empty($info['user_id'])) {
            $this->_info = $info;
            $this->hasLogin = true;
        } else {
            $this->_info = array(
                'user_id' => 0,
                'username' => '',
                'is_super' => 0,
                'user_roles' => array()
            );
            $this->hasLogin = false;
        }
    }

    //是否超级管理员
    public function is_super()
    {
        return $this->_info['is_super'];
    }

    //获取管理员角色
    public function get_user_roles()
    {
        return $this->_info['user_roles'];
    }

    //注册登录管理员信息
    public function assign(array $userInfo)
    {
        $this->info = $userInfo;
        session($this->_infoKey, $userInfo);
    }

    /**
     * 获取用户详细信息
     *
     * @return array
     */
    public function _get_detail()
    {
        return $this->_info;
    }

    /**
     * 刷新管理员信息
     *
     * @return array
     */
    public function flush()
    {
        $info = model('AdminUser')->getInfo($this->_info['user_id']);
        $this->assign($info);
        return true;
    }

}