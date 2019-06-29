<?php
namespace app\admin\controller;

use think\Config;

class Index extends Base
{
    public function index()
    {
        return $this->fetch();
    }

    public function config()
    {
        var_dump(Config::get());
    }
}
