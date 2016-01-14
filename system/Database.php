<?php

class Database
{
    private static $instance = NULL;

    public static function init($config)
    {
        if (!self::$instance) {
            $dsn = "mysql:host={$config['db']['server']};dbname={$config['db']['dbname']}";
            $opt = array(
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            );
            self::$instance = new PDO($dsn, $config['db']['username'], $config['db']['password'], $opt);
        }

        return self::$instance;
    }

    public static function getInstance() {
        return self::$instance;
    }
}