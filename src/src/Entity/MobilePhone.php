<?php

namespace App\Entity;

use App\Model\TimeLoggerInterface;
use App\Model\TimeLoggerTrait;
use App\Model\UserLoggerInterface;
use App\Model\UserLoggerTrait;
use App\Repository\MobilePhoneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MobilePhoneRepository::class)]
class MobilePhone implements TimeLoggerInterface, UserLoggerInterface
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
    private ?string $brand = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private ?string $model = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private ?string $operatingSystem = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?float $screenSize = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?int $memory = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?int $storage = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private ?string $camera = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?int $batteryCapacity = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?float $price = null;

    #[ORM\ManyToOne(inversedBy: 'MobilePhones')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MobileCompany $mobileCompany = null;

    #[ORM\OneToMany(mappedBy: 'mobilePhone', targetEntity: Comment::class, orphanRemoval: true)]
    private Collection $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    public function __toString(): string
    {
        return "[{$this->getId()}]  {$this->getBrand()} {$this->getModel()}";
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getOperatingSystem(): ?string
    {
        return $this->operatingSystem;
    }

    public function setOperatingSystem(string $operatingSystem): static
    {
        $this->operatingSystem = $operatingSystem;

        return $this;
    }

    public function getScreenSize(): ?float
    {
        return $this->screenSize;
    }

    public function setScreenSize(float $screenSize): static
    {
        $this->screenSize = $screenSize;

        return $this;
    }

    public function getMemory(): ?int
    {
        return $this->memory;
    }

    public function setMemory(int $memory): static
    {
        $this->memory = $memory;

        return $this;
    }

    public function getStorage(): ?int
    {
        return $this->storage;
    }

    public function setStorage(int $storage): static
    {
        $this->storage = $storage;

        return $this;
    }

    public function getCamera(): ?string
    {
        return $this->camera;
    }

    public function setCamera(string $camera): static
    {
        $this->camera = $camera;

        return $this;
    }

    public function getBatteryCapacity(): ?int
    {
        return $this->batteryCapacity;
    }

    public function setBatteryCapacity(int $batteryCapacity): static
    {
        $this->batteryCapacity = $batteryCapacity;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getMobileCompany(): ?MobileCompany
    {
        return $this->mobileCompany;
    }

    public function setMobileCompany(?MobileCompany $mobileCompany): static
    {
        $this->mobileCompany = $mobileCompany;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setMobilePhone($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getMobilePhone() === $this) {
                $comment->setMobilePhone(null);
            }
        }

        return $this;
    }
}
