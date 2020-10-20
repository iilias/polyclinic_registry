<?php

namespace App\Repository;

use App\Entity\Timetable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Timetable|null find($id, $lockMode = null, $lockVersion = null)
 * @method Timetable|null findOneBy(array $criteria, array $orderBy = null)
 * @method Timetable[]    findAll()
 * @method Timetable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TimetableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Timetable::class);
    }

    /**
     * @return Timetable[] Returns an array of Timetable objects
     */

    public function findByIdEmployee($id)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.idEmployee = :id')
            ->setParameter('id', $id)
            ->orderBy('t.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Timetable
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
