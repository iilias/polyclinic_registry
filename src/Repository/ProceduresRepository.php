<?php

namespace App\Repository;

use App\Entity\Procedures;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Procedures|null find($id, $lockMode = null, $lockVersion = null)
 * @method Procedures|null findOneBy(array $criteria, array $orderBy = null)
 * @method Procedures[]    findAll()
 * @method Procedures[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProceduresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Procedures::class);
    }

    // /**
    //  * @return Procedures[] Returns an array of Procedures objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Procedures
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
