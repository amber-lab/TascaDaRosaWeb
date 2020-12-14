<?php
class AdoCheckGroup extends AdoField{
	private $items;
	private $itemsvalues;

	public function setLayout($dir){
		$this->layout = $dir;
	}

	public function addItems($items){
		$this->items = $items;
	}

	public function addItemsValues($items){
		$this->itemsvalues = $items;
	}

	public function show(){
		if ($this->items){
			foreach ($this->items as $index => $label) {
				$obj = new AdoLabel($label);
				$button = new AdoCheckButton("{$this->name}[]");
				if($this->itemsvalues){
					$button->setValue($this->itemsvalues[$index]);
				}
				else{
					$button->setValue($index);
				}
				if(@in_array($index, $this->value)){
					$button->setProperty('checked', '1');
				}
				$obj->add($button);
				$obj->show();
			}
		}
	}
}
?>