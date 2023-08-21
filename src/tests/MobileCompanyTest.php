<?php

namespace App\Tests;

use App\Entity\MobileCompany;
use App\Repository\MobileCompanyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MobileCompanyTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/mobile-company/');

        $entityManager = static::getContainer()->get(EntityManagerInterface::class);
        /**
         * @var MobileCompanyRepository $mobileCompanyRepo
         */
        $mobileCompanyRepo = $entityManager->getRepository(MobileCompany::class);

        $allMobileCompanies = $mobileCompanyRepo->findAll();

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Mobile Companies');

        $rows = $crawler->filter('div > div > a');
        $this->assertCount(count($allMobileCompanies), $rows);
    }
}
