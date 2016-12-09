<?php
/**
 * Created by PhpStorm.
 * User: zhangcanlong
 * Date: 2016/12/3
 * Time: 14:24
 */
define("APP", "SAU-IMS-PHP");//防止网址直接跳转,所有php和html必须存在
require MODEL_PATH . "SauAdminYearCheckModel.php";
require_once FRAME_PATH . "ModelFactory.php";
set_error_handler("myerror");//自定义错误处理类
function myerror($errCode,$errMsg,$errFile,$errLine){
    $str="";
    $str.="<p>发生错误：";
    $str.="<br/>错误代号为：".$errCode;
    $str.="<br/>错误内容为：".$errMsg;
    $str.="<br/>错误文件为：".$errFile;
    $str.="<br/>错误行号为：".$errLine;
    $str.="<br/>发生时间为：".date("Y-d-m H:i;s");
    $str.="</p>";
    echo $str;
}
class YearCheckCtrl
{
    public function __construct()
    {

        session_start();
        $this->userName = $_SESSION['userName'];
        $this->cid = $_SESSION['club_id'];
        //$this->user = ModelFactory::adminFactory($this->userName);//创建管理员model类对象
        $this->user = ModelFactory::factory(SauAdminYearCheckModel);
        return;
    }

    //默认功能实现
    public function exec()
    {

        require_once VIEW_PATH . "admin/index.html";//载入管理界面
        return;
    }

    //预览word文件，就是打开html文件
    function viewHtmlAction()
    {
        if(isset($_POST['htmlId']) && !empty($_POST['htmlId'])){//判断要打开的html文件id是否传过来了
            $url = json_decode($_POST['htmlId']);//json转为php对象(stdClass)
            $htmlContent = $this->user ->GetHtmlContentByHtmlId($url);//根据id得到html文件文件的内容
            echo json_encode($htmlContent);
        }else{
            echo json_encode(false);
        }

    }

    //下载word文件
    function downloadWordAction()
    {
        if(isset($_POST['wordId']) && !empty($_POST['wordId'])){//判断要下载的word文件id是否传过来了
            $wordId = json_decode($_POST['wordId']);//json转为php对象(stdClass)
            $this->user ->GetWordByID($wordId);//根据wordId从数据库取出地址并弹出下载窗口
        }else{
            echo json_encode(false);
        }

    }

    //修改回复
    function editRepondAction()
    {
        if(isset($_POST['respondId']) && !empty($_POST['respondId'])){//判断要回复的内容是否传过来了
            //过滤输入
            $respond_id = intval($_POST['respondId']);
            $Assn_id=intval($_POST['clubId']);
            return  $success=$this->user ->EditRespondByAssnIDAndRespondId($Assn_id,$respond_id);//根据根据社团id和回复内容id把内容写进数据库
        }else{
            return false;
        }

    }


    //修改审核的状态，默认为通过
    function editCheckStatusAction()
    {
        if(isset($_POST['checkState']) && !empty($_POST['checkState'])) {//判断审核状态是否传过来了
            $success=$this->user ->EditCheckState($_POST['checkState']);
            return $success;
        }
        else{
            return false;
        }
    }

    //下载年度审核的模板文档
    function downloadTempletAction()
    {
        $TempletWordPath=dirname(__DIR__) . "//upload//check.doc";
        $file_size = filesize($TempletWordPath);
        //设置HTTP响应消息为文件下载
        header('content-type:octet-stream');
        header('content-length: '.$file_size);
        header('content-disposition: attachment;filename="'.$TempletWordPath .'"');
        //以只读的方式打开文件
        $fp = fopen($TempletWordPath,'r');
        //读取文件并输出
        $buffer = 1024;   //缓存
        $file_count = 0;  //文件大小计数
        //判断文件指针是否结束
        while (!feof($fp) && ($file_size - $file_count > 0)){
            $file_data = fread($fp,$buffer);
            $file_count += $buffer;
            echo $file_data;
        }
        fclose($fp); //关闭文件
        //终止脚本
        die;
    }
    //删除模板文件
    function delTempletAction(){
        unlink('./uploads/TempletFile');
    }

    //上传模板文件
    function uploadTempletAction()
    {
        if ((($_FILES["file"]["type"] == "application/msword")
                || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document"))
            && ($_FILES["file"]["size"] < 20 * 1024 * 1024)
        )         //限定文件上传的类型和大小，限定上传文件类型只能为doc或docx，小于10m。
        {
            if ($_FILES["file"]["error"] > 0) {
                echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
            } else {
                echo "Upload: " . $_FILES["file"]["name"] . "<br />";//判断上传的文件是以什么结尾，到时候再加什么后缀名
                if ($_FILES["file"]["type"] === "application/msword")
                    $fileExtension = "doc";
                if ($_FILES["file"]["type"] === "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
                    $fileExtension = "docx";
                var_dump($_FILES["file"]["type"]);
                $saveWorddFilePath = dirname(__DIR__);
                if (file_exists("$saveWorddFilePath = dirname(__DIR__);
                  " . "/uploads/TempletFile" . $_FILES["file"]["name"])) {
                    return false;//文件已经存在;
                } else {
                    //*保存word文件
                    move_uploaded_file($_FILES["file"]["tmp_name"],
                        $saveWorddFilePath . $_FILES["file"]["name"]);
                    // */
                    $file_save_path = './uploads/TempletFile' ;
                    //递归创建文件夹
                    if (!file_exists($file_save_path)) mkdir($file_save_path, 0777, true);
                    //拼接文件名
                    $file_save_path .= md5($_FILES["file"]["name"]) . ".$fileExtension";
                    return true;
                }
            }
        } else {
            return false;//上传文件的类型错误，请上传word文档
        }
    }

    /**
     * 对数据进行安全处理
     * @param string $data 待转义字符串
     * @return string 转义后的字符串
     */
    function safeHandle($data)
    {
        //转义字符串中的HTML标签
        $data = htmlspecialchars($data);
        //转义字符串中的特殊字符
        $data = mysql_real_escape_string($data);
        return $data;
    }

}


