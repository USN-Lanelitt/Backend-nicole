<?php

namespace App\Repository;

use App\Entity\UserConnections;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserConnections|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserConnections|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserConnections[]    findAll()
 * @method UserConnections[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserConnectionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserConnections::class);
    }

    // /**
    //  * @return UserConnections[] Returns an array of UserConnections objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserConnections
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
// /**
    //  * @return UserConnections[] Returns an array of UserConnections objects
    //  */
    public function findFriendsId($id): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery('
        SELECT p FROM App\Entity\UserConnections p
        WHERE  p.user2 = :id'

        )->setParameter('id', $id);

        // returns an array of Product objects
        return $query->getResult();
    }
    public function findFriends($id): array
    {
        $entityManager = $this->getEntityManager();
        $qb = $this->createQueryBuilder('p')
            ->select('p.user2') //your id field
            ->getQuery()
            ->getScalarResult();

        $query = $qb->getQuery();

        return $query->execute();
    }
}
