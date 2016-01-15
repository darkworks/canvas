<?php

class ImageModel extends DefaultModel
{
    protected static $table = 'images';

    public static function findAll($count = null)
    {
        $result = [];
        $limit = (!$count) ? '' : ' LIMIT '.$count;

        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT id, name FROM ' . static::$table . $limit . ' ORDER BY ID DESC');
        $stmt->execute();

        foreach ($stmt as $row)
        {
            $result[] = $row;
        }

        return $result;
    }

    public static function checkAccess($imageId)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT password FROM ' . static::$table . ' WHERE id = ?');
        $stmt->execute(array($imageId));

        return $stmt->fetch();
    }
}
