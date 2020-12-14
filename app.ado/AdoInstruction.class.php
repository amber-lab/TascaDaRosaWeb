<?php

abstract class adoInstruction{
	protected $sql;
	protected $criteria;

	final public function setEntity($entity){
		$this->entity = $entity;
	}

	final public function getEntity($entity){
		return $this->entity;
	}

	public function setCriterion(adoCriterion $criterion){
		$this->criterion = $criterion;
	}

	abstract function getInstruction();
}
?>