<?php
namespace SharpMinds\Type;

class Factory
{
	const TYPE = "\\SharpMinds\\Type\\";

	public function create($value, $type = null)
	{
		if(is_null($type)) {
			$type = $this->recognizeTypeName($value);
		}

		$typeObject = $this->getObject($type);
		$typeObject->setValue($value);
	
		return $typeObject;
	}
	
	private function getObject($typeName)
	{
		$typeName = ucfirst($typeName);
		$className = self::TYPE."${typeName}Type";

		if(!class_exists($className)) {
			printf('This type not support: %s', $typeName);

			die();
		}

		$typeObject = new $className;

		return $typeObject;	
	}
	
	private function recognizeTypeName($value)
	{
		
		if (is_object($value)) {
			return get_class($value);
		}
		
		$typeName = gettype($value);
		
		return $typeName;
	}
}