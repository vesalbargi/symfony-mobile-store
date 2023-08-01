<?php

namespace App\Listeners;

use App\Model\UserLoggerInterface;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class UserLoggerListener
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof UserLoggerInterface) {
            return;
        }

        $user = $this->security->getUser();
        if ($user instanceof UserInterface) {
            $entity->setCreatedUser($user);
            $entity->setUpdatedUser($user);
        }
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof UserLoggerInterface) {
            return;
        }

        $user = $this->security->getUser();
        if ($user instanceof UserInterface) {
            $entity->setUpdatedUser($user);
        }
    }
}