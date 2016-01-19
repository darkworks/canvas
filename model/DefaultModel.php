<?php

abstract class DefaultModel
{
    /**
     * Table name in the Database
     * @var string
     */
    protected static $table;
    // *
    //  * Last insert ID
    //  * @var integer
    //
    protected static $db;

    // public static $lastInsertId;
    //
    function __construct ()
    {
        static::$db = Database::getInstance();
    }

    public static function findAll()
    {

    }

    public static function find()
    {

    }

    public static function countAll()
    {

    }

    public static function add($data)
    {
        $db = Database::getInstance();

        $fields = array();
        $values = array();

        foreach ($data as $key => $val) {
            $values[] = ':' . $key;
            $fields[] = $key;
        }

        $stmt = $db->prepare("INSERT INTO `". static::$table . "` (`" . implode('`, `', $fields) . "`) VALUES (" . implode(', ', $values) . ")");
        $status = $stmt->execute($data);

        static::$lastInsertId = $db->lastInsertId();

        return $status;
    }
}
