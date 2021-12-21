<?php

namespace App\Repository;

use App\Entity\RequestCallBack;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RequestCallBack|null find($id, $lockMode = null, $lockVersion = null)
 * @method RequestCallBack|null findOneBy(array $criteria, array $orderBy = null)
 * @method RequestCallBack[]    findAll()
 * @method RequestCallBack[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RequestCallBackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RequestCallBack::class);
    }

    // /**
    //  * @return RequestCallBack[] Returns an array of RequestCallBack objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RequestCallBack
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
