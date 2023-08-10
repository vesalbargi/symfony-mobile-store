<?php

namespace App\Tests\Integration;

use App\Entity\MobileCompany;
use App\Entity\MobilePhone;
use App\MobilePhone\SearchService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MobilePhoneSearchTest extends KernelTestCase
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

        $mobilePhone1 = new MobilePhone();
        $mobilePhone1->setBrand("Apple");
        $mobilePhone1->setBatteryCapacity(5000);
        $mobilePhone1->setCamera(12);
        $mobilePhone1->setMemory(8);
        $mobilePhone1->setModel("Iphone");
        $mobilePhone1->setOperatingSystem("IOS");
        $mobilePhone1->setPrice(1000);
        $mobilePhone1->setScreenSize(6.5);
        $mobilePhone1->setStorage(128);
        $mobilePhone1->setMobileCompany($mobileCompany);

        $mobilePhone2 = new MobilePhone();
        $mobilePhone2->setBrand("Samsung");
        $mobilePhone2->setBatteryCapacity(5000);
        $mobilePhone2->setCamera(12);
        $mobilePhone2->setMemory(8);
        $mobilePhone2->setModel("Galaxy");
        $mobilePhone2->setOperatingSystem("ANDROID");
        $mobilePhone2->setPrice(1000);
        $mobilePhone2->setScreenSize(6.5);
        $mobilePhone2->setStorage(128);
        $mobilePhone2->setMobileCompany($mobileCompany);

        $entityManager->persist($mobilePhone1);
        $entityManager->persist($mobilePhone2);
        $entityManager->flush();

        $mobilePhoneSearchService = static::getContainer()->get(SearchService::class);
        $this->assertInstanceOf(SearchService::class, $mobilePhoneSearchService);

        $result = $mobilePhoneSearchService->searchBrand("pp");
        $this->assertContains($mobilePhone1, $result);

        $result = $mobilePhoneSearchService->searchBrand("sun");
        $this->assertContains($mobilePhone2, $result);

        $result = $mobilePhoneSearchService->searchBrand("a");
        $this->assertContains($mobilePhone1, $result);
        $this->assertContains($mobilePhone2, $result);
    }
}
