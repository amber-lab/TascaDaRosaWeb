<?php

class AdoTable extends AdoElement{
	
	public function __construct(){
		parent::__construct('table');
	}

	public function addRow(){
		$row = new AdoTableRow;
		parent::add($row);
		return $row;
	}
}
?>