<?php

namespace App\Repository;

use App\Entity\MobileCompany;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MobileCompany>
 *
 * @method MobileCompany|null find($id, $lockMode = null, $lockVersion = null)
 * @method MobileCompany|null findOneBy(array $criteria, array $orderBy = null)
 * @method MobileCompany[]    findAll()
 * @method MobileCompany[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MobileCompanyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MobileCompany::class);
    }

    public function searchByName($mobileCompanyNameQuery)
    {
        $qb = $this->createQueryBuilder('mc');

        return $qb->andWhere($qb->expr()->like('mc.name', ':name'))
            ->setParameter('name', "%$mobileCompanyNameQuery%")
            ->orderBy('mc.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return MobileCompany[] Returns an array of MobileCompany objects
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

//    public function findOneBySomeField($value): ?MobileCompany
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
