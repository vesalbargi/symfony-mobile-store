<?php

namespace App\Tests\Integration;

use App\Entity\MobileCompany;
use App\MobileCompany\SearchService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MobileCompanySearchTest extends KernelTestCase
{
    protected static function getKernelClass(): string
    {
        return \App\Kernel::class;
    }

    public function testSomething(): void
    {
        $kernel = self::bootKernel();
        $this->assertSame('test', $kernel->getEnvironment());

        $entityManager = static::getContainer()->get(EntityManagerInterface::class);

        $mobileCompany = new MobileCompany();
        $mobileCompany->setName("company");
        $mobileCompany->setAddress("address");
        $mobileCompany->setPhone("(206)");

        $entityManager->persist($mobileCompany);
        $entityManager->flush();

        $mobileCompanySearchService = static::getContainer()->get(SearchService::class);
        $this->assertInstanceOf(SearchService::class, $mobileCompanySearchService);

        $result = $mobileCompanySearchService->searchName("pa");
        $this->assertContains($mobileCompany, $result);
    }
}
