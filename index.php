<?php
header('Content-type: text/html; charset=utf-8');

function __autoload($class){
	$pastas = array('app.widgets', 'app.ado', 'app.model', 'app.control');
	foreach ($pastas as $pasta) {
		if(file_exists("$pasta/$class.class.php")){
			include_once("$pasta/$class.class.php");
		}
	}
}

class AdoApplication{
	static public function run(){
		$template = file_get_contents('template.php');

		$class = array_key_exists('class', $_GET) ? $_GET['class'] : False;
		$method = array_key_exists('method', $_GET) ? $_GET['method'] : False;
		
		if($class and class_exists($class)){
			ob_start();
			$page = new $class;
			$page->show();
			$content = ob_get_contents();
			ob_end_clean();
		}
		elseif(function_exists($method)){
			call_user_func($method, $_GET);
		}
		else{
			ob_start();
			$page = new HomePage;
			$page->show();
			$content = ob_get_contents();
			ob_end_clean();
		}
		if(isset($content)){
			echo str_replace('#CONTENT#', $content, $template);
		}
		else{
			echo str_replace('#CONTENT#', '', $template);
		}
	}
}
AdoApplication::run();
?>