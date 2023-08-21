<?php

namespace App\Repository;

use App\Entity\MobilePhone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MobilePhone>
 *
 * @method MobilePhone|null find($id, $lockMode = null, $lockVersion = null)
 * @method MobilePhone|null findOneBy(array $criteria, array $orderBy = null)
 * @method MobilePhone[]    findAll()
 * @method MobilePhone[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MobilePhoneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MobilePhone::class);
    }

    public function searchByBrand($mobilePhoneBrandQuery)
    {
        $qb = $this->createQueryBuilder('mp');

        return $qb->andWhere($qb->expr()->like('mp.brand', ':brand'))
            ->setParameter('brand', "%$mobilePhoneBrandQuery%")
            ->orderBy('mp.brand', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function searchByModel($mobilePhoneModelQuery)
    {
        $qb = $this->createQueryBuilder('mp');

        return $qb->andWhere($qb->expr()->like('mp.model', ':model'))
            ->setParameter('model', "%$mobilePhoneModelQuery%")
            ->orderBy('mp.model', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function searchByBrandAndModel($mobilePhoneModelQuery)
    {
        $qb = $this->createQueryBuilder('mp');

        return $qb->where($qb->expr()->like('mp.model', ':model'))
            ->orWhere($qb->expr()->like('mp.brand', ':brand'))
            ->setParameter('brand', "%$mobilePhoneModelQuery%")
            ->setParameter('model', "%$mobilePhoneModelQuery%")
            ->orderBy('mp.model', 'ASC')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return MobilePhone[] Returns an array of MobilePhone objects
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

//    public function findOneBySomeField($value): ?MobilePhone
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
