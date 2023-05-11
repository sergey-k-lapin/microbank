<?php

namespace App\Repository;

use App\Entity\MonetaryAmount;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MonetaryAmount>
 *
 * @method MonetaryAmount|null find($id, $lockMode = null, $lockVersion = null)
 * @method MonetaryAmount|null findOneBy(array $criteria, array $orderBy = null)
 * @method MonetaryAmount[]    findAll()
 * @method MonetaryAmount[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MonetaryAmountRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MonetaryAmount::class);
    }

    public function save(MonetaryAmount $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MonetaryAmount $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MonetaryAmount[] Returns an array of MonetaryAmount objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MonetaryAmount
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
