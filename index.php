<?php

session_start();
require __DIR__.'/vendor/autoload.php';
require __DIR__.'/config/Config.php';

use App\Controller\MainRouter;
use App\Controller\HomeController;;

$application = new MainRouter;

$application->app();
