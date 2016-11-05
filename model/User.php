<?php
/**
 * Created by PhpStorm.
 * User: APone
 * Date: 2016/11/5
 * Time: 13:01
 */
require "../framework/BaseUser.php";
require "../framework/UserFactory.php";

class User extends BaseUser
{
    public function __construct()
    {
        parent::__construct();
    }

    /*
     * 注册
     */
    public function register($content){

    }

    /*
     * 查看资料
     */
    public function showInfo($usreName){

    }

    /*
     * 修改资料
     */
    public function editInfo($userName, $content){

    }

    /*
     * 修改密码
     */
    public function editPassword($userName, $oldPassword, $newPassword){

    }

    /*
     * 注销
     */
    public function logout($userName){

    }
}

try{
    $link=UserFactory::factory("User");
}catch(ClassNotFoundException $e){
    $e->getError();
}

if($link->login('1','1')){
    echo "登陆成功";
}else{
    echo "登陆失败";
}
