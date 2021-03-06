<?php

namespace App\Repository;

use App\Entity\IndividConnections;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IndividConnections|null find($id, $lockMode = null, $lockVersion = null)
 * @method IndividConnections|null findOneBy(array $criteria, array $orderBy = null)
 * @method IndividConnections[]    findAll()
 * @method IndividConnections[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IndividConnectionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IndividConnections::class);
    }

    // /**
    //  * @return IndividConnections[] Returns an array of IndividConnections objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IndividConnections
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}