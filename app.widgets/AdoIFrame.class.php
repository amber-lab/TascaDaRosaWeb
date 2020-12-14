<?php

class AdoIFrame extends AdoElement{
	function __construct($src){
		parent::__construct('iframe');
		$this->src = $src;
		$this->width = '600';
		$this->height = '450';
		$this->frameborder = '0';
		$this->style = "border:0";
		$this->allowfullscreen = "";
		$this->aria_hidden = "false";
		$this->tabindex = "0";
	}
}

?>