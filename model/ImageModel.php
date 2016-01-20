<?php

class ImageModel extends DefaultModel
{
    /**
     * Table name in the Database
     * @var string
     */
    protected static $table = 'images';

    public static function findPart($start = 0, $count = 10)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT id, name FROM ' . static::$table . ' ORDER BY ID DESC LIMIT ' . $start . ', '. $count);
        $stmt->execute(array($id));
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        $name = get_called_class();
        $class = new $name();

        if(!empty($result)) {
            foreach ($result as $key => $value) {
                $class->$key = $value;
            }
        }

        return $class;
    }
}
