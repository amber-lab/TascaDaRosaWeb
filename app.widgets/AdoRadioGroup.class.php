<?php
class AdoRadioGroup extends AdoField{
	private $layout = 'vertical';
	private $items;

	public function setLayout($dir){
		$this->layout = $dir;
	}

	public function addItems($items){
		$this->items = $items;
	}

	public function show(){
		if ($this->items){
			foreach ($this->items as $index => $label) {
				$button = new AdoRadioButton("{$this->name}[]");
				$button->setValue($index);
				if($this->value == $index){
					$button->setProperty('checked', '1');
				}
				$button->show();
				$obj = new AdoLabel($label);
				$obj->show();

				if($this->layout == 'vertical'){
					$br = new AdoElement('br');
					$br->show();
					echo "\n";
				}
			}
		}
	}
}
?>