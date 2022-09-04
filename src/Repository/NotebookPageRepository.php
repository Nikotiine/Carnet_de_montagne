<?php

namespace App\Repository;

use App\Entity\NotebookPage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
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

    //    public function findOneBySomeField($value): ?NotebookPage
    //    {
    //        return $this->createQueryBuilder('n')
    //            ->andWhere('n.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
