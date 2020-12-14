<?php
class AdoSubmit extends AdoField{
	private $action;
	private $label;
	private $formName;

	public function setAction($action, $label = 'Submeter'){
		$this->action = $action;
		$this->label = $label;
	}

	public function setLabel($label){
		$this->label = $label;
	}

	public function setFormName($name){
		$this->formName = $name;
	}

	public function show(){
		if(isset($this->action)){
			$url = $this->action->serialize();
		}
		
		$this->tag->name = $this->name;
		$this->tag->id = $this->name;
		$this->tag->type = 'submit';
		$this->tag->value = $this->label;

		if(!parent::getEditable()){
			$this->tag->disabled = '1';
			$this->tag->class = 'adofield_disabled';
		}

		$this->tag->show();
	}
}
?>