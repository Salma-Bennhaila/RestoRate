<?php

namespace App\Repository;

use App\Entity\Reviews;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ReviewsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reviews::class);
    }


    /**
     * @return reviews[]
     */
    public function getReviews(): array
    {
        $query =  $this->createQueryBuilder('R')
            ->select('R','RS')
            ->leftJoin('R.resraurantId','RS')
            ->getQuery()
            ->getResult()
            ;
        // returns an array of restaurant objects
        return $query;
    }
}