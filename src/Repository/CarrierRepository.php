<?php

namespace App\Repository;

use App\Entity\Carrier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CarrierRepository extends ServiceEntityRepository
{

    /**
     * @param  ManagerRegistry  $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Carrier::class);
    }

    /**
     * @return array
     */
    public function getIdNameList(): array
    {
        return $this->createQueryBuilder('c')
            ->select(['c.id', 'c.name'])
            ->getQuery()
            ->getResult();
    }


}