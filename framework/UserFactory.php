<?php
/**
 * Created by PhpStorm.
 * User: APone
 * Date: 2016/10/31
 * 单例工厂模式，加入类名即可返回对象，类放在model文件夹
 * Time: 23:52
 */
class UserFactory
{
    private static $classGroup = array();

    public static function factory($name)
    {
        $classFIle = "../model/$name.php";

        if (!file_exists($classFIle)) {//检测modei文件夹是否存在该类
            throw new ClassNotFoundException("can't found this class");//无则抛出异常
        }

        if (!isset(self::$classGroup[$name]) || !(self::$classGroup[$name] instanceof $name)) {//检测是否已存在该类实例或不对货
            return self::$classGroup[$name] = new $name();
        }
        return self::$classGroup[$name];//返回该实例

    }
}

class ClassNotFoundException extends Exception//找不到类异常类
{
    private $error;

    public function __construct($message)
    {

        $this->error = $message;
    }

    public function getError()//获得异常信息
    {
        echo $this->error;
    }
}

