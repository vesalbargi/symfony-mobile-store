<?php

namespace App\Menu;

use App\Entity\MobileCompany;
use App\Entity\MobilePhone;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    private FactoryInterface $factory;
    private EntityManagerInterface $entityManager;
    private Security $security;

    public function __construct(FactoryInterface $factory, EntityManagerInterface $entityManager, Security $security)
    {
        $this->factory = $factory;
        $this->entityManager = $entityManager;
        $this->security = $security;
    }

    public function mainMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('About Us', ['route' => 'app_about'])
            ->setAttribute('class', 'nav-item')
            ->setLinkAttribute('class', 'nav-link');

        $menu->addChild('Mobile Companies', ['route' => 'app_mobile_company_index'])
            ->setAttribute('class', 'nav-item dropdown')
            ->setLinkAttribute('class', 'nav-link dropdown-toggle')
            ->setLinkAttribute('data-bs-toggle', 'link');

        $mobileCompanies = $this->entityManager->getRepository(MobileCompany::class)->findAll();
        foreach ($mobileCompanies as $mobileCompany) {
            $menu['Mobile Companies']->addChild($mobileCompany->getName(), [
                'route' => 'app_mobile_company_show',
                'routeParameters' => ['id' => $mobileCompany->getId()]
            ])
                ->setLinkAttribute('class', 'dropdown-item');
        }

        $menu['Mobile Companies']->setChildrenAttribute('class', 'dropdown-menu dropdown-menu-dark');

        $menu->addChild('Mobile Phones', ['route' => 'app_mobile_phone_index'])
            ->setAttribute('class', 'nav-item dropdown')
            ->setLinkAttribute('class', 'nav-link dropdown-toggle')
            ->setLinkAttribute('data-bs-toggle', 'link');

        $mobilePhones = $this->entityManager->getRepository(MobilePhone::class)->findAll();
        foreach ($mobilePhones as $mobilePhone) {
            $menu['Mobile Phones']->addChild($mobilePhone->getModel(), [
                'route' => 'app_mobile_phone_show',
                'routeParameters' => ['id' => $mobilePhone->getId()]
            ])
                ->setLinkAttribute('class', 'dropdown-item');
        }

        $menu['Mobile Phones']->setChildrenAttribute('class', 'dropdown-menu dropdown-menu-dark');

        $menu->setChildrenAttribute('class', 'navbar-nav');

        return $menu;
    }

    public function navbarMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        if ($this->security->isGranted('ROLE_ADMIN')) {
            $menu->addChild('Admin Dashboard', ['route' => 'admin'])
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link');
        }

        if ($this->security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $menu->addChild('Log out', ['route' => 'app_logout'])
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link');
        } else {
            $menu->addChild('Login', ['route' => 'app_login'])
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link');
            $menu->addChild('Register', ['route' => 'app_register'])
                ->setAttribute('class', 'nav-item')
                ->setLinkAttribute('class', 'nav-link');
        }

        $menu->setChildrenAttribute('class', 'navbar-nav ms-auto');

        return $menu;
    }
}