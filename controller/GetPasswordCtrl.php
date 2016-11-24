<?php

/**
 * Created by PhpStorm.
 * 找回密码，由于是面向全体人员，不分前台和后台，一律用普通用户类
 * User: APone
 * Date: 2016/10/29
 * Time: 11:08
 */
class GetPasswordCtrl
{
    public function exec()
    {
        header("Content-type:text/html;charset=utf-8");

        require_once VIEW_PATH."GeneralUser.php";//载入普通用户类
        require_once FRAME_PATH."Email.php";//载入邮箱类

        date_default_timezone_set("PRC");//设置时区

        if ($_POST) {//获取忘记密码的链接

            $userName = isset($_POST['userName']) ? htmlspecialchars(trim($_POST['userName'], " ")) : "";//获得用户名

            if (empty($userName)) {//账号不能为空
                die("请输入账号");
            }

            $user = new GeneralUser($userName);//实例化普通用户类

            if (!$user->isExits()) {
                die("用户名不存在");
            }

            session_start();//启动session保存链接中hash，用于阻止链接二次有效
            $time = time();//获取链接时的时间，做过期验证
            $key = $user->getKey();//获取用户专用key
            $sessionId = session_id();//获取session的id

            $hash = md5($userName . $time . $key . $sessionId);//加密，做是否链接被修改的检验用
            $_SESSION["hash"] = $hash;//储存session id
            $url = "http://localhost/SAU-IMS/controller/GetPasswordCtrl.php?time=$time&hash=$hash&session=$sessionId";//组成找回密码链接
            $content = "点击以下链接进行修改密码<br><a href='$url'>$url</a><br>如果不是您申请修改密码，请及时登陆您的账号并修改<br>校社联 " . date("Y-m-d H:i:s", time());//邮件其他的内容
            $email = $user->getEmail();

            Email::send($email, "【校社联】密码修改,", $content);//此处将修改密码的链接发送到邮箱

        } else if ($_GET) {//点击邮箱获取的链接

            $time = isset($_GET['time']) ? htmlspecialchars(trim($_GET['time'], " ")) : "";//获得时间
            $hash = isset($_GET['hash']) ? htmlspecialchars(trim($_GET['hash'], " ")) : "";//获得hash

            session_start();//打开session

            if ($hash == $_SESSION["hash"]) {//检测链接合法性
                if (time() - $time < 3600) {//链接有效期
                    echo "修改成功";
                } else {
                    die("连接已过期");
                }
            } else {
                die("哎呀，好像你的链接不合法呦XD");
            }
        }
    }
}


