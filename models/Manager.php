<?php

abstract class Manager
{
    const ADMIN_EMAIL = "admin@ludodrapo.fr";

    protected function dbConnect()
    {
        return new PDO('mysql:host=localhost;dbname=blog;charset=utf8mb4', 'root', 'root');
    }
}
