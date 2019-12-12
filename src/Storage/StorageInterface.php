<?php
namespace SharpMinds\Storage;

interface StorageInterface
{	
	public function get($key);

    public function set($key, $value);
	
	public function setConnection($connection);
	
	public function setDefaultValues($values);

	public function setTypeFactory($typeFactory);
}