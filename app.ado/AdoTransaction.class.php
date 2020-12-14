<?php

final class AdoTransaction{
	private static $conn;
	private static $logger;

	private function __contruct(){}

	public static function open($database){
		if(empty(self::$conn)){
			self::$conn = AdoConnection::open($database);
			self::$conn->beginTransaction();
			self::$logger = Null;
		}
	}

	public static function get(){
		return self::$conn;
	}

	public static function rollback(){
		if (self::$conn){
			self::$conn->rollback();
			self::$conn = Null;
		}
	}

	public static function close(){
		if(self::$conn){
			self::$conn->commit();
			self::$conn = Null;
		}
	}

	public static function setLogger(AdoLogger $logger){
		self::$logger = $logger;
	}

	public static function log($message){
		if (self::$logger){
			self::$logger->write($message);
		}
	}
}
?>