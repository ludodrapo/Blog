<?php

require_once('models/Manager.php');

class UsersManager extends Manager
{
	public function getUserPassword($info)
	{
		$db = $this->dbConnect();
		if (is_int($info))
		{
			$password_query = $db->prepare('SELECT password FROM users WHERE user_id = ?');
		}
		elseif (is_string($info))
		{
			$password_query = $db->prepare('SELECT password FROM users WHERE login_name = ?');
		}
		$password_query->execute(array($info));
		$password_data = $password_query->fetch(PDO::FETCH_ASSOC);

		return $password_data;
	}

	public function getUserIsActive($info)
	{
		$db = $this->dbConnect();
		if (is_int($info))
		{
			$active_query = $db->prepare('SELECT is_active FROM users WHERE user_id = ?');
		}
		elseif (is_string($info))
		{
			$active_query = $db->prepare('SELECT is_active FROM users WHERE login_name = ?');
		}
		$active_query->execute(array($info));
		$active_data = $active_query->fetch(PDO::FETCH_ASSOC);

		return $active_data;
	}

	public function getUserData($info)
	{
		$db = $this->dbConnect();
		if (is_int($info))
		{
			$user_data_query = $db->prepare('SELECT login_name, email, profile, DATE_FORMAT(registration_date, "%d/%m/%Y") AS registration_date FROM users WHERE user_id = ?');
		}
		elseif (is_string($info))
		{
			$user_data_query = $db->prepare('SELECT user_id, email, profile, DATE_FORMAT(registration_date, "%d/%m/%Y") AS registration_date FROM users WHERE login_name = ?');
		}
		$user_data_query->execute(array($info));
		$user_data = $user_data_query->fetch(PDO::FETCH_ASSOC);

		return $user_data;
	}

	public function recordNewUser($new_login_name, $new_password, $new_email)
	{
		$db = $this->dbConnect();
		$req_record_new_user = $db->prepare('INSERT INTO users(login_name, password, email) VALUES (:login_name, :password, :email)');
		$added_user = $req_record_new_user->execute(array(
			'login_name'=>$new_login_name,
			'password'=>$new_password,
			'email'=>$new_email
		));

		return $added_user;
	}

	public function updateEmail($user_id, $new_email)
	{
		$db = $this->dbConnect();
		$req_update_email = $db->prepare('UPDATE users SET email = :new_email WHERE user_id = :user_id');
		$updated_email = $req_update_email->execute(array(
			'new_email'=>$new_email,
			'user_id'=>$user_id
		));

		return $updated_email;
	}

	public function updatePassword($user_id, $new_password)
	{
		$db = $this->dbConnect();
		$req_update_password = $db->prepare('UPDATE users SET password = :new_password WHERE user_id = :user_id');
		$updated_password = $req_update_password->execute(array(
			'new_password'=>$new_password,
			'user_id'=>$user_id
		));

		return $updated_password;
	}

}



