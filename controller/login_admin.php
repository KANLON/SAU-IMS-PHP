<?php
/**
 * Created by PhpStorm.
 * 管理员登录
 * User: APone
 * Date: 2016/10/29
 * Time: 11:07
 */
define("SAU","right");

require "../framework/ModelFactory.php";

if (!empty($_POST)) {//是否有post

    $userName = isset($_POST['userName']) ? htmlspecialchars(trim($_POST['userName'], " ")) : "";//获得用户信息
    $password = isset($_POST['password']) ? htmlspecialchars(trim($_POST['password'], " ")) : "";

    $login=new login();

    if (empty($userName) || empty($password)) {
        $login->message="用户或密码不能为空";

    } else {

        try {
            $admin = ModelFactory::adminFactory($userName);//获取管理员身份
            $password = md5(md5($password));//两次加密

            if ($admin->checkAccount($password)) {//账号是否正确
                session_start();//保存用户文件
                $identify = $admin->getIdentify();//获取用户标识

                $_SESSION["id"] = $identify["id"];
                $_SESSION["club_id"] = $identify["club_id"];
                $_SESSION["userName"] = $userName;

                $login->success=true;
                $login->url="../admin/index.html";

            } else {//密码错误
                $login->message="用户名或密码错误";
            }

        } catch (ClassNotFoundException $e) {//是否具有权限
           $login->message="用户名或密码错误";
        }
    }

    die (json_encode($login));
}

/**
 * Class login
 * 用作json传数据用
 */
class login{
    /**
     * @var string 登陆是否成功
     */
    public $success=false;

    /**
     * @var bool 相关提示信息（错误用）
     */
    public $message="";

    /**
     * @var string 登陆成功的跳转页面
     */
    public $url="";
}

