<?php

namespace App\Repository;

use App\Entity\Course;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Course>
 *
 * The ORM already provides generic find methods that can be used for querying the db :
 *
 * @method Course|null find($id, $lockMode = null, $lockVersion = null)
 * @method Course|null findOneBy(array $criteria, array $orderBy = null)
 * @method Course[]    findAll()
 * @method Course[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CourseRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Course::class);
    }

    /**
     * @return Course[] all courses that have books
     */
    public function findAllWithBooks() : array {
        $entityManager = $this->getEntityManager();
        // selecting c and b results in fully hydrated objects (alternative to eager loading)
        $query = $entityManager->createQuery('
                SELECT c, b FROM App\Entity\Course c 
                INNER JOIN c.books b
        ');
        return $query->getResult();
    }

}