<?php

namespace App\Repository;

use App\Entity\Activit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Activit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activit[]    findAll()
 * @method Activit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActivitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activit::class);
    }

    // /**
    //  * @return Activit[] Returns an array of Activit objects
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
    public function findOneBySomeField($value): ?Activit
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
