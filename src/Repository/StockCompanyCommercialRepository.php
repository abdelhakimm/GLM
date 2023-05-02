<?php

namespace App\Repository;

use App\Entity\StockCompanyCommercial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StockCompanyCommercial>
 *
 * @method StockCompanyCommercial|null find($id, $lockMode = null, $lockVersion = null)
 * @method StockCompanyCommercial|null findOneBy(array $criteria, array $orderBy = null)
 * @method StockCompanyCommercial[]    findAll()
 * @method StockCompanyCommercial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StockCompanyCommercialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StockCompanyCommercial::class);
    }

    public function save(StockCompanyCommercial $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(StockCompanyCommercial $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return StockCompanyCommercial[] Returns an array of StockCompanyCommercial objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?StockCompanyCommercial
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
