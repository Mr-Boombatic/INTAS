<?php

namespace App\Service;

use App\Entity\Route;
use Doctrine\DBAL\ParameterType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Exception as DBALException;

class RouteService extends BaseService
{
    private EntityManagerInterface $entityManager;
    private CourierService $courierService;
    private RegionService $regionService;

    public function __construct(
        EntityManagerInterface $entityManager,
        CourierService $courierService,
        RegionService $regionService
    ) {
        $this->entityManager = $entityManager;
        $this->courierService = $courierService;
        $this->regionService = $regionService;
    }

    /**
     * Добавление в бд нового маршрута. Выбрасывается исключение в случаи ошибки
     * при создании нового маршрута.
     * @param array $data json encoded date
     * @return void
     * @throws \DateMalformedStringException
     */
    public function add(array $data): void
    {
        $this->hasFields($data, ['region', 'departure', 'name']);

        $courier = $this->courierService->isCourier($data['name'])
            ? $this->courierService->getByName($data['name'])
            : $this->courierService->add($data['name']);

        $route = new Route();
        $route->setDeparture(new \DateTime($data['departure']));
        $route->setRegion($this->regionService->getRegionByName($data['region']));

        $crossedRoutes = $this->getCrossingRoutes($route, $courier->getRoutes());
        if (!empty($crossedRoutes)) {
            $crossedRouteIds = array_map(fn(Route $route) => $route->getId(), $crossedRoutes);
            throw new \RuntimeException('Crossed routes: ' . implode(',', $crossedRouteIds), 400);
        }

        $courier->addRoute($route);

        try {
            $this->entityManager->persist($route);
            $this->entityManager->persist($courier);
            $this->entityManager->flush();
        } catch (DBALException $e) {
            throw new \RuntimeException('Database error: ' . $e->getMessage(), 400);
        }
    }

    private function getCrossingRoutes(Route $route, Collection $existingRoutes): array
    {
        $crossingRoutes = [];
        $arrivalDateOfComparingRoute = (clone $route->getDeparture())->modify('+' . $route->getRegion()->getDuration() . ' days');

        foreach ($existingRoutes as $existingRoute) {
            $arrivalDateOfExistingRoute = (clone $existingRoute->getDeparture())->modify('+' . $existingRoute->getRegion()->getDuration() . ' days');

            if (($arrivalDateOfComparingRoute <= $arrivalDateOfExistingRoute && $arrivalDateOfComparingRoute >= $existingRoute->getDeparture()) ||
                ($route->getDeparture() >= $existingRoute->getDeparture() && $route->getDeparture() <= $arrivalDateOfExistingRoute)
            ) {
                $crossingRoutes[] = $existingRoute;
            }
        }

        return $crossingRoutes;
    }

    /**
     * Получение всех маршрутов и курьеров на них по дате отбытия.
     * @param \DateTime $date
     * @return array
     * @throws DBALException
     */
    public function listWithCouriersByDepartureDate(\DateTime $date): array
    {
        $conn = $this->entityManager->getConnection();

        $sql = "SELECT  
                    r.id AS route_id,  
                    cr.courier_id,  
                    c.name,  
                    rg.duration,  
                    r.departure,  
                    rg.regionName AS region_name  
                FROM  
                    routes r  
                JOIN  
                    courier_route cr ON r.id = cr.route_id  
                JOIN  
                    couriers c ON cr.courier_id = c.id  
                JOIN  
                    regions rg ON r.region_id = rg.id  
                WHERE  
                    r.departure = :departure_date";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue('departure_date', $date->format('Y-m-d'), ParameterType::STRING);
        $result = $stmt->executeQuery();

        return $result->fetchAllAssociative();
    }
}