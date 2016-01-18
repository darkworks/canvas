<?php

class DefaultModel
{
    /**
     * Table name in the Database
     * @var string
     */
    protected static $table;
    /**
     * Last insert ID
     * @var integer
     */
    public static $lastInsertId;

    /**
     * Adding data in Database
     * @param array $data array params
     * @return boolean status execution
     */
    public static function add($data)
    {
        $db = Database::getInstance();

        $fields = array();
        $values = array();

        foreach ($data as $key => $val) {
            $values[] = ':' . $key;
            $fields[] = '`' . $key . '`';
        }

        $stmt = $db->prepare("INSERT INTO `". static::$table . "` (" . implode(', ', $fields) . ") VALUES (" . implode(', ', $values) . ")");
        $status = $stmt->execute($data);

        static::$lastInsertId = $db->lastInsertId();

        return $status;
    }
}
