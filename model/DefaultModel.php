<?php

abstract class DefaultModel
{
    // private static $instance = NULL;
    protected static $table;

    protected static $db = NULL;
    protected static $query;
    protected static $result;
    protected $lastInsertId;
    protected $count;

    //
    function __construct ($config)
    {
        self::init($config);
    }


    /**
     * Connect to database
     * @param  array $config main config
     * @return object         return database instance
     */
    public static function init($config)
    {
        if (!static::db) {
            $dsn = "mysql:host={$config['server']};dbname={$config['dbname']}";
            $opt = array(
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            );

            $this->db = new PDO($dsn, $config['username'], $config['password'], $opt);
        }

        return $this->db;
    }

    /**
     * Get database instance
     * @return object return database instance
     */
    public static function getInstance()
    {
        return $this->db;
    }

    public function query($sql, $params = array())
    {
        $this->_error = false;
        if ($this->query = $this->db->prepare($sql)) {
            //checking parameters
            //set counter to each value
            $p = 1;
            if (count($params)) {
                foreach ($params as $param) {
                    $this->query->bindValue($p, $param);
                $p++;
                }
            }
            // execute query
            if ($this->query->execute()) {
            //returning an object
                $this->results = $this->query->fetchAll(PDO::FETCH_OBJ);
                $this->count = $this->query->rowCount();
            }else {
                $this->_error = true;
            }
        }
        return $this;
    }

    public function action($action, $where = array()){
        if (count($where) === 3) {
            $operators = array('=','>','<','>=','<=', '!=');
            $field     = $where[0];
            $operator  = $where[1];
            $value     = $where[2];
            if (in_array($operator, $operators)) {
                $sql = $action." FROM {static::$table} WHERE {$field} {$operator} ?";
                if (!$this->query($sql, array($value))->error()) {
                    return $this;
                }
            }
        }
        return false;
    }

    public function insert($fields = array())
    {
        $keys   = array_keys($fields);
        $values = null;
        $p      = 1;
        foreach ($fields as $field) {
            $values .= '?';
            if ($p < count($fields)) {
                $values .= ', ';
            }
            $p++;
        }
        $sql = "INSERT INTO {static::$table} (`" . implode('`, `', $keys) ."`) VALUES ({$values})";
        if (!$this->query($sql, $fields)->error()) {
            $this->lastInsertId = $this->db->lastInsertId();
            return true;
        }
        return false;
    }

    public function update($id, $valeur, $fields){
        $set = '';
        $x = 1;
        foreach ($fields as $name => $value) {
            $set .= "{$name} = ?";
            if ($x < count($fields)) {
                $set .= ", ";
            }
            $x++;
        }
        $sql = "UPDATE {static::$table} set {$set} where {$id} = {$valeur}";
        if (!$this->query($sql, $fields)->error()) {
            return true;
        }
        return false;
    }

    public function get($where)
    {
        return $this->action("SELECT *", $where);
    }

    public function getAll()
    {
        $sql = 'SELECT * FROM ' . static::$table;
        return $this->query($sql);
    }

    public static function find($id)
    {
        return $this->get(array('id', '=', $id));
    }

    public function findBy($by, $value)
    {
        return $this->get(array($by, '=', $value));
    }

    public static function countAll()
    {
        return $this->countAll;
    }

    public static function getLastInsertId()
    {
        return $this->lastInsertId;
    }
}
