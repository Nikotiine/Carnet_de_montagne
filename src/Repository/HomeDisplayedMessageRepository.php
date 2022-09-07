<?php

namespace App\Repository;

use App\Entity\HomeDisplayedMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HomeDisplayedMessage>
 *
 * @method HomeDisplayedMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method HomeDisplayedMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method HomeDisplayedMessage[]    findAll()
 * @method HomeDisplayedMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HomeDisplayedMessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HomeDisplayedMessage::class);
    }

    public function add(HomeDisplayedMessage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(HomeDisplayedMessage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return HomeDisplayedMessage[] Returns an array of HomeDisplayedMessage objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?HomeDisplayedMessage
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
