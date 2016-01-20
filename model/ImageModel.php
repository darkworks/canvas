<?php

class ImageModel extends DefaultModel
{
    /**
     * Table name in the Database
     * @var string
     */
    protected static $table = 'images';

    /**
     * Get rande records
     * @param  integer $start start id
     * @param  integer $count count output
     * @return object         return model
     */
    public static function findPart($start = 0, $count = 10)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT id, name FROM ' . static::$table . ' ORDER BY ID DESC LIMIT ' . $start . ', '. $count);
        $stmt->execute(array($id));
        $result = $stmt->fetchAll();

        $models = [];
        foreach ($result as $item) {
            $model = new static();
            $model->populate($item);
            $models[] = $model;
        }

        return $models;
    }
}
