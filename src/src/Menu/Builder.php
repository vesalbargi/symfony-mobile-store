<?php

namespace App\Menu;

use App\Entity\MobileCompany;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class Builder
{
    private $factory;
    private EntityManagerInterface $entityManager;
    private $access;

    public function __construct(FactoryInterface $factory, EntityManagerInterface $entityManager, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->factory = $factory;
        $this->entityManager = $entityManager;
        $this->access = $authorizationChecker->isGranted('IS_AUTHENTICATED_REMEMBERED');
    }

    public function mainMenu(RequestStack $requestStack): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        if ($this->access) {
            $menu->addChild('Log out', ['route' => 'app_logout']);
        } else {
            $menu->addChild('Login', ['route' => 'app_login']);
            $menu->addChild('Register', ['route' => 'app_register']);
        }

        $menu->addChild('About Us', ['route' => 'app_home']);
        $menu->addChild('Mobile Companies', ['route' => 'app_mobile_company_index']);

        $hotels = $this->entityManager->getRepository(MobileCompany::class)->findAll();

        foreach ($hotels as $hotel) {
            $menu['Mobile Companies']->addChild($hotel->getName(), [
                'route' => 'app_mobile_company_show',
                'routeParameters' => ['id' => $hotel->getId()]
            ]);
        }

        return $menu;
    }
}