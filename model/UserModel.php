<?php

class UserModel extends DefaultModel
{
    /**
     * Table name in the Database
     * @var string
     */
    protected static $table = 'users';

    /**
     * Find record use username
     * @param  [type] $username [description]
     * @return [type]           [description]
     */
    public static function findByName($username)
    {
        $db = Database::getInstance();

        $stmt = $db->prepare('SELECT id, username, hash FROM ' . static::$table . ' WHERE username = ?');
        $stmt->execute(array($username));

        return $stmt->fetchObject();
    }

}
