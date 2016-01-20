<?php
/**
 * Designed for internal operations
 */
class System
{
    /**
     * Sail for password
     * @var string
     */
    private static $sail = NULL;

    /**
     * Which denotes the algorithmic cost that should be used
     * @var integer
     */
    private static $cost = 11;

    /*
     * Initialization system
     * @param  array $config main config
     * @return void
     */
    public static function init($config)
    {
        if (empty($config)) {
            throw new Exception('Config data not found');
        }

        self::$sail = $config['sail'];
    }

    /**
     * Encryption
     * @param  string $string
     * @return string           return of the encrypted data
     */
    public static function crypt($string)
    {
        if (!self::$sail) {
            throw new Exception('Sail not found');
        }

        $options = [
            'cost' => self::$cost,
            'salt' => self::$sail
        ];

        return password_hash($string, PASSWORD_BCRYPT, $options);
    }
}