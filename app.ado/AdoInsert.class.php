<?php
/*
*class AdoInsert
*Esta classe provê meios para manipulação de uma instrução de INSERT no banco de dados
*/

final class AdoInsert extends AdoInstruction{
	public function setRowData($column, $value){
		if(is_string($value)){
			$value = addslashes($value);
			$this->columnValues[$column] = "'$value'";
		}
		else if(is_bool($value)){
			$this->columnValues[$column] = $value ? 'TRUE' : 'False';
		}
		else if(isset($value)){
			$this->columnValues[$column] = $value;
		}
		else{
			$this->columnValues[$column] = "NULL";
		}
	}

	public function setCriterion(AdoCriterion $criterion){
		throw new Exception('Cannot call setCriterion from ' . __CLASS__);
	}

	public function getInstruction(){
		$this->sql = "INSERT INTO {$this->entity} (";
		$columns = implode(', ', array_keys($this->columnValues));
		$values = implode(', ', array_values($this->columnValues));
		$this->sql .= $columns . ')';
		$this->sql .= " VALUES ({$values})";
		return $this->sql;
	}
}