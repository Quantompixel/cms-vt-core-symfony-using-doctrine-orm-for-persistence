<?php

namespace App\Repository;

use App\Entity\MovieQuote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MovieQuote>
 *
 * @method MovieQuote|null find($id, $lockMode = null, $lockVersion = null)
 * @method MovieQuote|null findOneBy(array $criteria, array $orderBy = null)
 * @method MovieQuote[]    findAll()
 * @method MovieQuote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieQuoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MovieQuote::class);
    }

//    /**
//     * @return MovieQuote[] Returns an array of MovieQuote objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MovieQuote
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
