<?php

namespace App\Repository;

use App\Entity\AboutDescription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AboutDescription|null find($id, $lockMode = null, $lockVersion = null)
 * @method AboutDescription|null findOneBy(array $criteria, array $orderBy = null)
 * @method AboutDescription[]    findAll()
 * @method AboutDescription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AboutDescriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AboutDescription::class);
    }

    // /**
    //  * @return AboutDescription[] Returns an array of AboutDescription objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AboutDescription
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
