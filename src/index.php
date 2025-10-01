<?php
use App\Core\Psr4Autoloader;
use App\EnvTest\EnvTest;

require_once __DIR__ . '/Core/Psr4Autoloader.php';

Psr4Autoloader::initAutoLoader('App', __DIR__);

// run test
(new EnvTest())->run();






