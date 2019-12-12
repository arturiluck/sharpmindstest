<?php
namespace SharpMinds\Storage;

use \Symfony\Component\Yaml\{Yaml,Exception\ParseException};
use \SharpMinds\Type\Factory as TypeFactory;

class Factory
{
	const STORAGE = "\\SharpMinds\\Storage\\";
	const CONNECTION = "\\SharpMinds\\Connection\\";
	const CONFIG_PATH = "/../../config.yaml";
	
	private $customConfigPath = null;
	private $connectionParameters = null;
	
	
	public function create()
	{
		$config = $this->getConfig();

		$driverName = $config['driver'];
		$storage = $this->getStorage($driverName);

		$connection = $this->getConnection($driverName);	
		$storage->setConnection($connection);
		
		$defaultValues = $config['default_values'];
		$storage->setDefaultValues($defaultValues);

		$typeFactory = new TypeFactory();
		$storage->setTypeFactory($typeFactory);

		return $storage;
	}
	
	public function setCustomConfig($path)
	{
		$this->customConfigPath = $path;
	}
	
	public function setConnectionParameters($parameters)
	{
		$this->connectionParameters = $parameters;
	}

	private function getConfig()
	{
		try {
			$path = __DIR__.self::CONFIG_PATH;

			if (!empty($this->customConfigPath)) {
				$path = $this->customConfigPath;
			}

			$parametrs = Yaml::parseFile($path);
		} catch (ParseException $exception) {
			printf('Unable to parse the YAML string: %s', $exception->getMessage());

			die();
		}
		
		return $parametrs;
	}
	
	private function getStorage($driverName)
	{
		$driverName = ucfirst($driverName);
		$className = self::STORAGE."${driverName}\\Storage";
		$storage = new $className;
		
		return $storage;
	}
	
	private function getConnection($driverName)
	{
		$driverName = ucfirst($driverName);
		$className = self::CONNECTION."${driverName}\\Connection";
		$connection = $className::getInstance($this->connectionParameters);

		return $connection->getConnection();
	}
}