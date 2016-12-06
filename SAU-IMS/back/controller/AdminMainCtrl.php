<?php

/**
 * Created by PhpStorm.
 * User: APone
 * 管理员主界面控制类
 * “text”：搜索内容
 * “l”：限制获得的公告的数目，左边界
 * “r”：右边界
 * Date: 2016/11/24
 * Time: 19:55
 */
defined("APP") or die("error");

class AdminMainCtrl
{

    private $user;

    public function __construct()
    {
        session_start();//打开session
        $userName = $_SESSION['userName'];//获取管理员用户名
        $this->user = ModelFactory::adminFactory($userName);//识别和创建管理员model类对象
    }

    /**
     * 默认功能实现,初始化以及加载页面
     */
    public function exec()
    {
        require_once VIEW_PATH . "admin/index.html";//加载管理界面
    }

    /**
     * 获得管理员发布的公告
     */
    public function getSendNotices()
    {
        if (isset($_POST['limit']) && !empty($_POST['limit'])) {
            $limit = json_decode($_POST['limit'], true);
            $l = (int)$limit['l'];//限制获得的公告数目
            $r = (int)$limit['r'];
            $notices = $this->user->getSendNotices($l, $r);//得到公告信息
            echo json_encode($notices);//没有公告或查询失败，数组notices为空，
        } else {
            echo json_encode(false);
        }
    }

    /**
     * 管理员删除公告
     */
    public function deleteNotices()
    {
        if (isset($_POST['noticeIds']) && !empty($_POST['noticeIds'])) {//判断要删除的公告id是否传过来了
            $nid = json_decode($_POST['noticeIds'], true);//json转为php对象(stdClass)
            $sussess = $this->user->deleteNotice($nid);//根据id删除公告，成功返回true失败返回false
            echo json_encode($sussess);
        } else {
            echo json_encode(false);
        }
    }

    /**
     * 新建公告
     */
    public function addNotice()
    {
        if (isset($_POST['notice']) && !empty($_POST['notice'])) {
            $notice = json_decode($_POST['notice'], true);
            $success = $this->user->addNotice($notice);//调用SauAdmin类的添加公告的方法
            echo json_encode($success);
        } else {
            echo json_encode(false);
        }
    }

    /**
     * 搜索发布的公告
     */
    public function searchNotices()
    {
        if (isset($_POST['search']) && !empty($_POST['search'])) {//传数组过来
            $notice = json_decode($_POST['search'], true);
            $text = $notice["text"];//还没转义

            $l = (int)$notice['l'];
            $r = (int)$notice['r'];
            $notices = $this->user->searchSendNoticesByTitle($text, $l, $r);
            echo json_encode($notices);
        } else {
            echo json_encode(false);
        }
    }

    /**
     * 根据传过来的id获得一条公告的信息
     */
    public function getNoticeById()
    {
        if (isset($_POST['nid']) && !empty($_POST['nid'])) {
            $nid = (int)$_POST['nid'];
            $notice = $this->user->getNoticeById($nid);
            echo json_encode($notice);
        } else {
            echo json_encode(false);
        }
    }

    /**
     * 社团管理员收到的公告，即校社联公告
     */
    public function getSauNotices()
    {
        if (isset($_POST['limit']) && !empty($_POST['limit'])) {
            $limit = json_decode($_POST['limit'], true);
            $l = (int)$limit['l'];//限制获得的公告数目
            $r = (int)$limit['r'];

            //得到公告信息
            $notices = $this->user->getSauNotices($l, $r);//ClubAdmin特有的方法
            echo json_encode($notices);//没有公告或查询失败，数组notices为空，
        } else {
            echo json_encode(false);

        }
    }

    /**
     * 搜索社团管理员收到的公告
     */
    public function searchSauNotices()
    {
        if (isset($_POST['search']) && !empty($_POST['search'])) {//传数组过来
            $notice = json_decode($_POST['search'], true);
            $text = $notice["text"];//还没转义

            $l = (int)$notice['l'];
            $r = (int)$notice['r'];
            $notices = $this->user->searchSauNoticesByTitle($text, $l, $r);//ClubAdmin特有的方法
            echo json_encode($notices);
        } else {
            echo json_encode(false);
        }
    }

    /**
     * 将公告未读的状态设为已读
     *
     */
    public function setNoticeRead()
    {
        if (isset($_POST['nid']) && !empty($_POST['nid'])) {//公告id
            $nid = $_POST['nid'];//可以不用转为int
            $sussess = $this->user->setNoticeRead($nid);
            echo json_encode($sussess);
        } else {
            echo json_encode(false);
        }
    }

    /**
     * 删除用户自己的公告
     * 这里只有社团管理员删除校社联发来的公告时需要用到
     */
    public function deleteUserNotice()
    {
        if (isset($_POST['noticeIds']) && !empty($_POST['noticeIds'])) {
            $nid = json_decode($_POST['noticeIds'], true);
            $sussess = $this->user->deleteUserNotice($nid);
            echo json_encode($sussess);
        } else {
            echo json_encode(false);
        }
    }
}