<?php
namespace SharpMinds\Type;

class IntegerType implements TypeInterface
{
	const TYPE_NAME = 'integer';
	private $value = null;
	
	public function prepareToSave()
	{
		$data = [
			"type" => self::TYPE_NAME,
			"value" => $this->value,
		];
		
		return $data;
	}

    public function convertToType()
	{
		return (integer) $this->value;
	}
	
	public function setValue($value)
	{
		$this->value = $value;
	}
}