<?php
/*
 * 数据库类
 */
class Database {
	private static $instance = null;
	private $link;
	
	// 构造函数
	public function Database() {
		$filename = "../config/config.ini";
		if (file_exists ( $filename )) {
			$ini = parse_ini_file ( $filename, true );
			$this->link = new mysqli ();
			$this->link->connect ( $ini ["localhost"], $ini ["username"], $ini ["password"], $ini ["database"] );
		}
	}
	
	// 获取数据库连接对象
	public static function getConnect() {
		if (! Database::$instance instanceof Database) {
			Database::$instance = new Database ();
			return Database::$instance;
		} else {
			return Database::$instance;
		}
	}
	
	// 检查账号
	public function checkAccount($userName, $password) {
		$this->link->query ( "call checkAccount($userName,$password);" );
		if (! $this->link->affected_rows) {
			return false;
		} else {
			return true;
		}
	}
}
?>