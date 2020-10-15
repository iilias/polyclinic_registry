<?php

namespace App\Repository;

use App\Entity\Analyzes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Analyzes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Analyzes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Analyzes[]    findAll()
 * @method Analyzes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnalyzesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Analyzes::class);
    }

    // /**
    //  * @return Analyzes[] Returns an array of Analyzes objects
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
    public function findOneBySomeField($value): ?Analyzes
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
