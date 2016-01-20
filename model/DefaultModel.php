<?php
/**
 * Abstract class DefaultModel
 */
abstract class DefaultModel
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
    protected static $lastInsertId;

    /**
     * Attributes class
     * @var array
     */
    private $attributes = [];

    /**
     * Show type query Inse
     * @var [type]
     */
    private $isNew = true;

    /**
     * Magic method __get
     * @param  string $name
     * @return array
     */
    function __get($name)
    {
        return $this->attributes[$name];
    }

    /**
     * Magic method __set
     * @param string $name
     * @param mixed $value
     */
    function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    /**
     * Save data in Database
     * @return boolean return status
     */
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

    /**
     * Find record in Database use ID
     * @param  [integer] $id id record
     * @return object     return model
     */
    public static function find($id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT * FROM `' . static::$table . '` WHERE id = ?');
        $stmt->execute(array($id));
        $result = $stmt->fetchObject();

        $model = new self();
        $model->populate($result);

        return $model;
    }

    /**
     * Return count records in table
     * @return array
     */
    public static function countAll()
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT COUNT(*) FROM ' . static::$table);
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    /**
     * Get last insert id
     * @return [type] [description]
     */
    public static function getLastInsertId()
    {
        return static::$lastInsertId;
    }

    /**
     * Set attributes in model
     * @param  array  $data
     * @return void
     */
    protected function populate(array $data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }

        $this->isNew = false;
    }
}
