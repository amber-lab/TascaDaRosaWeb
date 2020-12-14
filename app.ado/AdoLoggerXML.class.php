<?php
class AdoLoggerXML extends AdoLogger{
	public function write($message){
		$time = date("Y-m-d H:i:s");
		$text = "<log>\n";
		$text .= "\t<time>{$time}</time>\n";
		$text .= "\t<message>{$message}</message>\n";
		$text .= "</log>\n";

		$handler = fopen($this->filename, 'a');
		fwrite($handler, $text);
		fclose($handler);
	}
}
?>