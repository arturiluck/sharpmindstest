<?php
namespace SharpMinds\Storage\Redis;

use \SharpMinds\Storage\StorageInterface;

class Storage implements StorageInterface
{
    private $connection = null;
	private $defaults = [];
	private $typeFactory;
		
	public function get($key)
	{	
		if ($this->connection->exists($key)) {
			$value = $this->connection->get($key);
			
			return $this->afterFind($value);
		}
		
		if (!isset($this->defaults[$key])) {

			return null;
		}
		
		$data = $this->defaults[$key];

		if (!is_array($data)) {
			$data = [
				"type" => "string",
				"value" => $data,
			];
		} 

		$typeEntity = $this->typeFactory->create($data['value'], $data['type']);

		return $typeEntity->convertToType();
	}

    public function set($key, $value)
	{
		$value = $this->beforeSet($value);
		$this->connection->set($key, $value);

		return true;
	}
	
	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function setDefaultValues($values)
	{
		$this->defaults = $values;
		
	}
	
	public function setTypeFactory($typeFactory)
	{
		$this->typeFactory = $typeFactory;
	}
	
	private function afterFind($value)
	{
		$data = json_decode($value);
		$typeEntity = $this->typeFactory->create($data->value, $data->type);
		
		return $typeEntity->convertToType();
	}
	
	private function beforeSet($value)
	{
		$typeEntity = $this->typeFactory->create($value);
		$data = $typeEntity->prepareToSave();
		
		return json_encode($data);
	}
}