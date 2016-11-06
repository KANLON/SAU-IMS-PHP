<?php

/**
 * Created by PhpStorm.
 * User: APone
 * Date: 2016/11/6
 * Time: 0:47
 */


require "../framework/BaseUser.php";

class SauAdmin extends BaseUser//校社联管理员类
{
    /*
     * 构造函数
     */
    public function __construct()
    {
        parent::__construct();//调用父类构造函数
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
}