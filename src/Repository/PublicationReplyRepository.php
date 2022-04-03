<?php

namespace App\Repository;

use App\Entity\PublicationReply;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PublicationReply|null find($id, $lockMode = null, $lockVersion = null)
 * @method PublicationReply|null findOneBy(array $criteria, array $orderBy = null)
 * @method PublicationReply[]    findAll()
 * @method PublicationReply[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PublicationReplyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PublicationReply::class);
    }

    // /**
    //  * @return PublicationReply[] Returns an array of PublicationReply objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PublicationReply
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
