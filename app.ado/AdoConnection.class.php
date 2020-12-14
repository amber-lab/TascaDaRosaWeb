<?php
final class AdoConnection{
	private function __construct(){}

	public static function open($name){
		if(file_exists("app.config/{$name}.ini")){
			$db = parse_ini_file("app.config/{$name}.ini");
		}
		else{
			throw new Exception("Arquivo '{$name}' não encontrado!\n");
		}

		$type = $db['type'];

		if($type == 'sqlite3'){
			$name = $db['name'];
		}
		else{
			$user = $db['user'];
			$pass = $db['pass'];
			$name = $db['name'];
			$host = $db['host'];
			$type = $db['type'];
		}

		switch($type){
			case 'pgsql':
				$conn = new PDO("pgsql:dbname={$name};user={$user};password={$pass};host={$host}");
				break;
			case 'mysql':
				$conn = new PDO("mysql:host={$host};port=3307;dbname={$name}", $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
				break;
			case 'sqlite3':
				$conn = new PDO("sqlite:app.config/{$name}");
				break;
		}

		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $conn;
	}
}
?>