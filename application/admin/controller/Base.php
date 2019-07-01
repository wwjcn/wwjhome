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

class Base extends Controller
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
    }
}