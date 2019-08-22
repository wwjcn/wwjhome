<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/2
 * Time: 20:15
 */
namespace app\common\logic;
use app\common\sclass\Validation;

class AdminUserLogic extends BaseLogic {

    /*
     * DESC：后台管理员登陆
     */
    public function login($loginName, $password)
    {
        $type = Validation::checkLoginType($loginName);
        if (!$type) {
            $this->_errorMsg = '登录账号格式错误，重新填写';
            return false;
        }
        $adminModel = model('AdminUser');
        $param[$type] = $loginName;
        $adminInfo = $adminModel->getList($param);

        $adminInfo = $adminInfo['data'][0];
        if (empty($adminInfo) || !password_verify($password, $adminInfo['password'])) {
            $this->_errorMsg = '账号或密码不正确，请检查输入是否正确';
            return false;
        }
        return $adminInfo;
    }

    /*
     * DESC：后台管理员注册
     */
    public function registerAdmin($userName, $password)
    {
        $options = [
            'cost' => 11,
            'salt' => md5($password),
        ];
        $adminModel = model('AdminUser');
        $userCount = $adminModel->getList(array('username' => $userName), true);
        if ($userCount > 0) {
            $this->_errorMsg = '用户名已被注册，请重新填写';
        }
        $user['username'] = $userName;
        $user['password'] = password_hash($password, PASSWORD_BCRYPT, $options);
        $user['salt']     = $options['salt'];

        $result = $adminModel->add($user);
        return $result;
    }
}