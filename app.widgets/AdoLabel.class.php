<?php
class AdoLabel extends AdoElement{
	function __construct($value, $id = null){
		parent::__construct('label');
		$this->add($value);
		if($id){
			$this->for = $id;
		}
	}
}
?>