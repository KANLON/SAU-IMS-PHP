<?php
/**
 * Created by PhpStorm.
 * 用户抽象类，一切其他权限用户类必须继承该类
 * User: APone
 * Date: 2016/11/5
 * Time: 12:15
 */

if (!defined('HOST')) define('HOST', str_replace('\\', '/', dirname(__FILE__)) . "/../");//站点目录

require_once HOST . "framework/Database.php";

abstract class BaseUser
{
    /**
     * @var string 用户名
     */
    private $userName;

    /**
     * 构造函数
     * BaseUser constructor.
     * @param $userName string 用户名
     */
    public function __construct($userName = "")
    {
        $this->userName = $userName;
    }

    /**
     * 设置用户名
     * @param $userName string 用户名
     */
    public function setUserName($userName){
        $this->userName=$userName;
    }

    /**
     * 获取用户名
     * @return string 用户名
     */
    public function getUserName(){
        return $this->userName;
    }

    /**
     *获取用户标识，包括用户id,以及用户所在的组织
     * @return int 权限
     */
    public function getIdentify()
    {
        $sql = "select `id`,`club_id` from `user` where `username`=?";
        $conn = Database::getInstance();//获取接口
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(1, $this->userName);//绑定参数
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     *获取用户标识，包括用户id,权限,以及用户所在的组织
     * @param $userName string 用户名
     * @return int 权限
     */
    public static function getUserIdentify($userName)
    {
        $sql = "select `id`,`right`,`club_id` from `user` where `username`=?";
        $conn = Database::getInstance();//获取接口
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(1, $userName);//绑定参数
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * 检查账号是否正确，登陆用
     * @param $password string 密码
     * @return bool 是否正确
     */
    public function checkAccount($password)
    {
        $sql = "select `username` from `user` where `username`=? and `password`=?";
        $conn = Database::getInstance();
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(1, $this->userName);
        $stmt->bindParam(2,$password);

        $stmt->execute();

        return $stmt->rowCount() > 0 ? true : false;
    }

    /**
     * 获取用户key
     * @param $userName string 用户名
     * @return string key
     */
    public static function getKey($userName)
    {
        $sql = "select `salt` from `user` where `username`=? ";
        $conn = Database::getInstance();//获取接口
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(1, $userName);//绑定参数
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['salt'];
    }

    /**
     * 修改密码
     * @param $oldPassword string 新密码
     * @param $newPassword string 旧密码
     * @return bool 是否成功修改
     */
    public function editPassword($oldPassword, $newPassword)
    {
        $sql = "update `user` set `password`=? where `username`=? and `password`=?";
        $conn = Database::getInstance();
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(1, $newPassword);
        $stmt->bindParam(2, $this->userName);
        $stmt->bindParam(3, $oldPassword);
        $stmt->execute();

        return $stmt->rowCount() > 0 ? true : false;
    }

    /**
     * 创建密码
     * @param $newPassword string 新密码
     * @return bool 是否创建成功
     */
    public function createPassword($newPassword)
    {
        $sql = "update `user` set `password`=? where `username`=?";
        $conn = Database::getInstance();
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(1, $newPassword);
        $stmt->bindParam(2, $this->userName);
        $stmt->execute();

        return $stmt->rowCount() > 0 ? true : false;
    }

    /**
     * 通过用户名获取邮箱
     * @return string 邮箱
     */
    public function getMailByUserName()
    {
        $sql = "select `email` from `userInfo` where `username`=?";
        $conn = Database::getInstance();
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(1, $this->userName);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['email'];
    }

    /**
     *通过邮箱获取用户名
     * @param $email string 邮箱
     * @return string 用户名
     */
    public static function getNameByUserEmail($email)
    {
        $sql = "select `username` from `userInfo` where `email`=?";
        $conn = Database::getInstance();
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(1, $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['username'];
    }

    /**
     * 注册
     * @param $content array 用户注册信息
     * @return bool 是否注册成功
     */
    abstract public function register($content);

    /**
     * 显示信息
     * @param $usreName string 用户名
     * @return mixed 用户信息
     */
    abstract public function showInfo($usreName);

    /**
     * 编辑信息
     * @param $userName string 用户名
     * @param $content array or string 内容
     * @return bool 是否修改成功
     */
    abstract public function editInfo($userName, $content);

    /**
     * 获取类名
     * @return mixed 类名
     */
    public function getName()
    {
        return "BaseUser";
    }
}


