<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ .'/bin/bootstrap.php';

use App\Lib\App;
use App\Lib\Router;
use App\Lib\Request;
use App\Lib\Response;

$loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/App/Templates');
$twig = new \Twig\Environment($loader, [
    'debug' => true,
    'cache' => __DIR__.'/App/Templates/Cache',
]);
$GLOBALS['twig'] = $twig;

App::run();