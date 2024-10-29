<?php

namespace App\Service;

use App\Entity\Courier;
use Doctrine\ORM\EntityManagerInterface;

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
     * Получение всего списка курьеров в бд
     * @return array
     */
    public function listAll(): array
    {
        return $this->entityManager->getRepository(Courier::class)->findAll();
    }

    /**
     * Добавление новго курьера в базу без каких-либо проверок
     * @param $name
     * @return Courier|null
     */
    public function add($name): ?Courier
    {
        $newCourier = new Courier();
        $newCourier->setName($name);

        $this->entityManager->persist($newCourier);
        $this->entityManager->flush();

        return $newCourier;
    }

    /**
     * Получение курьера по имени
     * @param $fullname
     * @return Courier|null
     */
    public function getByName($fullname): ?Courier
    {
        return $this->entityManager->getRepository(Courier::class)->findOneBy(['name' => $fullname]);
    }

    /**
     * Проверка, что курьер с указанным именем уже существует в базе
     * @param $fullname
     * @return bool
     */
    public function isCourier($fullname): bool
    {
        return $this->entityManager->getRepository(Courier::class)->findOneBy(['name' => $fullname]) != null;
    }
}