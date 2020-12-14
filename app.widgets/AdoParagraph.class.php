<?php

class AdoParagraph extends AdoElement{
	public function __construct($text, $t = 'p'){
		parent::__construct($t);
		parent::add($text);
	}
}

?>