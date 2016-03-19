<?php
namespace App\Config;

class DatabaseConfig
{
    private static $default = [
        'name' => 'default',
        'persistent' => false,
        'host' => 'xxx.xxx.xxx.xxx',
        'login' => '',
        'password' => '',
        'database' => '',
        'encoding' => 'utf8',
    ];

    private static $someconfig = [
        'name' => 'someconfig',
        'persistent' => false,
        'host' => 'localhost',
        'login' => '',
        'password' => '',
        'database' => '',
        'encoding' => 'utf8',
    ];

    public static function getDatabaseConfig($configName)
    {
        return self::$$configName;
    }
}
