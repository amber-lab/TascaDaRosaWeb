<?php
class AdoPassword extends AdoField{
	public function show(){
		$this->tag->name = $this->name;
		$this->tag->id = $this->name;
		$this->tag->value = $this->value;
		$this->tag->type = 'password';

		if(!parent::getEditable()){
			$this->tag->readonly = '1';
			$this->tag->class = 'adofield_disabled';
		}

		if($this->required){
			$this->tag->required = "";
		}

		$this->tag->show();
	}
}
?>