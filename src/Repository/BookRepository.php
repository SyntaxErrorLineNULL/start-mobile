<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use function Doctrine\ORM\QueryBuilder;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /**
     * @throws ORMException
     */
    public function add(Book $book): void {
        $this->_em->persist($book);
    }

    public function findById(int $id): ?Book {
        /** @var Book|null $book */
        return $this->find($id);
    }

    /**
     * @throws ORMException
     */
    public function remove(Book $book): void {
        $this->_em->remove($book);
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function countBook(int $authorId): int {
        $qb = $this->createQueryBuilder('book');
        $qb->select('COUNT(book.authorId)')
            ->andWhere($qb->expr()->eq('book.authorId', ':authorId'))
            ->setParameter('authorId', $authorId);
        return $qb->getQuery()->getSingleScalarResult();
    }
}
