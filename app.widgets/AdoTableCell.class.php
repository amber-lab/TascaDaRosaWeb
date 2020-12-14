<?php
class AdoTableCell extends AdoElement{
	public function __construct($value){
		parent::__construct('td');
		parent::add($value);
	}
}
?>