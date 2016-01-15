<?php

class UserModel
{
    protected static $table = 'users';

    public static function find($username)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT id, username, password FROM ' . static::$table . ' WHERE username = ?');
        $stmt->execute(array($username));

        return $stmt->fetch();
    }
}
