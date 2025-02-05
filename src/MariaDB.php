<?php

namespace RPurinton\Discommand;

Class MariaDB
{
	private $sql;

	public function __construct()
	{
		extract(Config::get('mariadb'));
		$this->sql = mysqli_connect($host, $user, $password, $db, $port);
		if(!$this->sql) throw \Exception("MariaDB Connect Error");
	}

	public function query($query)
	{
		return $this->sql->query($query)->fetch_all(MYSQLI_ASSOC);
	}
}
