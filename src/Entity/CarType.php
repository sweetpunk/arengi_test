<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'car_type')]
class CarType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\OneToMany(targetEntity: Car::class, mappedBy: 'type')]
    private Collection $cars;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): CarType
    {
        $this->name = $name;

        return $this;
    }

    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function setCars(Collection $cars): CarType
    {
        $this->cars = $cars;

        return $this;
    }
}
