<?php

namespace App\Tests;

use App\Entity\MobilePhone;
use App\Repository\MobilePhoneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MobilePhoneTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/mobile-phone/');

        $entityManager = static::getContainer()->get(EntityManagerInterface::class);
        /**
         * @var MobilePhoneRepository $mobilePhoneRepo
         */
        $mobilePhoneRepo = $entityManager->getRepository(MobilePhone::class);

        $allMobilePhones = $mobilePhoneRepo->findAll();

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Mobile Phones');

        $rows = $crawler->filter('div > div > h5');
        $this->assertCount(count($allMobilePhones), $rows);
    }
}
