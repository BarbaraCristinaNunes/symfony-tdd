<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'boolean')]
    private $premiumMember;

    public function __construct(bool $premiumMember)
    {
        $this->premiumMember = $premiumMember;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPremiumMember(): ?bool
    {
        return $this->premiumMember;
    }

    public function setPremiumMember(bool $premiumMember): self
    {
        $this->premiumMember = $premiumMember;

        return $this;
    }

    function canBook(User $user) {
        return ($this->getPremiumMember() && $user->getPremiumMember()) || !$this->getPremiumMember();
    }
}
