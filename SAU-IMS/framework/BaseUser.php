<?php
/**
 * Created by PhpStorm.
 * 用户抽象类，一切其他权限用户类必须继承该类
 * User: APone
 * Date: 2016/11/5
 * Time: 12:15
 */

defined("APP") or die("error");

abstract class BaseUser
{
    /**
     * 校社联管理员
     */
    const SAU_ADMIN = 2;

    /**
     * 社团管理员
     */
    const CLUB_ADMIN = 1;

    /**
     * 普通用户
     */
    const GENERAL_USER = 0;

    /**
     * 为确认新注册用户
     */
    const NOAPPLY_USER = -1;

    /**
     * @var string 用户名
     */
    private $userName;

    /**
     * @var int 用户id
     */
    private $id;

    /**
     * @var int 组织标识
     */
    private $clubId;

    /**
     * @var int 权限标识
     */
    private $right;

    /**
     * 构造函数
     * BaseUser constructor.
     * @param $userName string 用户名
     */
    public function __construct($userName)
    {
        $this->userName = $userName;
        $this->getIdentify();//识别用户，无论是否调用checkAccount方法或该用户是否存在
    }

    /**
     *获取用户标识，包括用户id,以及用户所在的组织
     */
    private function getIdentify()
    {
        $sql = "select `id`,`club_id`,`right` from `user` where `username`=?";
        $conn = Database::getInstance();//获取接口
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(1, $this->userName);//绑定参数
        $stmt->execute();
        $info = $stmt->fetch(PDO::FETCH_ASSOC);//获取用户信息
        $this->id = isset($info["id"]) ? $info["id"] : 0;
        $this->clubId = isset($info["club_id"]) ? $info["club_id"] : 0;
        $this->right = isset($info["right"]) ? $info["right"] : -1;
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
        $stmt->bindParam(2, $password);

        $stmt->execute();

        return $stmt->rowCount() > 0 ? true : false;
    }

    /**
     * 获取用户key
     * @return string key
     */
    public function getKey()
    {
        $sql = "select `salt` from `user` where `username`=? ";
        $conn = Database::getInstance();//获取接口
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(1, $this->userName);//绑定参数
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
    public function getEmail()
    {
        $sql = "select `email` from `user` where `username`=?";
        $conn = Database::getInstance();
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(1, $this->userName);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['email'];
    }


    /**
     * 该用户是否存在
     * @return bool
     */
    public function isExits()
    {
        $sql = "select `username` from `user` where `username`=?";
        $conn = Database::getInstance();
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(1, $this->userName);
        $stmt->execute();

        return $stmt->rowCount() > 0 ? true : false;
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
     * 设置用户名
     * @param $userName string 用户名
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * 获取用户名
     * @return string 用户名
     */
    public function getUserName()
    {
        return isset($this->userName) ? $this->userName : "";
    }

    /**
     * 设置用户id
     * @param $id int 用户id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * 获取用户id(默认0)
     * @return int
     */
    public function getId()
    {
        return isset($this->id) ? $this->id : 0;
    }

    /**
     * 设置用户组织标识
     * @param $clubId int
     */
    public function setClubId($clubId)
    {
        $this->clubId = $clubId;
    }

    /**
     * 获取用户组织标识
     * @return int
     */
    public function getClubId()
    {
        return isset($this->clubId) ? $this->clubId : 0;
    }

    /**
     * 设置用户权限,不要随便调用
     * @param $right int 权限
     * @return bool 是否修改成功
     */
    public function setRight($right)
    {
        if ($right < -1 || $right > 2 || empty($right)) {
            $this->right = 0;
        } else {
            $this->right = $right;
        }

        $sql = "update `user` set `right`=? where `username`=?";
        $conn = Database::getInstance();
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(1, $this->right);
        $stmt->bindParam(2, $this->userName);
        $stmt->execute();

        return $stmt->rowCount() > 0 ? true : false;
    }

    /**
     * 获取用户权限
     * @return int
     */
    public function getRight()
    {
        return isset($this->right) ? $this->right : -1;
    }
}


