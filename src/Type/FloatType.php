<?php
namespace SharpMinds\Type;

class FloatType implements TypeInterface
{
	const TYPE_NAME = 'float';
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
		return (float) $this->value;
	}
	
	public function setValue($value)
	{
		$this->value = $value;
	}
}