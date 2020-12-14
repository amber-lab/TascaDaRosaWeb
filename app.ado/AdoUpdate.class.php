<?php
/*
*classe AdoUpdate
*Esta classe provê meios para manipulação de uma instrução de UPDATE no banco de dados
*/

final class AdoUpdate extends AdoInstruction{
	public function setRowData($column, $value){
		if (is_string($value)){
			$value = addslashes($value);
			$this->columnValues[$column] = "'$value'";
		}
		else if(is_bool($value)) {
			$this->columnValues[$column] = $value ? 'TRUE' : 'FALSE';
		}
		else if(isset($value)){
			$this->columnValues[$column] = $value;
		}
		else{
			$this->columnValues[$column] = 'NULL';
		}
	}
	public function getInstruction(){
		$this->sql = "UPDATE {$this->entity}";
		if($this->columnValues){
			foreach($this->columnValues as $column=>$value){
				$set[] = "{$column} = {$value}";
			}
		}
		$this->sql .= ' SET ' . implode(', ', $set);
		if($this->criterion){
			$this->sql .= ' WHERE ' . $this->criterion->dump();
		}
		return $this->sql;
	}
}


?>