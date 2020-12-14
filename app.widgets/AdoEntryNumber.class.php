<?php
class AdoEntryNumber extends AdoField{
	public function __construct($name, $min, $max){
		parent::__construct($name);
		$this->tag->min = $min;
		$this->tag->max = $max;
	}

	public function show(){
		$this->tag->name = $this->name;
		$this->tag->id = $this->name;
		if($this->value){
			$this->tag->value = $this->value;
		}
		$this->tag->type = 'number';
		if(!parent::getEditable()){
			$this->tag->readonly = 1;
			$this->tag->class = 'adofield_disabled';
		}
		if($this->required){
			$this->tag->required = "";
		}
		$this->tag->show();
	}
}
?>