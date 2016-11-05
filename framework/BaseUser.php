<?php

/**
 * Created by PhpStorm.
 * User: APone
 * Date: 2016/11/5
 * Time: 12:15
 */
/*
 * 用户抽象类，一切其他权限用户类必须继承该类
 */
require "Database.php";
abstract class BaseUser
{
    protected $instance;//数据库接口

    /*
     * 构造函数
     */
    public function __construct()
    {
        $this->instance = Database::getInstance();
    }

    /*
     * 获得数据库接口
     */
    protected function getConn()
    {
        return $this->instance->getConn();
    }

    /*
     * 登陆
     */
    final public function login($userName, $password)
    {
        $link = $this->getConn()->prepare("call login(?,?)");
        $link->bindParam(1, $userName);
        $link->bindParam(2, $password);
        if (!$link->execute()) {
            return false;
        }

        return $link->rowCount() > 0 ? true : false;
    }


    /*
     * 注册
     */
    //abstract public function register($content);

    /*
     * 查看资料
     */
    //abstract public function showInfo($usreName);

    /*
     * 修改资料
     */
    //abstract public function editInfo($userName, $content);

    /*
     * 修改密码
     */
   // abstract public function editPassword($userName, $oldPassword, $newPassword);

    /*
     * 注销
     */
    //abstract public function logout($userName);

}