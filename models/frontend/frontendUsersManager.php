<?php

require_once 'models/Manager.php';

final class UsersManager extends Manager
{
    public function getUserData($info)
    {
        $blog_db = $this->dbConnect();
        if (is_int($info)) {
            $user_data_query = $blog_db->prepare('SELECT login_name, password, email, profile, is_active, DATE_FORMAT(registration_date, "%d/%m/%Y") AS registration_date FROM users WHERE user_id = ?');
        } elseif (is_string($info)) {
            $user_data_query = $blog_db->prepare('SELECT user_id, password, email, profile, is_active, DATE_FORMAT(registration_date, "%d/%m/%Y") AS registration_date FROM users WHERE login_name = ?');
        }
        $user_data_query->execute(array($info));
        return $user_data_query->fetch(PDO::FETCH_ASSOC);
    }

    public function recordNewUser($new_login_name, $new_password, $new_email)
    {
        $blog_db = $this->dbConnect();
        $req_record_new_user = $blog_db->prepare('INSERT INTO users(login_name, password, email) VALUES (:login_name, :password, :email)');
        return $req_record_new_user->execute(
            array(
            'login_name' => $new_login_name,
            'password' => $new_password,
            'email' => $new_email
            )
        );
    }

    public function updateEmail($user_id, $new_email)
    {
        $blog_db = $this->dbConnect();
        $req_update_email = $blog_db->prepare('UPDATE users SET email = :new_email WHERE user_id = :user_id');
        return $req_update_email->execute(
            array(
            'new_email' => $new_email,
            'user_id' => $user_id
            )
        );
    }

    public function updatePassword($user_id, $new_password)
    {
        $blog_db = $this->dbConnect();
        $req_update_password = $blog_db->prepare('UPDATE users SET password = :new_password WHERE user_id = :user_id');
        return $req_update_password->execute(
            array(
            'new_password' => $new_password,
            'user_id' => $user_id
            )
        );
    }
}
