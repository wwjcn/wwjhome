<?php
namespace app\admin\controller;

use think\Config;
use think\Env;

class Index extends Base
{
    public function index()
    {
        return $this->fetch();
    }

}
