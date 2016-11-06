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
    /*
     * 构造函数
     */
    public function __construct()
    {
    }

    /*
     * 登陆
     */
    public function login($userName, $password)
    {
        $sql = "select `id`,`right` from `user` where `username`=? and `password`=?";
        $conn = Database::getInstance()->getConn();
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(1, $userName);
        $stmt->bindParam(2, $password);
        $stmt->execute();

        return $stmt->fetch();//返回用户名
    }

    /*
     * 修改密码
     */
    public function editPassword($userName, $oldPassword, $newPassword)
    {
        $sql = "update `user` set `password`=? where `username`=? and `password`=?";
        $conn = Database::getInstance()->getConn();
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(1, $newPassword);
        $stmt->bindParam(2, $userName);
        $stmt->bindParam(3, $oldPassword);
        $stmt->execute();

        return $stmt->rowCount() > 0 ? true : false;
    }

    /*
     * 注册
     */
    abstract public function register($content);

    /*
     * 查看资料
     */
    abstract public function showInfo($usreName);

    /*
     * 修改资料
     */
    abstract public function editInfo($userName, $content);


}