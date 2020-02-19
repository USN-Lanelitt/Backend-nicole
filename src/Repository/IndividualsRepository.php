<?php

namespace App\Repository;

use App\Entity\Individuals;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Individuals|null find($id, $lockMode = null, $lockVersion = null)
 * @method Individuals|null findOneBy(array $criteria, array $orderBy = null)
 * @method Individuals[]    findAll()
 * @method Individuals[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IndividualsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Individuals::class);
    }

    // /**
    //  * @return Individuals[] Returns an array of Individuals objects
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
    public function findOneBySomeField($value): ?Individuals
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
