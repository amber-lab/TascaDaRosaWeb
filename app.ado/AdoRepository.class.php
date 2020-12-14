<?php

final class AdoRepository{
	
	private $class;

	function __construct($class){
		$this->class = $class;
	}

	function load(AdoCriterion $criterion){
		$sql = new AdoSelect;
		$sql->addColumn('*');
		$sql->setEntity(strtolower($this->class));
		$sql->setCriterion($criterion);

		if($conn = AdoTransaction::get()){
			AdoTransaction::log($sql->getInstruction());
			$result = $conn->query($sql->getInstruction());
			if($result){
				while($row = $result->fetchObject($this->class . 'Record')){
					$results[] = $row;
				}
				if(!empty($results)){
					return $results;
				}
				else{
					throw new Exception('Empty result'."\n");
				}
			}
		}
		else{
			throw new Exception("No Active AdoTransaction\n");
		}
	}

	function delete(AdoCriterion $criterion){
		$sql = new AdoDelete;
		$sql->setEntity(strtolower($this->class));
		$sql->setCriterion($criterion);

		if($conn = AdoTransaction::get()){
			AdoTransaction::log($sql->getInstruction());
			$result = $conn->exec($sql->getInstruction());
			return $result;
		}
		else{
			throw new Exception('No Active AdoTransaction');
		}
	}

	function count(AdoCriterion $criterion){
		$sql = new AdoSelect;
		$sql->addColumn('count(*)');
		$sql->setEntity(strtolower($this->class));
		$sql->setCriterion($criterion);

		if($conn = AdoTransaction::get()){
			AdoTransaction::log($sql->getInstruction());
			$result = $conn->query($sql->getInstruction());
			if($result){
				$row = $result->fetch();
			}
			return $row[0];
		}
		else{
			throw new Exception("No Active AdoTransaction\n");
		}
	}
}
?>