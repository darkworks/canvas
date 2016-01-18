<?php

class System
{
    /**
     * Sail for password
     * @var string
     */
    private static $sail = NULL;

    /*
     * Initialization system
     * @param  array $config main config
     * @return void
     */
    public static function init($config)
    {
        self::$sail = $config['sail'];
    }

    /**
     * Encryption
     * @param  string $string
     * @return string           return of the encrypted data
     */
    public static function crypt($string)
    {
        return md5($string . self::$sail);
    }
}