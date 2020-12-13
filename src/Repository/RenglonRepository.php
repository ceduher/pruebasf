<?php

namespace App\Repository;

use App\Entity\Renglon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Renglon|null find($id, $lockMode = null, $lockVersion = null)
 * @method Renglon|null findOneBy(array $criteria, array $orderBy = null)
 * @method Renglon[]    findAll()
 * @method Renglon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RenglonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Renglon::class);
    }

    // /**
    //  * @return Renglon[] Returns an array of Renglon objects
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
    public function findOneBySomeField($value): ?Renglon
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
