<?php

namespace App\Repository;

use App\Entity\Quiz;
use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Quiz|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quiz|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quiz[]    findAll()
 * @method Quiz[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quiz::class);
    }

    // /**
    //  * @return Quiz[] Returns an array of Quiz objects
    //  */
    
    public function findByUser($user)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.user = :id')
            ->setParameter('id', $user)
            ->orderBy('q.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findAllQuizBase($id): array
    {
       /* $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT * FROM quiz q INNER JOIN category c ON q.category_id = c.id
            WHERE q.user_id = 50
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAllAssociative();*/
        return $this->createQueryBuilder('q')
        ->innerJoin(Category::class, 'c', Join::WITH, 'q.category = c.id')
        ->where('q.user = :id')
        ->setParameter('id', $id)
        ->getQuery()
        ->getResult()
    ;
    }

    /*
    public function findOneBySomeField($value): ?Quiz
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
