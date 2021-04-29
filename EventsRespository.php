<?php

namespace App\Repository;

use App\Entity\Events;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Events|null find($id, $lockMode = null, $lockVersion = null)
 * @method Events|null findOneBy(array $criteria, array $orderBy = null)
 * @method Events[]    findAll()
 * @method Events[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventsRespository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Events::class);
    }



    public function findByCritere($minValue,$maxValue)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.dateDeb>= :minVal')
            ->setParameter('minVal', $minValue)
            ->andWhere('a.dateDeb <= :maxVal')
            ->setParameter('maxVal', $maxValue)
           // ->orderBy('a.id', 'ASC')
           // ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }

}
