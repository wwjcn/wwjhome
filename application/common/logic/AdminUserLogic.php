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
            return false;
        }
        $user['username'] = $userName;
        $user['password'] = password_hash($password, PASSWORD_BCRYPT, $options);
        $user['salt']     = $options['salt'];

        $result = $adminModel->add($user);
        return $result;
    }



    /*
     * DESC：编辑管理员信息
     */
    public function adminInfoUpdate($userId, $data)
    {
        if (empty($userId)) {
            $this->_errorMsg = '管理员用户id为空';
            return false;
        }
        $req = array_filter($data);
        if (empty($req)) {
            $this->_errorMsg = '修改信息为空';
            return false;
        }

        $model = model('AdminUser');
        if (!empty($data['phone'])) {
            $count = $model->getList(array('phone' => $data['phone']), true);
            if ($count > 1) {
                $this->_errorMsg = '手机号已注册，请重新填写';
                return false;
            }
        }
        if (!empty($data['email'])) {
            $count = $model->getList(array('email' => $data['email']), true);
            if ($count > 1) {
                $this->_errorMsg = '邮箱已注册，请重新填写';
                return false;
            }
        }

        $res = $model->edit($userId, $req);
        if ($res) {
            //刷新
            SEnv('visitor')->flush();
        }
        return true;
    }

    /**
     * @desc 验证密码
     * @param string $password 正确密码
     * @param string $input 输入密码
     * @return array
     */
    public function verifyPassword($password, $input)
    {
        return password_verify($input, $password);
    }
}