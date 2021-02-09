<?php

class Manager
{
	protected function dbConnect()
	{
		$db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8mb4', 'root', 'root');

		return $db;
	}
}
	