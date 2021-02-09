<?php

require_once('models/Manager.php');

class UsersManager extends Manager
{
	public function listAllUsers()
	{
		$db = $this->dbConnect();
		$listed_all_users = $db->query('SELECT user_id, login_name, email, is_active, DATE_FORMAT(registration_date, "%d/%m/%Y") AS registration_date FROM users WHERE profile = "subscriber" ORDER BY is_active');

		return $listed_all_users;
	}

	public function getUserData($user_id)
	{
		$db = $this->dbConnect();
		$user_id = (int)$user_id;
		$user_data_query = $db->prepare('SELECT login_name, email FROM users WHERE user_id = ?');
		$user_data_query->execute(array($user_id));
		$user_data = $user_data_query->fetch(PDO::FETCH_ASSOC);

		return $user_data;
	}

	public function deactivateUser($user_id)
	{
		$db = $this->dbConnect();
		$user_id = (int)$user_id;
		$user_to_deactivate = $db->prepare('UPDATE users SET is_active = 0 WHERE user_id = :user_id');
		$deactivated_user = $user_to_deactivate->execute(array(
			'user_id'=>$user_id
		));

		return $deactivated_user;
	}

	public function activateUSer($user_id)
	{
		$db = $this->dbConnect();
		$user_id = (int)$user_id;
		$user_to_activate = $db->prepare('UPDATE users SET is_active = 1 WHERE user_id = :user_id');
		$activated_user = $user_to_activate->execute(array(
			'user_id'=>$user_id
		));

		return $activated_user;
	}
}