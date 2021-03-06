<?php
class AdoTel extends AdoField{

	public function show(){
		$this->tag->name = $this->name;
		$this->tag->id = $this->name;
		if($this->value){
			$this->tag->value = $this->value;
		}
		$this->tag->type = 'tel';
		$this->tag->pattern = '[0-9]{9}';
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