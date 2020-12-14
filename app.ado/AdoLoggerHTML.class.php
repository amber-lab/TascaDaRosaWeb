<?php
class AdoLoggerHTML extends AdoLogger{
	public function write($message){
		$time = date("Y-m-d H:i:s");
		$text = "<p>\n";
		$text .= "\t<b>{$time}</b><br>\n";
		$text .= "\t<i>{$message}</i>\n";
		$text .= "</p><br>\n";

		$handler = fopen($this->filename, 'a');
		fwrite($handler, $text);
		fclose($handler);
	}
}
?>