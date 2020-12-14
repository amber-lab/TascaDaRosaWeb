<?php

class AdoAction{
	private $action;
	private $param;

	public function __construct($action){
		$this->action = $action;
	}

	public function setParameter($param, $value){
		$this->param[$param] = $value;
	}

	public function serialize(){
		$url = array();
		if(is_array($this->action)){
			$url['class'] = get_class($this->action[0]);
			$url['method'] = $this->action[1];
		}
		elseif (is_string($this->action)){
			$url['method'] = $this->action;
		}
		if($this->param){
			$url = array_merge($url, $this->param);
		}

		return '?' . http_build_query($url);
	}
}
?>