<?php

class AdoTableRow extends AdoElement{
	
	public function __construct(){
		parent::__construct('tr');
	}

	public function addCell($value){
		$cell = new AdoTableCell($value);
		parent::add($cell);
		return $cell;
	}
}
?>