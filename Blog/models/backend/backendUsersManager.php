<?php

require_once('models/Manager.php');

class UsersManager extends Manager
{
	public function listAllUsers()
	{
		$db = $this->dbConnect();
		$listed_all_users = $db->query('SELECT login_name, email, is_active, DATE_FORMAT(registration_date, "%d/%m/%Y") AS registration_date FROM users WHERE profile = "subscriber" ORDER BY login_name');

		return $listed_all_users;
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
}