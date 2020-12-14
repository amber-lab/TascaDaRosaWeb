<?php

class AdoEntry extends AdoField{

	public function show(){
		$this->tag->name = $this->name;
		$this->tag->id = $this->name;
		if($this->value){
			$this->tag->value = $this->value;
		}
		$this->tag->type = 'text';

		if($this->required){
			$this->tag->required = "";
		}

		if(!parent::getEditable()){
			$this->tag->readonly = 1;
			$this->tag->class = 'adofield_disabled';
		}

		$this->tag->show();
	}
}
?>