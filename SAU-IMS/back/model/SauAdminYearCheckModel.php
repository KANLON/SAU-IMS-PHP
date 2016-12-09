<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/3
 * Time: 11:37
 */
define("APP", "SAU-IMS-PHP");//防止网址直接跳转,所有php和html必须存在
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
class YearCheckModel
{
    //将word转为html,并且返回word的内容,文件名用id或实际文件名的转码不能用中文，我们要预先帮他们转码
    function word2html($wordname, $htmlname)
    {
        define("UPLOADFILE_PATH", dirname(__DIR__) . "\\upload\\");//!!!如果要修改存放路径，改这里，要转化的word文档的文件名和转成的html的文件名“绝对路径”
        echo UPLOADFILE_PATH;
        $wordPath = UPLOADFILE_PATH . $wordname;
        $htmlPath = UPLOADFILE_PATH . $htmlname;
        $word = new COM("word.application") or die("找不到 Word 程序");              // 建立一个指向新COM组件的索引
        $word->Visible = 0;                                                                // 把它的可见性设置为0（假），如果要使它在最前端打开，使用1（真）
        try {
            $word->Documents->Open($wordPath) or die("无法打开这文件");
        } catch (Exception $e) {
            echo($e);
        }
        header("Content-Type: text/html;charset=utf-8");                            //设置文件的格式
        try {
            $word->Documents[1]->SaveAs($htmlPath, 8);                                       //把文档保存在目录中
        } catch (Exception $e) {
            print $e->getMessage();
        }
        $word->Quit();// 关闭与COM组件之间的连接
        unset($word);

    }


    //根据htmlId得到html的内容
    function GetHtmlContentByHtmlId($htmlId)
    {
        $sql = "select file_save,file_name from netdisk_file where file_id = $htmlId";
        $content = file_get_contents(UPLOADFILE_PATH . "$htmlId");
        $wordValue = @iconv("gb2312", "utf-8//IGNORE", $content);//使用@抵制错误，如果转换字符串中，某一个字符在目标字符集里没有对应字符，
        //那么，这个字符之后的部分就被忽略掉了；即结果字符串内容不完整，此时要使用//IGNORE
        return $wordValue;
    }


    //通过word的id删除word文件
    function DelWordByID($wordId)
    {
        if(isset($_GET['download'])){
            //过滤输入
            $file_id = intval($_GET['download']);
            //判断文件是否存在，取出文件保存位置
            $sql = "select file_save,file_name from netdisk_file where file_id = $file_id";

            if($download_file = fetchRow($sql)){
                //获取文件大小
                $file_size = filesize($download_file['file_save']);
                //设置HTTP响应消息为文件下载
                header('content-type:octet-stream');
                header('content-length: '.$file_size);
                header('content-disposition: attachment;filename="'.$download_file['file_name'].'"');
                //以只读的方式打开文件
                $fp = fopen($download_file['file_save'],'r');
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
            }else{
                $error[] = '文件不存在!';
            }
        }
    }
    
}