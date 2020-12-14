<?php
class AdoFigure extends AdoElement{
	function __construct($href, $figcaption = ''){
		parent::__construct('figure');
		parent::add(new AdoImage($href));
		if($figcaption){
			$caption = new AdoElement('figcaption');
			$caption->add($figcaption);
			parent::add($caption);
		}
	}
}

?>