<?php
class AdoHidden extends AdoField{
	public function show(){
		$this->tag->name = $this->name;
		$this->tag->id = $this->name;
		$this->tag->value = $this->value;
		$this->tag->type = 'hidden';
		$this->tag->show();
	}
}
?>