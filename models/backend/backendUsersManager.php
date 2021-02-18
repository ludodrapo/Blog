<?php

require_once 'models/Manager.php';

class UsersManager extends Manager
{
    public function listAllUsers()
    {
        $blog_db = $this->dbConnect();
        return $blog_db->query('SELECT user_id, login_name, email, is_active, DATE_FORMAT(registration_date, "%d/%m/%Y") AS registration_date FROM users WHERE profile = "subscriber" ORDER BY is_active');
    }

    public function getUserData($user_id)
    {
        $blog_db = $this->dbConnect();
        $user_id = (int) $user_id;
        $user_data_query = $blog_db->prepare('SELECT login_name, email FROM users WHERE user_id = ?');
        $user_data_query->execute(array($user_id));
        return $user_data_query->fetch(PDO::FETCH_ASSOC);
    }

    public function deactivateUser($user_id)
    {
        $blog_db = $this->dbConnect();
        $user_id = (int) $user_id;
        $user_to_deactivate = $blog_db->prepare('UPDATE users SET is_active = 0 WHERE user_id = :user_id');
        return $user_to_deactivate->execute(array(
            'user_id' => $user_id
        ));
    }

    public function activateUSer($user_id)
    {
        $blog_db = $this->dbConnect();
        $user_id = (int) $user_id;
        $user_to_activate = $blog_db->prepare('UPDATE users SET is_active = 1 WHERE user_id = :user_id');
        return $user_to_activate->execute(array(
            'user_id' => $user_id
        ));
    }
}
