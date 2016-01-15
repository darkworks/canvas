<?php

class DefaultModel
{
    protected static $table;
    public static $lastInsertId;

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
