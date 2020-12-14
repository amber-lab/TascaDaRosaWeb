<?php

abstract class AdoRecord{
	protected $data;

	public function __construct($id = NULL){
		if($id){
			$object = $this->load($id);
			if($object){
				$this->fromArray($object->toArray());
			}
		}
	}

	public function __clone(){
		unset($this->id);
	}

	public function __set($prop, $value){
		if (method_exists($this, 'set_' . $prop)){
			call_user_func(array($this, 'set_' . $prop), $value);
		}
		else{
			$this->data[$prop] = $value;
		}
	}

	public function __get($prop){
		if (method_exists($this, 'get_' . $prop)){
			return call_user_func(array($this, 'get_' . $prop));
		}
		elseif(!is_null($this->data) and array_key_exists($prop, $this->data)){
			return $this->data[$prop];
		}
	}

	private function getEntity(){
		$classe = strtolower(get_class($this));
		return substr($classe, 0, -6);
	}

	public function fromArray($data){
		$this->data = $data;
	}

	public function toArray(){
		return $this->data;
	}

	public function store(){
		if(empty($this->id)){
			$this->id = $this->getLast() + 1;
			$sql = new AdoInsert;
			$sql->setEntity($this->getEntity());
			foreach ($this->data as $key => $value) {
				if(is_array($value)){
					$value = implode(",", $value);
				}
				$sql->setRowData($key, $value);
			}
		}
		else{
			$sql = new AdoUpdate;
			$sql->setEntity($this->getEntity());
			$criterion = new AdoCriterion;
			$criterion->add(new AdoFilter('id', '=', $this->id));
			$sql->setCriterion($criterion);
			foreach ($this->data as $key => $value) {
				if($key !== 'id'){
					$sql->setRowData($key, $value);
				}
			}
		}
		if($conn = AdoTransaction::get()){
			AdoTransaction::log($sql->getInstruction());
			$result = $conn->exec($sql->getInstruction());
			return $result;
		}
		else{
			throw new Exception("No Active AdoTransaction!\n");
		}
	}

	public function load($id){
		$sql = new AdoSelect;
		$sql->setEntity($this->getEntity());
		$sql->addColumn('*');

		$criterion = new AdoCriterion;
		$criterion->add(new AdoFilter('id', '=', $id));
		$sql->setCriterion($criterion);
		if($conn = AdoTransaction::get()){
			AdoTransaction::log($sql->getInstruction());
			$result = $conn->query($sql->getInstruction());
			if($result){
				//retorna objecto com atributos de dados instanciado por class filha de adoRecord
				$object = $result->fetchObject(get_class($this));
			}
			return $object;
		}
		else{
			throw new Exception("No Active AdoTransaction!\n");
		}
	}

	public function delete($id = Null){
		$id = $id ? $id : $this->id;
		$sql = new AdoDelete;
		$sql->setEntity($this->getEntity());

		$criterion = new AdoCriterion;
		$criterion->add(new AdoFilter('id', '=', $id));
		$sql->setCriterion($criterion);

		if($conn = AdoTransaction::get()){
			AdoTransaction::log($sql->getInstruction());
			$result = $conn->exec($sql->getInstruction());
			return $result;
		}
		else{
			throw new Exception("No Active AdoTransaction!\n");
		}
	}

	private function getLast(){
		if($conn = AdoTransaction::get()){
			$sql = new AdoSelect;
			$sql->addColumn('max(id)');
			$sql->setEntity($this->getEntity());
			AdoTransaction::log($sql->getInstruction());
			$result = $conn->query($sql->getInstruction());
			$row = $result->fetch();
			return $row[0];
		}
		else{
			throw new Exception("No Active AdoTransaction!\n");
		}
	}
}
?>