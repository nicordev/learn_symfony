<?php

namespace App\Repository;

use App\Entity\TopicDay;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TopicDay|null find($id, $lockMode = null, $lockVersion = null)
 * @method TopicDay|null findOneBy(array $criteria, array $orderBy = null)
 * @method TopicDay[]    findAll()
 * @method TopicDay[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TopicDayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TopicDay::class);
    }

    // /**
    //  * @return TopicDay[] Returns an array of TopicDay objects
    //  */
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
    public function findOneBySomeField($value): ?TopicDay
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
