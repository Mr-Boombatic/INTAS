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
     * @return array
     */
    public function listAll(): array
    {
        return $this->entityManager->getRepository(Region::class)->findAll();
    }

    public function getRegionByName ($region)
    {
        return $this->entityManager->getRepository(Region::class)->findOneBy(['regionName' => $region]);
    }
}