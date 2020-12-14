<?php
class AdoDataGridColumn{
	private $name;
	private $label;
	private $align;
	private $width;
	private $action;
	private $transformer;

	public function __construct($name, $label, $align, $width){
		$this->name = $name;
		$this->label = $label;
		$this->align = $align;
		$this->width = $width;
	}

	public function getName(){
		return $this->name;
	}

	public function getLabel(){
		return $this->label;
	}

	public function getAlign(){
		return $this->align;
	}

	public function getWidth(){
		return $this->width;
	}

	public function setAction(AdoAction $action){
		$this->action = $action;
	}

	public function getAction(){
		if($this->action){
			return $this->action->serialize();
		}
	}

	public function setTransformer($callback){
		$this->transformer = $callback;
	}

	public function getTransformer(){
		return $this->transformer;
	}
}
?>