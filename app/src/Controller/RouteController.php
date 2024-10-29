<?php

namespace App\Controller;

use App\Service\CourierService;
use App\Service\RegionService;
use App\Service\RouteService;

class RouteController
{
    public function index(CourierService $courierService)
    {
        echo $GLOBALS['twig']->render('list.html.twig', ['couriers' => $courierService->listAll()]);
    }

    public function showCreationForm(RegionService $regionService)
    {
        echo $GLOBALS['twig']->render('create_route.html.twig', ['regions' => $regionService->listAll()]);
    }

    public function createAction(RouteService $routeService, $data)
    {
        try {
            $routeService->add($data);
        }
        catch (\Exception $e) {
           return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }

        return ['message' => 'ok', 'code' => 200];
    }

    public function listByDepartureDateAction(RouteService $routeService, $date)
    {
        try {
            $date = new \DateTime($date);
            $routes = $routeService->listWithCouriersByDepartureDate($date);
        }
        catch (\Exception $e) {
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }
        return [ 'message' => $routes, 'code' => 200];
    }
}