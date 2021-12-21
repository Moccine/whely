<?php

namespace App\Repository;

use App\Entity\Subcriber;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Subcriber|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subcriber|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subcriber[]    findAll()
 * @method Subcriber[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubcriberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subcriber::class);
    }

    // /**
    //  * @return Subcriber[] Returns an array of Subcriber objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Subcriber
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
