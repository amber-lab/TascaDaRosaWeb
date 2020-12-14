<?php
class AdoImage extends AdoElement{
	private $source;

	public function __construct($source, $alt=''){
		parent::__construct('img');
		$this->src = $source;
		if($alt){
			$this->alt = $alt;
		}
		else{
			$alt = array_reverse(explode('/', $source))[0];
			$alt = explode('.', $alt)[0];
			$this->alt = $alt;
		}
	}
}
?>