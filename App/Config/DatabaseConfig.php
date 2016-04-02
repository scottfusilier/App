<?php
namespace App\Config;

class DatabaseConfig
{
    private static $default = [
        'name' => 'default',
        'dsn' => [
            'mysql:host=172.16.1.17',
            'dbname=Example_DB',
            'charset=utf8',
        ],
        'login' => 'exampleUser',
        'password' => 'examplePasswd',
        'options' => [],
    ];

    private static $anotherconfig = [
        'name' => 'anotherconfig',
        'dsn' => [
            'mysql:host=localhost',
            'dbname=testdb',
            'charset=utf8',
        ],
        'login' => 'dbtestuser',
        'password' => 'testpassword',
        'options' => ['key' => 'value'],
    ];

    public static function getDatabaseConfig($configName)
    {
        return self::$$configName;
    }
}
