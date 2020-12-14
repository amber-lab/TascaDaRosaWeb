<?php
class AdoCriterion extends AdoExpression{
	private $expressions;
	private $operators;
	private $properties;

	public function add(AdoExpression $expression, $operator = self::AND_OPERATOR){
		if(empty($this->expressions)){
			unset($operator);
			$this->operators[] = '';
		}
		else{
			$this->operators[] = $operator;
		}
		$this->expressions[] = $expression;
	}

	public function dump(){
		if(is_array($this->expressions)){
			$result = '';
			foreach($this->expressions as $c => $expression){
				$operator = $this->operators[$c];
				$result .= $operator . $expression->dump() . ' ';
			}
			$result = trim($result);
			return "({$result})";
		}
	}

	public function setProperty($property, $value){
		$this->properties[$property] = $value;
	}

	public function getProperty($property){
		if($this->properties and array_key_exists($property, $this->properties)){
			return $this->properties[$property];
		}
	}
}