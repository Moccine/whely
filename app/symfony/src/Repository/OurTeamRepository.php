<?php

namespace App\Repository;

use App\Entity\OurTeam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OurTeam|null find($id, $lockMode = null, $lockVersion = null)
 * @method OurTeam|null findOneBy(array $criteria, array $orderBy = null)
 * @method OurTeam[]    findAll()
 * @method OurTeam[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OurTeamRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OurTeam::class);
    }

    // /**
    //  * @return OurTeam[] Returns an array of OurTeam objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OurTeam
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
