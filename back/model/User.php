<?php

/**
 * Created by PhpStorm.
 * User: APone
 * Date: 2016/11/5
 * Time: 13:01
 */
require "../../framework/BaseUser.php";

class User extends BaseUser
{
    public function __construct()
    {
        parent::__construct();
    }


}

$link=new User();
$link->login("1","1");