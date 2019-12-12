<?php
namespace SharpMinds\Type;

class StringType implements TypeInterface
{
	const TYPE_NAME = 'string';
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
		return (string) $this->value;
	}
	
	public function setValue($value)
	{
		$this->value = $value;
	}
}