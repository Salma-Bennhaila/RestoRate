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
        $query =  $this->createQueryBuilder('R')
            ->orderBy('R.createAt','DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
        // returns an array of restaurant objects
        return $query;
    }


    /**
     * @param $city string
     * @return restaurant[]
     */
    public function findRestaurantByCity($city): array
    {
        $query =  $this->createQueryBuilder('R')
            ->select('R','C')
            ->leftJoin('R.cityId','C')
            ->where('C.cityName =:city')
            ->setParameter('city',$city)
            ->getQuery()
            ->getResult()
            ;
        // returns an array of restaurant objects
        return $query;
    }
}