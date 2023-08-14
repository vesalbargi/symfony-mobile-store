<?php

namespace App\MobileCompany;

use App\Entity\MobileCompany;
use App\Repository\MobileCompanyRepository;
use Doctrine\ORM\EntityManagerInterface;

class SearchService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param $mobileCompanyNameQuery
     * @return MobileCompany[]
     */
    public function searchName($mobileCompanyNameQuery): array
    {
        /** @var MobileCompanyRepository $mobileCompanyRepository */

        $mobileCompanyRepository = $this->entityManager->getRepository(MobileCompany::class);
        return $mobileCompanyRepository->searchByName($mobileCompanyNameQuery);
    }
}