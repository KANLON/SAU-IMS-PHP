<?php

/**
 * Created by PhpStorm.
 * 社团管理员类
 * User: APone
 * Date: 2016/11/21
 * Time: 0:55
 */
defined("APP") or die("error");

class ClubAdmin extends BaseUser
{
    /**
     * 构造函数
     * ClubAdmin constructor.
     * @param string $userName 用户名
     */
    public function __construct($userName)
    {
        parent::__construct($userName);
    }
}