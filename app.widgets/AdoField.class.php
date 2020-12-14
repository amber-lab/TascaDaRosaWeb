<?php
abstract class AdoField{
	protected $name;
	protected $id;
	protected $size;
	protected $value;
	protected $editable;
	protected $tag;
	protected $required;

	public function __construct($name){
		self::setEditable(True);
		self::setName($name);
		$this->tag = new AdoElement('input');
	}

	public function setRequired($bool){
		$this->required = $bool;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getName(){
		return $this->name;
	}

	public function setValue($value){
		$this->value = $value;
	}

	public function getValue(){
		return $this->value;
	}

	public function setEditable($editable){
		$this->editable = $editable;
	}

	public function getEditable(){
		return $this->editable;
	}

	public function setProperty($name, $value){
		$this->tag->$name = $value;
	}

	public function setId($name){
		$this->tag->id = $name;
	}

	public function setPlaceholder($placeholder){
		$this->tag->placeholder = $placeholder;
	}
}
?>