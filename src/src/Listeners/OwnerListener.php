<?php

namespace App\Listeners;

use App\Model\OwnerInterface;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class OwnerListener
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof OwnerInterface) {
            return;
        }

        $user = $this->security->getUser();
        if ($user instanceof UserInterface) {
            $entity->setOwner($user);
        }
    }
}