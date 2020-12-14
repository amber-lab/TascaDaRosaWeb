<?php
class AdoSession{
	function __construct(){
		session_start();
	}

	function setValue($var, $value){
		$_SESSION[$var] = $value;
	}

	function getValue($var){
		if(array_key_exists($var, $_SESSION)){
			return $_SESSION[$var];
		}
	}

	function freeSession(){
		$_SESSION = array();
		session_destroy();
	}
}
?>