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

    } else {
        try {
            $admin = ModelFactory::adminFactory($userName);//获取管理员身份
        } catch (ClassNotFoundException $e) {
            die("用户名或密码错误");
        }

        $password = md5(md5($password));//两次加密

        if ($admin->checkAccount($password)) {//为空则指登陆失败
            session_start();//保存用户文件
            $identify = $admin->getIdentify();//获取用户标识

            $_SESSION["id"] = $identify["id"];
            $_SESSION["club_id"] = $identify["club_id"];
            $_SESSION["userName"] = $userName;

        } else {
            echo "用户名或密码错误";
        }
    }
}

