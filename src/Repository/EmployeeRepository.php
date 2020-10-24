<?php

namespace App\Repository;

use App\Entity\Employee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Employee|null find($id, $lockMode = null, $lockVersion = null)
 * @method Employee|null findOneBy(array $criteria, array $orderBy = null)
 * @method Employee[]    findAll()
 * @method Employee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployeeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Employee::class);
    }

    /**
     * @return Employee[] Returns an array of Employee objects
     */

    public function findAll()
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findOneByAccountId($id) : ?Employee
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.idAccount = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findById($id) : ?Employee
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.id = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findMatchesBySpecialty($spec, $value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.idSpecialty = :sp')
            ->orWhere('e.surname LIKE :val')
            ->orWhere('e.name LIKE :val')
            ->orWhere('e.patronymic LIKE :val')
            ->orWhere('e.phone LIKE :val')
            ->setParameter('val', $value)
            ->setParameter('sp', $spec)
            ->orderBy('e.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findMatches($value)
    {
        return $this->createQueryBuilder('e')
            ->orWhere('e.surname LIKE :val')
            ->orWhere('e.name LIKE :val')
            ->orWhere('e.patronymic LIKE :val')
            ->orWhere('e.phone LIKE :val')
            ->setParameter('val', '%'.$value.'%')
            ->orderBy('e.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Employee
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
