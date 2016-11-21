<?php

/**
 * Created by PhpStorm.
 * User: APone
 * 校社联管理员类
 * Date: 2016/11/6
 * Time: 0:47
 */

if (!defined('HOST')) define('HOST', str_replace('\\', '/', dirname(__FILE__)) . "/../");//站点目录

require_once HOST . "framework/BaseUser.php";

class SauAdmin extends BaseUser
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
        return "SauAdmin";
    }
}