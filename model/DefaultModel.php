<?php

abstract class DefaultModel
{
    protected static $table;
    protected static $lastInsertId;
    public $attributes = [];
    // protected $id;
    protected $isNew;

    function __get($name)
    {
        if (isset($this->attributes[$name])) {
            return $this->attributes[$name];
        } else {
            return null;
        }
    }

    function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    public function getAttr()
    {
        return $this->attributes;
    }

    public function isNew($param)
    {
        $this->isNew = $param;
    }

    public function save()
    {
        $db = Database::getInstance();

        if (!isset($this->isNew)) {
            $data = [];

            foreach ($this->attributes as $key => $val) {
                $values[] = ':' . $key;
                $fields[] = $key;
                $data[$key] = $val;
            }

            $stmt = $db->prepare('INSERT INTO `'. static::$table . '` (`' . implode('`, `', $fields) . '`) VALUES (' . implode(', ', $values) . ')');
            $status = $stmt->execute($data);

            static::$lastInsertId = $db->lastInsertId();

        } else {
            $values = [];
            $data = [];

            foreach ($this->attributes as $key => $val) {
                $values[] = '`' . $key . '` = :' . $key;
                $data[$key] = $val;
            }

            $stmt = $db->prepare('UPDATE ' . static::$table .' SET ' . implode(', ', $values) . ' WHERE `id` = ' . $this->attributes['id']);
            $status = $stmt->execute($data);
        }

        return $status;
    }

    public static function find($id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT * FROM `' . static::$table . '` WHERE id = ?');
        $stmt->execute(array($id));
        $result = $stmt->fetchObject();

        $name = get_called_class();
        $class = new $name();

        if(!empty($result)) {
            foreach ($result as $key => $value) {
                $class->$key = $value;
            }

            $class->isNew(true);
        }

        return $class;
    }

    public static function countAll()
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT COUNT(*) FROM ' . static::$table);
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public static function getLastInsertId()
    {
        return static::$lastInsertId;
    }
}
