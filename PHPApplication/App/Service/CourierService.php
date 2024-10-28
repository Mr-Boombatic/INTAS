<?php

namespace App\Service;

use App\Entity\Courier;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Psr\Log\LoggerInterface;

class CourierService extends BaseService
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
        return $this->entityManager->getRepository(Courier::class)->findAll();
    }

    /**
     * Добавление нового курьера в DB
     * @param $data
     * @return void
     * @throws \Exception
     */
    public function add($name): ?Courier
    {
        try {
            $newCourier = new Courier();
            $newCourier->setName($name);

            $this->entityManager->persist($newCourier);
            $this->entityManager->flush();

            return $newCourier;
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return null;
        }
    }

    /**
     * @param $fullname
     * @return Courier|null
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function getByName($fullname): ?Courier
    {
        try {
            return $this->entityManager->getRepository(Courier::class)->findOneBy(['name' => $fullname]);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return null;
        }
    }

    public function isCourier ($fullname)
    {
        if ($this->entityManager->getRepository(Courier::class)->findOneBy(['name' => $fullname]))
        {
            return true;
        }
    }
}