<?php

class AdoList extends AdoElement{
	function __construct($listtype){
		parent::__construct("$listtype");
	}

	function add($items){
		if(is_array($items)){
			foreach ($items as $item) {
				$li = new AdoElement('li');
				$li->add($item);
				parent::add($li);
			}
		}
		else{
			$li = new AdoElement('li');
			$li->add($items);
			parent::add($li);

		}
	}
}

?>