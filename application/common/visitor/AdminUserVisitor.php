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
                'user_name' => '',
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
    /*public function assign(array $user_info)
    {
        $this->info = $user_info;
        if ($user_info) {
            $this->has_login = true;
        }
    }*/

    /**
     * 获取用户详细信息
     *
     * @return array
     */
    public function _get_detail()
    {
        /*$model_member = D('Member');
        $detail = $model_member->get_user($this->_info['user_id'], 'user_id, user_name, email, real_name, logins');
        $detail['manage_store'] = 0;*/
        return array(
            'user_id' => 1,
            'user_name' => 'wwj',
            'is_super' => 0,
            'user_roles' => array()
        );
    }

}