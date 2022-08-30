<?php

namespace App\Repository;

use App\Entity\ConditionMeteo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ConditionMeteo>
 *
 * @method ConditionMeteo|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConditionMeteo|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConditionMeteo[]    findAll()
 * @method ConditionMeteo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConditionMeteoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConditionMeteo::class);
    }

    public function add(ConditionMeteo $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ConditionMeteo $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ConditionMeteo[] Returns an array of ConditionMeteo objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ConditionMeteo
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
