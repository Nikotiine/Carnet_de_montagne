<?php

namespace App\Repository;

use App\Entity\NotebookPage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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
     * Retourne les dernieres notes ajouter en publique et par filter par date de publication
     * @return NotebookPage[] Returns an array of NotebookPage objects
     */
    public function findByLastPublicNote(): array
    {
        return $this->createQueryBuilder("n")
            ->andWhere("n.isPublic = 1")
            ->orderBy("n.achieveAt", "DESC")
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
