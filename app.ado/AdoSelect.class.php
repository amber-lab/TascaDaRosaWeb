<?php

final class AdoSelect extends AdoInstruction{
	private $columns;
	public function addColumn($column){
		$this->columns[] = $column;
	}
	public function getInstruction(){
		$this->sql = 'SELECT ';
		$this->sql .= implode(', ', $this->columns);
		$this->sql .= ' FROM ' . $this->entity;

		if (property_exists($this, 'criterion')){
			if($this->criterion->dump()){
				$this->sql .= ' WHERE ' . $this->criterion->dump();
			}
			if($order = $this->criterion->getProperty('order')){
				$this->sql .= ' ORDER BY ' . $order;
			}
			if($limit = $this->criterion->getProperty('limit')){
				$this->sql .= ' LIMIT ' . $limit;
			}
			if($offset = $this->criterion->getProperty('offset')){
				$this->sql .= ' OFFSET ' . $offset;
			}
		}
		return $this->sql;
	}
}
?>