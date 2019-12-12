<?php
namespace SharpMinds\Connection\Redis;

use \Predis\Client;

class Connection
{
  private static $instance = null;
  private $conn;
   
  private function __construct($parameters)
  {
	$this->conn = new Client($parameters);
  }
  
  public static function getInstance($parameters)
  {
    if(!self::$instance) {
      self::$instance = new self($parameters);
    }
   
    return self::$instance;
  }
  
  public function getConnection()
  {
	return $this->conn;
  }
}