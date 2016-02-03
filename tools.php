<?php
namespace Tools;
/**
* 
*/
class dataBase
{
	private $user = 'root';
	private $host = 'localhost';
	private $pass = '1111';	

	public function getUser() {
		return $this->user;
	}

	public function getHost() {
		return $this->host;
	}

	public function getPass() {
		return $this->pass;
	}
}
?>