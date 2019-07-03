<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/2
 * Time: 20:30
 */
namespace app\common\logic;

class BaseLogic {

    protected $_errorCode = 0;    //错误码
    protected $_errorMsg = '';    //错误原因

    //构造函数
    public function __construct()
    {

    }

    //保存业务逻辑错误信息
    public function setError($errorMsg = 'system error', $errorCode = 99)
    {
        $this->_errorCode = $errorCode;
        $this->_errorMsg = $errorMsg;
    }

    //读取业务逻辑错误信息
    public function getError()
    {
        return array(
            'errorCode' => $this->_errorCode,
            'errorMsg' => $this->_errorMsg,
        );
    }
}