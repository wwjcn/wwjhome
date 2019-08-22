<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/22
 * Time: 10:44
 */
namespace app\common\sclass;

class Validation {
    // 验证用户名是否合法，必须是以字母开头，只能包含字母数字下划线和减号，4到16位
    public static function checkUserName($username)
    {
        if (preg_match('/^[A-Za-z]{1}[A-Za-z0-9_-]{3,15}$/', $username)) {
            return 1;
        } else {
            return 0;
        }
    }

    // 验证密码强度，6-16位，,至少有一个数字，一个大写字母，一个小写字母和一个特殊字符，四个任意组合
    public static function checkPassword($password)
    {
        if (preg_match('/(?=^.{6,16}$)(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*]).*$/', $password)) {
            return 1;
        } else {
            return 0;
        }
    }

    // 验证邮箱是否合法，必须有@，前边最少2个字符，字母或数字开头，域名部分最少1位，后缀可以是一级也可以是二级，最少两位
    public static function checkEmail($email)
    {
        $email = strtolower($email);// 全部转小写（邮箱不区分大小写）
        if (preg_match('/^[a-z0-9]{1}[a-z0-9_-]{1,}@[a-z0-9]{1,}(\.[a-z]{2,})*\.[a-z]{2,}$/', $email)) {
            return 1;
        } else {
            return 0;
        }
    }

    // 验证手机号是否合法
    public static function checkPhone($phone)
    {
        if (preg_match('/^1[345678]{1}\d{9}$/', $phone)) {
            return 1;
        } else {
            return 0;
        }
    }

    // 验证身份证号是否合法
    // 身份证号：前两位表示地区，所以第一位不可能是0，而第7、8两位是年份的前两位，也不可能是0，最后一位除了10个数字以外还可能是X|x
    public static function checkIdCard($idcard)
    {
        if (preg_match('/^[1-9]{1}\d{5}[1-9]{2}\d{9}[Xx0-9]{1}$/', $idcard)) {
            return 1;
        } else {
            return 0;
        }
    }

    //验证登录传入字符串类型
    public static function checkLoginType($string)
    {
        if (self::checkUserName($string)) return 'username';
        if (self::checkPhone($string)) return 'phone';
        if (self::checkEmail($string)) return 'email';
        return false;
    }
}