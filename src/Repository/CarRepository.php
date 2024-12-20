<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;


class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }

    public function findPaginator(int $page, int $limit, ?array $filters): Pagerfanta
    {
        $queryBuilder = $this->createQueryBuilder('car')
            ->orderBy('car.id', 'ASC');

        if ($filters) {
            if ($filters['brand']) {
            $queryBuilder
                ->andWhere('car.brand = :brand')->setParameter('brand', $filters['brand']);
            }
            if ($filters['model']) {
                $queryBuilder
                    ->andWhere('car.model = :model')->setParameter('model', $filters['model']);
            }
            if ($filters['type']) {
                $queryBuilder
                    ->andWhere('car.type = :type')->setParameter('type', $filters['type']);
            }
            if ($filters['color']) {
                $queryBuilder
                    ->andWhere('car.color = :color')->setParameter('color', $filters['color']);
            }
            if ($filters['nbSeat'] !== null) {
                $query = 'car.nbSeat >= :nbSeat';
                if ($filters['nbSeat'] !== Car::SEAT_FILTER_LIMIT) {
                    $query .= ' AND car.nbSeat <= :nbSeat+'.Car::SEAT_FILTER_RANGE;
                }

                $queryBuilder
                    ->andWhere($query)
                    ->setParameter('nbSeat', $filters['nbSeat']);
            }
            if ($filters['ptra'] !== null) {
                $query = 'car.ptra >= :ptra';
                if ($filters['ptra'] !== Car::PTRA_FILTER_LIMIT) {
                    $query .= ' AND car.ptra <= :ptra+'.Car::PTRA_FILTER_RANGE;
                }
                $queryBuilder
                    ->andWhere($query)
                    ->setParameter('ptra', $filters['ptra']);
            }
        }

        $adapter = new ArrayAdapter($queryBuilder->getQuery()->getResult());
        $paginator = new Pagerfanta($adapter);
        $paginator->setMaxPerPage($limit);
        $paginator->setCurrentPage($page);

        return $paginator;
    }
}
