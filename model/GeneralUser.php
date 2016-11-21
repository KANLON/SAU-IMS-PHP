<?php

/**
 * Created by PhpStorm.
 * 普通用户类
 * User: APone
 * Date: 2016/11/21
 * Time: 0:54
 */
if (!defined('HOST')) define('HOST', str_replace('\\', '/', dirname(__FILE__)) . "/../");//站点目录

require_once HOST . "framework/BaseUser.php";

class GeneralUser extends BaseUser
{


    public function register($content)
    {

    }

    public function showInfo($usreName)
    {

    }

    public function editInfo($userName, $content)
    {

    }

    public function getName()
    {
        return "GeneralUser";
    }
}