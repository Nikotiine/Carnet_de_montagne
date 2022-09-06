<?php

namespace App\Repository;

use App\Entity\MainCategory;
use App\Entity\NotebookPage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NotebookPage>
 *
 * @method NotebookPage|null find($id, $lockMode = null, $lockVersion = null)
 * @method NotebookPage|null findOneBy(array $criteria, array $orderBy = null)
 * @method NotebookPage[]    findAll()
 * @method NotebookPage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotebookPageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NotebookPage::class);
    }

    public function add(NotebookPage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(NotebookPage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Retourne les dernieres notes ajouter en publique et par filter par date de publication.
     *
     * @return NotebookPage[] Returns an array of NotebookPage objects
     */
    public function findByPublicNote(string $orderBy): array
    {
        return $this->createQueryBuilder("n")
            ->andWhere("n.isPublic = 1")
            ->orderBy("n.achieveAt", $orderBy)
            ->getQuery()
            ->getResult();
    }

    /**
     * Retrourne un array de note filtrer par categorie et par ordre de publication
     * @param int $cat
     * @param string $orderBy
     * @return array|null
     */
    public function findPublicWithParameters(int $cat, string $orderBy): ?array
    {
        return $this->createQueryBuilder("n")
            ->andWhere("n.isPublic = 1")
            ->andWhere("n.category = :cat")
            ->setParameter("cat", $cat)
            ->orderBy("n.achieveAt", $orderBy)
            ->getQuery()
            ->getResult();
    }

    /**
     * retourne la derniere note creer par l'utilisateur
     * @return array|null
     */
    public function findLastEntry(): ?array
    {
        return $this->createQueryBuilder("n")
            ->orderBy("n.createdAt", "DESC")
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }

    /**
     * retourne le notebook public de l'utlisateur filtree par categorie
     * @param int $selectedUser
     * @param mixed $selectedCategory
     * @param string $orderBy
     * @return array
     */
    public function findPublicUserNotebookWithCategory(
        int $selectedUser,
        mixed $selectedCategory,
        string $orderBy
    ): array {
        return $this->createQueryBuilder("n")
            ->andWhere("n.isPublic = 1")
            ->andWhere("n.category = :cat")
            ->andWhere("n.author = :user")
            ->setParameter("user", $selectedUser)
            ->setParameter("cat", $selectedCategory)
            ->orderBy("n.achieveAt", $orderBy)
            ->getQuery()
            ->getResult();
    }

    /**
     * retourne les notebook public de l'utlisateur
     * @param mixed $selectedUser
     * @param string $orderBy
     * @return array
     */
    public function findPublicUserNotebooks(
        mixed $selectedUser,
        string $orderBy
    ): array {
        return $this->createQueryBuilder("n")
            ->andWhere("n.isPublic = 1")
            ->andWhere("n.author = :user")
            ->setParameter("user", $selectedUser)
            ->orderBy("n.achieveAt", $orderBy)
            ->getQuery()
            ->getResult();
    }
    public function getStats(mixed $selectedUser): array
    {
        return $this->createQueryBuilder("n")
            ->select("count(n) as data,c.id")
            ->join("n.category", "c")
            ->andWhere("n.author = :user")
            ->setParameter("user", $selectedUser)
            ->groupBy("n.category")
            ->getQuery()
            ->getResult();
    }

    public function getTotalPagesInNotebooks(mixed $selectedUser): int
    {
        return $this->createQueryBuilder("n")
            ->select("count(n) as data")
            ->andWhere("n.author = :user")
            ->setParameter("user", $selectedUser)
            ->getQuery()
            ->getState();
    }
}
