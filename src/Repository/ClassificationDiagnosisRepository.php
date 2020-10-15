<?php

namespace App\Repository;

use App\Entity\ClassificationDiagnosis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClassificationDiagnosis|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClassificationDiagnosis|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClassificationDiagnosis[]    findAll()
 * @method ClassificationDiagnosis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassificationDiagnosisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClassificationDiagnosis::class);
    }

    // /**
    //  * @return ClassificationDiagnosis[] Returns an array of ClassificationDiagnosis objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ClassificationDiagnosis
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
