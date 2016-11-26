<?php

/**
 * Created by PhpStorm.
 * User: APone
 * 管理员主界面控制类
 * Date: 2016/11/24
 * Time: 19:55
 */
defined("APP") or die("傻了吧我的弟");

class AdminMainCtrl
{
    public function exec()//默认功能实现
    {
        session_start();
        if(empty($_SESSION["userName"])){
            die("gg");
        }
        require_once VIEW_PATH . "admin/index.html";//载入管理界面
    }

    //其他的方法
}