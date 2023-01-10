<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 *
 * The ORM already provides generic find methods that can be used for querying the db :
 *
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Book::class);
    }

    /**
     * @return Book[] all courses that have books
     */
    public function findByFase(int $fase) : array {
        $entityManager = $this->getEntityManager();
        // ref: https://www.doctrine-project.org/projects/doctrine-orm/en/current/reference/dql-doctrine-query-language.html
        $query = $entityManager->createQuery('
                SELECT b FROM App\Entity\Book b
                INNER JOIN b.course c
                WHERE c.fase = :fase
        ')->setParameter('fase',$fase);
        return $query->getResult();
    }

}
