<?php namespace App\Lib;

use App\Controller\RouteController;
use App\Service\CourierService;
use App\Service\RegionService;
use App\Service\RouteService;
use Dice\Dice;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class App
{
    private static function setupDIC(): Dice
    {
        $dice = new Dice;

        $config = ORMSetup::createAttributeMetadataConfiguration(
            paths: [__DIR__ . '/../src/Entity'],
            isDevMode: true,
        );

        $connection = DriverManager::getConnection([
            'driver'   => 'pdo_mysql',
            'user'     => 'root',
            'password' => 'root',
            'host' => 'db',
            'dbname'   => 'intas_company',
        ], $config);

        $rules = [
            '*' => [
               'substitutions' => [
                   'Doctrine\ORM\EntityManagerInterface' =>  new EntityManager($connection, $config)
               ]
           ]
        ];

        return $dice->addRules($rules);
    }

    public static function run(): void
    {
        $dice = App::setupDIC();

        Router::get('/', function () use ($dice) {
            (new RouteController())->index(
                $dice->create('App\Service\CourierService')
            );
        });

        Router::get('/create_route', function () use ($dice) {
            (new RouteController())->showCreationForm(
                $dice->create('App\Service\RegionService')
            );
        });

        Router::post('/api/create_route', function (Request $req, Response $res) use ($dice) {
            $response = (new RouteController())->createAction(
                $dice->create('App\Service\RouteService'),
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