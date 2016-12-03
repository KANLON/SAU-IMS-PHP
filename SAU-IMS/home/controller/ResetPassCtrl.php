<?php

/**
 * Created by PhpStorm.
 * User: APone
 * 重置密码控制类
 * Date: 2016/12/3
 * Time: 1:05
 */
class ResetPassCtrl
{
    /**
     * 默认执行函数，这里加载页面
     */
    public function exec()
    {
        if (!empty($_POST) ){//输入邮箱链接
            session_start();//打开session
            $time=$_SESSION["time"];
            date_default_timezone_set("PRC");//设置时区
            if (time() - $time > 1000 * 60) {//链接有效期
                session_destroy();
                die("链接已过期");
            } else {
                require_once VIEW_PATH . "";
            }
        }
    }

    /**
     * 点击链接重置密码
     */
    public function resetPass()
    {
        if (!empty($_POST)) {
            $password = isset($_POST["password"]) ? htmlspecialchars(trim($_POST["password"], " ")) : "";//获得新用户名
            $again = isset($_POST["again"]) ? htmlspecialchars(trim($_POST["again"], " ")) : "";//获得再次输入密码
            $resetPassword = new ResetPassword();

            if (empty($password)) {//账号不能为空
                $resetPassword->message = "新密码不能为空";
                die(json_encode($resetPassword));
            } else if (empty($again)) {
                $resetPassword->message = "确认密码不能为空";
                die(json_encode($resetPassword));
            } else if ($password != $again) {
                $resetPassword->message = "两次密码不相同，请重新输入";
                die(json_encode($resetPassword));
            }

            session_start();//打开session
            $userName = $_SESSION["userName"];
            $user = new GeneralUser($userName);
            $resetPassword->success = $user->createPassword(md5(md5($password)));
            if ($resetPassword->success) {
                $resetPassword->url = "?c=ResetPass&a=resetSuccess";
                session_destroy();//如果密码修改成功，销毁该链接有效性
                die(json_encode($resetPassword));
            }
        }
    }

    public function resetSuccess()
    {
        require_once VIEW_PATH . "";
    }
}


/**
 * Class ForgetPassword
 * 用作json传数据用
 */
class ResetPassword
{
    /**
     * @var string 登陆是否成功
     */
    public $success = false;

    /**
     * @var bool 相关提示信息（错误用）
     */
    public $message = "";

    /**
     * @var string 登陆成功的跳转页面
     */
    public $url = "";
}