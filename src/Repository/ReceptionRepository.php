<?php

namespace App\Repository;

use App\Entity\Reception;
use App\Entity\Timetable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reception|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reception|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reception[]    findAll()
 * @method Reception[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReceptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reception::class);
    }

    /**
     * @return Reception[] Returns an array of Reception objects
     */

    public function findOneByDateTime($date, $time, $empl): ?Reception
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.date = :val')
            ->andWhere('r.time = :val2')
            ->andWhere('r.idEmployee = :val3')
            ->setParameter('val', $date)
            ->setParameter('val2', $time)
            ->setParameter('val3', $empl)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findByPatientId($id)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.idPatient = :val')
            ->setParameter('val', $id)
            ->orderBy('r.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByEmployeeId($id)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.idEmployee = :val')
            ->setParameter('val', $id)
            ->orderBy('r.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findById($id) : ?Reception
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.id = :val')
            ->setParameter('val', $id)
            ->orderBy('r.id', 'ASC')
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function updateVisitStatus($id, $status)
    {
        $this->createQueryBuilder('r')
            ->update('App\Entity\Reception', 'r')
            ->set('r.visited', $status)
            ->where('r.id = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->execute()
            ;
    }

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
    public function findOneBySomeField($value): ?Reception
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
