<?php

/**
 * Created by PhpStorm.
 * User: APone
 * 普通用户注册类
 * Date: 2016/12/3
 * Time: 1:04
 */
class UserRegisterCtrl
{
    /**
     * 显示注册页面
     */
    public function exec(){
        require_once VIEW_PATH."";//加载注册页面
    }


    public function register(){
        if(!empty($_POST)){
            $userName=isset($_POST["userName"])?htmlspecialchars(trim($_POST["userName"])):"";//用户名
            $password=isset($_POST["password"])?htmlspecialchars(trim($_POST["password"])):"";//密码
            $email=isset($_POST["email"])?htmlspecialchars(trim($_POST["email"])):"";//邮箱

            //*******************************信息验证**************************//


        }
    }
}

/**
 * Class Register
 * 注册json类
 */
class Register{

    /**
     * @var bool 是否
     */
    public $success=false;

    public $message="";

    public $url="";
}

