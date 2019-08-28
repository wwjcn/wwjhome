<?php
namespace app\admin\controller;

use think\Config;
use app\common\sclass\Validation;

class AdminUser extends Base
{
    /**
     * User: wangwj
     * Date: 2019/6/28
     * Time: 11:49
     * Desc: 管理员个人信息修改页面
     */
    public function adminUpdate()
    {
        return $this->fetch();
    }

    /**
     * User: wangwj
     * Date: 2019/6/28
     * Time: 11:49
     * Desc: 管理员个人信息修改
     */
    public function doAdminUpdate()
    {
        $data =array(
            'realname' => input('post.realname/s'),
            'phone' => input('post.phone/s'),
            'email' => input('post.email/s'),
            'sex' => input('post.sex/d'),
        );

        $userId = $this->_visitor->get('user_id');
        $logic = logic('AdminUser');
        $result = $logic->adminInfoUpdate($userId, $data);
        if (!$result) {
            return $this->fail($logic->getErrorMsg());
        }
        return $this->ajaxReturn('修改成功');
    }

    /**
     * User: wangwj
     * Date: 2019/8/23
     * Time: 11:49
     * Desc: 密码修改页面
     */
    public function passwordUpdate()
    {
        return $this->fetch();
    }

    /**
     * User: wangwj
     * Date: 2019/8/23
     * Time: 11:49
     * Desc: 密码修改
     */
    public function doPasswordUpdate()
    {
        $oldPassword = input('post.old_password/s');
        $password = input('post.pass/s');
        $rePassword = input('post.repass/s');
        if (empty($oldPassword)) {
            return $this->fail('请填写原始密码');
        }
        if (Validation::checkPassword($password)) {
            return $this->fail('密码6-16位，,至少有一个数字，一个大写字母，一个小写字母和一个特殊字符');
        }
        if ($password != $rePassword) {
            return $this->fail('两次密码不一致');
        }
        $logic = logic('AdminUser');
        $userId = $this->_visitor->get('user_id');
        $correctPassword = $this->_visitor->get('password');
        $res = $logic->verifyPassword($correctPassword, $oldPassword);
        if (!$res) {
            return $this->fail('原始密码不正确');
        }
    }

}
