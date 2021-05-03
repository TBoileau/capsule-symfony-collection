<?php

namespace App\Repository;

use App\Entity\Qux;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Qux|null find($id, $lockMode = null, $lockVersion = null)
 * @method Qux|null findOneBy(array $criteria, array $orderBy = null)
 * @method Qux[]    findAll()
 * @method Qux[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Qux::class);
    }

    // /**
    //  * @return Qux[] Returns an array of Qux objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Qux
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
