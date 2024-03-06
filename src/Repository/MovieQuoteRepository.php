<?php

namespace App\Repository;

use App\Entity\Movie;
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

    // Method to search for movie quotes based on a search term
    public function findBySearch(string $term): array
    {
        return $this->createQueryBuilder('quote')
            ->leftJoin('quote.movie', 'movie')
            ->where('quote.quote LIKE :term OR quote.character LIKE :term OR movie.name LIKE :term')
            ->setParameter('term', '%' . $term . '%')
            ->getQuery()
            ->getResult();
    }

    public function findRandom(): array
    {
        $quotes = $this->findAll();

        $random = random_int(0, sizeof($quotes) - 1);

        return [$quotes[$random]];
    }
}