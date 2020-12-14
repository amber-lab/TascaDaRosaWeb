<?php
class AdoElement{
	protected $name;
	protected $properties;
	protected $children;

	public function __construct($name){
		$this->name = $name;
	}

	public function __set($name, $value){
		$this->properties[$name] = $value;
	}

	public function add($child){
		$this->children[] = $child;
	}

	private function open(){
		echo "<{$this->name}";
		if ($this->properties){
			foreach ($this->properties as $name => $value) {
				echo " {$name}=\"{$value}\"";
			}
		}
		echo '>';
	}

	public function show(){
		$this->open();
		echo "\n";
		if($this->children){
			foreach ($this->children as $child) {
				if(is_object($child)){
					$child->show();
				}
				elseif(is_string($child) or is_numeric($child)){
					echo $child;
				}
			}
		}
		$this->close();
	}

	public function close(){
		$no_close = array('input', 'img', 'br');
		if(!in_array($this->name, $no_close)){
			echo "</{$this->name}>\n";
		}
	}
}
?>