<?php

namespace App\Tests\MobilePhone;

use App\Entity\MobilePhone;
use App\MobilePhone\SearchService;
use App\Repository\MobilePhoneRepository;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;

class SearchServiceTest extends TestCase
{
    public function testSomething(): void
    {
        $mobilePhone = new MobilePhone();
        $mobilePhone->setBrand("Xiaomi");

        $mobilePhoneRepository = $this->createMock(MobilePhoneRepository::class);
        $mobilePhoneRepository->expects($this->exactly(1))
            ->method('searchByBrand')
            ->with("redmi")
            ->willReturn([$mobilePhone]);

        $entityManager = $this->createMock(EntityManager::class);
        $entityManager->expects($this->any())
            ->method('getRepository')
            ->with(MobilePhone::class)
            ->willReturn($mobilePhoneRepository);

        $searchService = new SearchService($entityManager);
        $result = $searchService->searchBrand("redmi");

        $this->assertContains($mobilePhone, $result);
    }
}
