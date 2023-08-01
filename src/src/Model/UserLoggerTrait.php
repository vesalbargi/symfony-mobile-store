<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

trait UserLoggerTrait
{
    #[ORM\ManyToOne(targetEntity: 'App\Entity\User')]
    protected ?\App\Entity\User $createdUser = null;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\User')]
    protected ?\App\Entity\User $updatedUser = null;

    public function getCreatedUser(): \App\Entity\User
    {
        return $this->createdUser;
    }

    public function setCreatedUser(\App\Entity\User $user): self
    {
        $this->createdUser = $user;
        return $this;
    }

    public function getUpdatedUser(): \App\Entity\User
    {
        return $this->updatedUser;
    }

    public function setUpdatedUser(\App\Entity\User $user): self
    {
        $this->updatedUser = $user;
        return $this;
    }
}