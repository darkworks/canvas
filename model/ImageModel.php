<?php

class ImageModel extends DefaultModel
{
    /**
     * Table name in the Database
     * @var string
     */
    protected static $table = 'images';

    /**
     * Get array images
     * @param  integer $start start position (default 0)
     * @param  integer $count count records (default 10)
     * @return array          array images
     */
    public static function findAll($start = 0, $count = 10)
    {
        $result = [];

        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT id, name FROM ' . static::$table . ' ORDER BY ID DESC LIMIT ' . $start . ', '. $count);
        $stmt->execute();

        foreach ($stmt as $row) {
            $result[] = $row;
        }

        return $result;
    }

    /**
     * Check access for canvas edit
     * @param  integer $imageId image id
     * @return array
     */
    public static function checkAccess($imageId)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT name, hash FROM ' . static::$table . ' WHERE id = ?');
        $stmt->execute(array($imageId));

        return $stmt->fetch();
    }

    /**
     * Get number of records
     * @return void
     */
    public static function countImages()
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT Count(*) FROM ' . static::$table);
        $stmt->execute();

        return $stmt->fetchColumn();
    }
}
