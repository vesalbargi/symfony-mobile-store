<?php

namespace App\MobilePhone;

use App\Entity\MobilePhone;
use App\Repository\MobilePhoneRepository;
use Doctrine\ORM\EntityManagerInterface;

class SearchService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param $mobilePhoneBrandQuery
     * @return MobilePhone[]
     */
    public function searchBrand($mobilePhoneBrandQuery): array
    {
        /** @var MobilePhoneRepository $mobilePhoneRepository */

        $mobilePhoneRepository = $this->entityManager->getRepository(MobilePhone::class);
        return $mobilePhoneRepository->searchByBrand($mobilePhoneBrandQuery);
    }

    /**
     * @param $mobilePhoneModelQuery
     * @return MobilePhone[]
     */
    public function searchModel($mobilePhoneModelQuery): array
    {
        /** @var MobilePhoneRepository $mobilePhoneRepository */

        $mobilePhoneRepository = $this->entityManager->getRepository(MobilePhone::class);
        return $mobilePhoneRepository->searchByModel($mobilePhoneModelQuery);
    }

    /**
     * @param $mobilePhoneBrandAndModelQuery
     * @return MobilePhone[]
     */
    public function searchBrandAndModel($mobilePhoneBrandAndModelQuery): array
    {
        /** @var MobilePhoneRepository $mobilePhoneRepository */

        $mobilePhoneRepository = $this->entityManager->getRepository(MobilePhone::class);
        return $mobilePhoneRepository->searchByBrandAndModel($mobilePhoneBrandAndModelQuery);
    }
}