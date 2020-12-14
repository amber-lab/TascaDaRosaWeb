<?php

/*
*classe AdoDelete
*Esta classe provê meios para manipulação de uma instrução de DELETE no banco de dados
*/

final class AdoDelete extends AdoInstruction
{
	public function getInstruction(){
		$this->sql = "DELETE FROM {$this->entity}";
		if($this->criterion){
			$this->sql .= ' WHERE ' . $this->criterion->dump();
		}
		return $this->sql;
	}
}
?>