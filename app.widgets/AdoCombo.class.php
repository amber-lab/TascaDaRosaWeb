<?php

class AdoCombo extends AdoField{
	private $items;

	public function __construct($name){
		parent::__construct($name);
		$this->tag = new AdoElement('select');
		$this->tag->class = 'adofield';
	}

	public function addItems($items){
		$this->items = $items;
	}

	public function show(){
		$this->tag->name = $this->name;
		$this->tag->id = $this->name;

		if ($this->items){
			$option = new AdoElement('option');
			$option->value = 0;
			$option->selected = 1;
			$option->add('');
			$this->tag->add($option);

			foreach ($this->items as $key => $value) {
				$option = new AdoElement('option');
				/*valor a retornar*/
				$option->value = $key+1;
				$option->add($value);
				$this->tag->add($option);
			}
		}

		if (!parent::getEditable()){
			$this->tag->readonly = "1";
			$this->tag->class = 'adofield_disabled';
		}
		if($this->required){
			$this->tag->required = "";
		}
		$this->tag->show();
	}
}
?>