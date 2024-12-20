<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CarRepository::class)]
#[ORM\Table(name: 'car')]
class Car
{
    public const MAX_BY_PAGE = 10;

    public const PTRA_FILTER_RANGE = 999;
    public const PTRA_FILTER_LIMIT = 3000;

    public const SEAT_FILTER_RANGE = 2;
    public const SEAT_FILTER_LIMIT = 6;


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(name: 'brand', type: 'string', length: 255)]
    private string $brand;

    #[ORM\Column(name: 'model', type: 'string', length: 255)]
    private string $model;

    #[ORM\Column(name: 'nb_seat', type: 'integer')]
    #[Assert\PositiveOrZero]
    private int $nbSeat;

    #[ORM\Column(name: 'color', type: 'string', length: 255)]
    private string $color;

    #[ORM\Column(name: 'ptra', type: 'integer')]
    #[Assert\PositiveOrZero]
    private int $ptra = 0;

    #[ORM\ManyToOne(targetEntity: CarType::class, inversedBy: 'cars')]
    private CarType $type;

    public function getId(): int
    {
        return $this->id;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): Car
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model): Car
    {
        $this->model = $model;

        return $this;
    }

    public function getType(): CarType
    {
        return $this->type;
    }

    public function setType(CarType $type): Car
    {
        $this->type = $type;

        return $this;
    }

    public function getNbSeat(): int
    {
        return $this->nbSeat;
    }

    public function setNbSeat(int $nbSeat): Car
    {
        $this->nbSeat = $nbSeat;

        return $this;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $color): Car
    {
        $this->color = $color;

        return $this;
    }

    public function getPtra(): int
    {
        return $this->ptra;
    }

    public function setPtra(int $ptra): Car
    {
        $this->ptra = $ptra;

        return $this;
    }
}
