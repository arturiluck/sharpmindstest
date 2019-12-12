<?php
namespace SharpMinds\Type;

class DateTimeType implements TypeInterface
{
	const TYPE_NAME = 'DateTime';
	private $value = null;
	
	public function prepareToSave()
	{
		$data = [
			"type" => self::TYPE_NAME,
			"value" => $this->value->format('Y-m-d H:i:s'),
		];
		
		return $data;
	}

    public function convertToType()
	{

		return  new \DateTime('2011-01-01 15:03:01');
		die('dsad');
	}
	
	public function setValue($value)
	{
		$this->value = $value;
	}
}