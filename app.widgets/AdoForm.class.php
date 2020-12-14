<?php

class AdoForm{
	protected $fields;
	private $name;
	protected $class;

	public function __construct($name = 'my_form'){
		$this->setName($name);
	}

	public function setName($name){
		$this->name = $name;
	}

	public function setEditable($bool){
		if($this->fields){
			foreach ($this->fields as $object) {
				$object->setEditable($bool);
			}
		}
	}

	public function setClass($class){
		$this->class = $class;
	}

	public function setOnSubmit($funct){
		$this->onsubmit = $funct;
	}

	public function setAction(AdoAction $action){
		$this->action = $action;
	}

	public function setFields($fields){
		foreach ($fields as $field) {
			if ($field instanceof AdoField){
				$name = $field->getName();
				$this->fields[$name] = $field;
				if($field instanceof AdoButton OR $field instanceof AdoSubmit){
					$field->setFormName($this->name);
				}
			}
		}
	}

	public function getField($name){
		return $this->fields[$name];
	}

	public function setData($object){
		foreach ($this->fields as $name => $field){
			@$field->setValue($object->$name);
		}
	}

	public function getData($class = 'StdClass'){
		$object = new $class;
		foreach ($_POST as $key => $value) {
			if (get_class($this->fields[$key]) == 'AdoCombo'){
				if ($value !== '0'){
					$object->$key = $value;
				}
			}
			else{
				$object->$key = $value;
			}
		}
		foreach ($_FILES as $key => $content){
			$object->$key = $content['tmp_name'];
		}
		return $object;
	}

	public function add($object){
		$this->child = $object;
	}

	public function show(){
		$tag = new AdoElement('form');
		$tag->name = $this->name;
		$tag->method = 'post';
		$tag->class = (isset($this->class)) ? $this->class : NULL;
		$tag->onsubmit = (isset($this->onsubmit)) ? "return {$this->onsubmit}()" : NULL;
		$tag->action = (isset($this->action)) ? $this->action->serialize() : NULL;
		$tag->add($this->child);
		$tag->show();
	}
}
?>