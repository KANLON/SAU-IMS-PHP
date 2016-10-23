<?php
require "../model/Database.class.php";

if ($_SERVER ["REQUEST_METHOD"] == "POST") { // 是否有表单提交
	$link = Database::getConnect (); // 获取数据库连接
	
	$userName = isset ( $_POST ["userName"] ) ? $_POST ["userName"] : ""; // 获取用户名
	$password = isset ( $_POST ["password"] ) ? $_POST ["password"] : ""; // 获取密码
	
	if (empty ( $userName ) || empty ( $password )) { // 为空提示
		echo "用户名或密码不能为空";
		die ();
	}
	
	$password = md5 ( $password ); // md5加密
	$isCorrect = $link->checkAccount ( $userName, $password );
	
	if ($isCorrect) { // 如果正确则转到其他页面
		header ( "Loaction:XXXX.php" );
		die ();
	} else {
		echo "用户或密码错误";
	}
}
?>