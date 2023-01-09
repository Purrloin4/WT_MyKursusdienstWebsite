<?php

namespace App\Entity;

use App\Repository\StaffRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StaffRepository::class)]
#[ORM\Table('staff')]
class Staff
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer", nullable: false)]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 30, nullable: false)]
    private ?string $name = null;

    #[ORM\Column(type: "string", length: 50, nullable: false)]
    private ?string $email = null;

    /**
     * @return int|null unique id from the database
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @return string staff full name
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name staff full name
     * @return Staff current staff object
     */
    public function setName(string $name): Staff {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string staff email
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * @param string $email staff email
     * @return Staff current staff object
     */
    public function setEmail(string $email): Staff {
        $this->email = $email;
        return $this;
    }

}