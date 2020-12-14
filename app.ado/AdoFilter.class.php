<?php
/*
*class FWSqlFilter
*Esta classe oferece uma interface para definição de filtros de seleção
*/
class AdoFilter extends AdoExpression{
	private $variable;
	private $operator;
	private $value;

	public function __construct($variable, $operator, $value){
		$this->variable = $variable;
		$this->operator = $operator;
		$this->value = $this->transform($value);
	}

	private function transform($value){
		if(is_array($value)){
			$values = array();
			foreach($value as $v){
				if(is_integer($v)){
					$values[] = $v;
				}
				else if(is_string($v)){
					$values[] = "'$v'";
				}
			}
			$result = '(' . implode(',', $values) . ')';
		}
		else if(is_string($value)){
			$result = "'$value'";
		}
		else if(is_null($value)){
			$result = 'NULL';
		}
		else if(is_bool($value)){
			$result = $value ? 'TRUE' : 'FALSE';
		}
		else{
			$result = $value;
		}
		return $result;
	}

	public function dump(){
		return "{$this->variable} {$this->operator} {$this->value}";
	}
}
?>