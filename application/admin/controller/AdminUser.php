<?php
namespace app\admin\controller;

use think\Config;

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
        return $this->fail('失败');
    }
}
