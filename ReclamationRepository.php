<?php

namespace App\Repository;

use App\Entity\Reclamation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reclamation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reclamation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reclamation[]    findAll()
 * @method Reclamation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReclamationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reclamation::class);
    }

     /**
      *  @return Reclamation[] Returns an array of Reclamation objects
      */

    public function calcul($status)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.statut = :val')
            ->setParameter('val', $status)
            ->getQuery()
            ->getResult()
            ;

    }
    public function getDate()
    {
        return $this->createQueryBuilder('s')
            ->select('s.date_creation')
            ->getQuery()
            ->getResult()
            ;

    }
    public function getDate2()
    {
        return $this->createQueryBuilder('s')
            ->select('s.date_validation')
            ->getQuery()
            ->getResult()
            ;

    }
}
