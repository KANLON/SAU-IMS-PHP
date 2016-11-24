<?php
/**
 * Created by PhpStorm.
 * User: APone
 * 各种路径的路径配置
 * Date: 2016/11/23
 * Time: 20:29
 */
//example: include_once/include/require_once/require MODEL_PATH."BaseUser.php";

//***************************各文件夹路径**************************//

define("MODEL_PATH","./model/");//模型类路径
define("VIEW_PATH","./view/");//视图类路径
define("CTRL_PATH","./controller/");//控制类路径
define("CONFIG_PATH","./config/");//配置文件路径
define("FRAME_PATH","./framework/");//基础类路径

//***************************网址虚拟路径**************************//

define("__HOST__","http://localhost/SAU-IMS-N/");//根据需要修改SAU-IMS-N

//****************************配置文件路径*************************//

define("dbConfig","./config/dbConfig.ini");//数据库配置文件路径
define("mailConfig","./config/mailConfig.ini");//邮箱信息配置文件

//****************************************************************//
