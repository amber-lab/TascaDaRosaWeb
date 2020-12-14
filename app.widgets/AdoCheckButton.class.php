<?php

class AdoCheckButton extends AdoField{
	public function show(){
		$this->tag->name = $this->name;
		$this->tag->value = $this->value;
		$this->tag->type = 'checkbox';

		if(!parent::getEditable()){
			$this->tag->readonly = "1";
			$this->tag->class = 'adofield_disabled';
		}

		$this->tag->show();
	}
}
?>