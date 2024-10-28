<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'routes')]
class Route
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Region::class, inversedBy: 'routes')]
    #[ORM\JoinColumn(name: 'region_id', referencedColumnName: 'id')]
    private Region $region; // Изменено на объект Region

    #[ORM\Column(type: 'date', nullable: false)]
    private \DateTime $departure;

    #[ORM\ManyToMany(targetEntity: Courier::class, mappedBy: 'routes')]
    private Collection $couriers;

    public function getId(): int
    {
        return $this->id;
    }

    public function getRegion(): Region
    {
        return $this->region;
    }

    public function setRegion(Region $region): self
    {
        $this->region = $region;
        return $this;
    }

    public function getDeparture(): \DateTime
    {
        return $this->departure;
    }

    public function setDeparture(\DateTime $departure): self
    {
        $this->departure = $departure;
        return $this;
    }

    public function getCouriers(): Collection
    {
        return $this->couriers;
    }

    public function addCourier(Courier $courier): self
    {
        if (!$this->couriers->contains($courier)) {
            $this->couriers[] = $courier;
            $courier->addRoute($this);
        }
        return $this;
    }

    public function removeCourier(Courier $courier): self
    {
        if ($this->couriers->contains($courier)) {
            $this->couriers->removeElement($courier);
            $courier->removeRoute($this);
        }
        return $this;
    }
}