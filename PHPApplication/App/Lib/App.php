<?php namespace App\Lib;

use App\Service\CourierService;
use App\Service\RegionService;
use App\Service\RouteService;

class App
{
    public static function run(): void
    {
        //Logger::enableSystemLogs();
        Router::get('/', function () {
            (new \App\Controller\RouteController())->index(
                new CourierService($GLOBALS['entityManager'])
            );
        });

        Router::get('/create_route', function () {
            (new \App\Controller\RouteController())->showCreationForm(
                new RegionService($GLOBALS['entityManager'])
            );
        });

        Router::post('/api/create_route', function (Request $req, Response $res) {
            $response = (new \App\Controller\RouteController())->createAction(
                new RouteService($GLOBALS['entityManager'],
                    new CourierService($GLOBALS['entityManager']),
                    new RegionService($GLOBALS['entityManager'])),
                $req->getJSON());

            $res->status($response['code']);
            $res->toJSON($response['message']);
        });

        Router::get("/api/route/list/(\d{4}-\d{2}-\d{2})", function (Request $req, Response $res) {
            $response = (new \App\Controller\RouteController())->listByDepartureDateAction(
                new RouteService($GLOBALS['entityManager'],
                    new CourierService($GLOBALS['entityManager']),
                    new RegionService($GLOBALS['entityManager'])),
                $req->params[0]);

            $res->status($response['code']);
            $res->toJSON($response['message']);
        });
    }

}