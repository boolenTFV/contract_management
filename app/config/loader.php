<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir,
        $config->application->customhelpersDir,
        $config->application->pluginsDir,
    ]
)->register();



$loader->registerFiles(
    [
        $config->application->vendorDir.'autoload.php',
    ]
)->register();

include $config->application->vendorDir.'autoload.php';


