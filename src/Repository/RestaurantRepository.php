<?php

namespace App\Repository;

use App\Entity\Restaurant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class RestaurantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Restaurant::class);
    }


    /**
     * @return restaurant[]
     */
    public function findRestaurant(): array
    {
        $query =  $this->createQueryBuilder('c')
            ->orderBy('c.createAt','ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
        // returns an array of restaurant objects
        return $query;
    }
}