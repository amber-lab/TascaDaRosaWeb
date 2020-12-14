<?php
class AdoRadioButton extends AdoField{
	public function show(){
		$this->tag->name = $this->name;
		$this->tag->id = $this->name;
		$this->tag->value = $this->value;
		$this->tag->type = 'radio';

		if(!parent::getEditable()){
			$this->tag->readonly = "1";
			$this->tag->class = 'adofield_disabled';
		}

		$this->tag->show();
	}
}