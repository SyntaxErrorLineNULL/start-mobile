<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

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

    public function countBook(int $authorId) {
        $qb = $this->createQueryBuilder('book');
        $qb->select();
    }
}
