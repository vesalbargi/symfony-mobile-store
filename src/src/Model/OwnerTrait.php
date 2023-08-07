<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

trait OwnerTrait
{
    #[ORM\ManyToOne(targetEntity: 'App\Entity\User')]
    protected ?\App\Entity\User $owner = null;

    public function getOwner(): \App\Entity\User
    {
        return $this->owner;
    }

    public function setOwner(\App\Entity\User $user): self
    {
        $this->owner = $user;
        return $this;
    }
}