<?php

namespace App\Service;

use App\Entity\Region;
use Doctrine\ORM\EntityManagerInterface;

class RegionService extends BaseService
{
    private EntityManagerInterface $entityManager;


    public function __construct (
        EntityManagerInterface $entityManager,
    )
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Получение всех регинов в бд
     * @return array
     */
    public function listAll(): array
    {
        return $this->entityManager->getRepository(Region::class)->findAll();
    }

    /**
     * Получение региона из базы по его названию. Если региона нету,то будет возвращен null.
     * @param $region
     * @return Region|null
     */
    public function getRegionByName($region): ?Region
    {
        return $this->entityManager->getRepository(Region::class)->findOneBy(['regionName' => $region]);
    }
}