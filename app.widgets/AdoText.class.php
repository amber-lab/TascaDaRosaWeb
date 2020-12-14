<?php
class AdoText extends AdoField{
	public function __construct($name, $maxlength = 250){
		parent::__construct($name);

		$this->tag = new AdoElement('textarea');
		$this->tag->maxlength = $maxlength;
	}

	public function show(){
		$this->tag->name = $this->name;
		if(!parent::getEditable()){
			$this->tag->readonly = '1';
			$this->tag->class = 'adofield_disabled';
		}


		if($this->required){
			$this->tag->required = "";
		}

		$this->tag->add(htmlspecialchars($this->value));
		$this->tag->show();
	}
}
?>