<?php

/**
 * Designed for database connection
 */

class Database
{
    /**
     * Database instance
     * @var null
     */
    private static $instance = NULL;

    /**
     * Connect to database
     * @param  array $config main config
     * @return object         return database instance
     */
    public static function init($config)
    {
        if (!self::$instance) {
            $dsn = "mysql:host={$config['server']};dbname={$config['dbname']}";
            $opt = array(
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            );
            self::$instance = new PDO($dsn, $config['username'], $config['password'], $opt);
        }

        return self::$instance;
    }

    /**
     * Get database instance
     * @return object return database instance
     */
    public static function getInstance() {
        return self::$instance;
    }
}