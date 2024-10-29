<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ .'/bin/bootstrap.php';
require_once __DIR__ .'/vendor/level-2/dice/Dice.php';

use App\Lib\App;
use App\Lib\Router;
use App\Lib\Request;
use App\Lib\Response;

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/src/Templates');
$twig = new \Twig\Environment($loader, [
    'debug' => true,
    'cache' => __DIR__ . '/src/Templates/Cache',
]);
$GLOBALS['twig'] = $twig;

App::run();