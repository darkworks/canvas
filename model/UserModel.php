<?php

class UserModel
{
    /**
     * Table name in the Database
     * @var string
     */
    protected static $table = 'users';

    /**
     * Find user profile
     * @param  string $username username
     * @return array           [description]
     */
    public static function find($username)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT id, username, hash FROM ' . static::$table . ' WHERE username = ?');
        $stmt->execute(array($username));

        return $stmt->fetch();
    }
}
