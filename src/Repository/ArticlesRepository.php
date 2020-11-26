<?php

namespace App\Repository;

use App\Entity\Articles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Articles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Articles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Articles[]    findAll()
 * @method Articles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticlesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Articles::class);
    }

     /**
      * @return Articles[] Returns an array of Articles objects
      */
    public function findByTag($value)
    {
        $qb = $this->createQueryBuilder('a');
            $qb->select('a')
                ->where("a.tags LIKE '%$value%'")
            ;
        $query = $qb->getQuery();
        return $query->getResult();

    }

    public function findBySearch($value)
    {
        $qb = $this->createQueryBuilder('a');
        $qb->select('a')
            ->where("a.content LIKE '%$value%'")
        ;
        $query = $qb->getQuery();
        return $query->getResult();

    }

    /*
    public function findOneBySomeField($value): ?Articles
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
