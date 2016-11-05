<?php
/**
 * Created by PhpStorm.
 * 数据库操作类
 * User: APone
 * Date: 2016/10/29
 * Time: 15:42
 */
class Database
{
    private static $instance;//数据库类接口
    private $link;//数据库接口
    private $iniFileName ="../config/dbConfig.ini";//配置文件地址

    const ADMIN = 0;
    const USER = 1;

    /*
     * 构造函数私有
     */
    private function Database()
    {
        $info = $this->loadConfig();

        $content = "$info[dbms]:host=$info[host];port=$info[port];dbname=$info[dbname];charset=$info[charset]";
        try {
            $this->link = new PDO($content, $info['username'], $info['password']);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /*
     * 加载配置文件信息，返回数组类型
     */
    private function loadConfig()
    {
        if (file_exists($this->iniFileName)) {
            $info = parse_ini_file($this->iniFileName, true);
            if (empty($info)) {
                echo "未完成数据库配置文件";
                die();
            }
            return $info;
        } else {
            echo "数据库配置文件不存在";
            die();
        }
    }

    /*
     * 转义语句
     */
    public function safeHandle($content)
    {
        return htmlspecialchars($content);
    }


    /*
     *获得数据库类
     */
    public static function getInstance()
    {
        if (self::$instance instanceof Database) {
            return self::$instance;
        } else {
            return self::$instance = new Database();
        }
    }

    /*
     * 获得数据库连接
     */
    public function getConn(){
        return $this->link;
    }

}

