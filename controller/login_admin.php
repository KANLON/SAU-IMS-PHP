<?php
/**
 * Created by PhpStorm.
 * 管理员登录
 * User: APone
 * Date: 2016/10/29
 * Time: 11:07
 */
require "../framework/ModelFactory.php";


if (!empty($_POST)) {//是否有post

    $userName = isset($_POST['userName']) ? htmlspecialchars(trim($_POST['userName'], " ")) : "";//获得用户信息
    $password = isset($_POST['password']) ? htmlspecialchars(trim($_POST['password'], " ")) : "";

    if (empty($userName) || empty($password)) {
        echo "用户或密码不能为空";

    } else{
        $admin = ModelFactory::factory("SauAdmin");//获取管理员身份

        //$password = md5(md5($password));//加密
        $content = $admin->login($userName, $password);//登陆并获取返回信息

        if (empty($content)) {//为空则指登陆失败
            echo "用户名或密码错误";

        } else {
            session_start();//保存用户文件
            $_SESSION['id'] = $content['id'];
            $_SESSION['userName'] = $userName;
            $_SESSION['right'] = $content['right'];
            //转到管理主页
        }
    }
}
