<?php

namespace App\Entity;

use App\Model\TimeLoggerInterface;
use App\Model\TimeLoggerTrait;
use App\Model\UserLoggerInterface;
use App\Model\UserLoggerTrait;
use App\Repository\MobileCompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MobileCompanyRepository::class)]
class MobileCompany implements TimeLoggerInterface, UserLoggerInterface
{
    use TimeLoggerTrait;
    use UserLoggerTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private ?string $phone = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    private ?string $address = null;

    #[ORM\OneToMany(mappedBy: 'mobileCompany', targetEntity: MobilePhone::class, orphanRemoval: true)]
    private Collection $MobilePhones;

    public function __construct()
    {
        $this->MobilePhones = new ArrayCollection();
    }

    public function __toString(): string
    {
        return "[{$this->getId()}]  {$this->getName()}";
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection<int, MobilePhone>
     */
    public function getMobilePhones(): Collection
    {
        return $this->MobilePhones;
    }

    public function addMobilePhone(MobilePhone $mobilePhone): static
    {
        if (!$this->MobilePhones->contains($mobilePhone)) {
            $this->MobilePhones->add($mobilePhone);
            $mobilePhone->setMobileCompany($this);
        }

        return $this;
    }

    public function removeMobilePhone(MobilePhone $mobilePhone): static
    {
        if ($this->MobilePhones->removeElement($mobilePhone)) {
            // set the owning side to null (unless already changed)
            if ($mobilePhone->getMobileCompany() === $this) {
                $mobilePhone->setMobileCompany(null);
            }
        }

        return $this;
    }
}
