<?php

namespace App\Model;

interface OwnerInterface
{
    public function getOwner(): \App\Entity\User;

    public function setOwner(\App\Entity\User $user): self;
}