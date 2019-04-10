<?php
use Phalcon\Di;
use Phalcon\Di\FactoryDefault;

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');
define('IS_ECHO_ON', false);

$di = new FactoryDefault();

Di::reset();
include APP_PATH . '/config/router.php';
include APP_PATH . '/config/services.php';
Di::setDefault($di);

$config = $di->getConfig();

include APP_PATH . '/config/loader.php';

