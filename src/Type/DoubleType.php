<?php
namespace SharpMinds\Type;

class DoubleType implements TypeInterface
{
	const TYPE_NAME = 'double';
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
		return (double) $this->value;
	}
	
	public function setValue($value)
	{
		$this->value = $value;
	}
}