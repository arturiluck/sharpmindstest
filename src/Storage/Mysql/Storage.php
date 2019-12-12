<?php
namespace SharpMinds\Storage\Redis;

use SharpMinds\Storage\StorageInterface;

class Storage implements StorageInterface
{
    private $connection = null;
		
	public function get($key)
	{
		echo 'get';
	}

    public function set($key, $value)
	{
		echo $key, $value;
	}
	
	private function afterGet()
	{
		echo 'afterGet';
	}
	
	private function beforeSet()
	{
		echo 'beforeSet';
	}
	
	public function setConnection($connection){
		$this->connection = $connection;
	}
}