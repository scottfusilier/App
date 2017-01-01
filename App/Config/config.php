<?php
/*
 * config.php -- define constants and system params here
 */

// database configuration namespace
define('DBCONFIG_NAMESPACE', '\\App\\Config\\DatabaseConfig');

// set default timezone
date_default_timezone_set('America/New_York');

// initialize database session handler
//$handler = App\Model\Auth\Session::get();
//session_set_save_handler($handler, true);
