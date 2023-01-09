<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
#[ORM\Table('book')]
class Book {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer", nullable: false)]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255, nullable: false)]
    private ?string $title = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $isbn = null;

    #[ORM\Column(type: Types::BOOLEAN, nullable: false)]
    private ?bool $obliged = false;

    #[ORM\ManyToOne(inversedBy: 'books')]
    #[ORM\JoinColumn(name: "course",nullable: false)]
    private ?Course $course = null;

    #[ORM\ManyToMany(targetEntity: Reservation::class, inversedBy: 'books')]
    private Collection $reservations;

    /**
     * Entity constructor must have no parameters
     */
    public function __construct() {
        $this->reservations = new ArrayCollection();
    }

    /**
     * @return int|null unique id from the database
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @return string book title
     */
    public function getTitle(): string {
        return $this->title;
    }

    /**
     * @param string $title book title
     * @return Book current book object
     */
    public function setTitle(string $title): Book {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null book isbn
     */
    public function getIsbn(): ?string {
        return $this->isbn;
    }

    /**
     * @param string|null $isbn book isbn
     * @return Book current book object
     */
    public function setIsbn(?string $isbn): Book {
        $this->isbn = $isbn;
        return $this;
    }

    /**
     * @return bool obliged or not
     */
    public function getObliged(): bool {
        return $this->obliged;
    }

    /**
     * @param bool $obliged true if obliged
     * @return Book current book object
     */
    public function setObliged(bool $obliged): Book {
        $this->obliged = $obliged;
        return $this;
    }

    /**
     * @return Course course in which the book is used
     */
    public function getCourse(): Course {
        return $this->course;
    }

    /**
     * @param Course|null $course course in which the book is used
     * @return Book current book object
     */
    public function setCourse(?Course $course): Book {
        $this->course = $course;
        return $this;
    }

    /**
     * @return Collection<Reservation> all reservations for this book
     */
    public function getReservations(): Collection {
        return $this->reservations;
    }

    /**
     * @param Reservation $reservation reservation to add to the book
     * @return Book current book object
     */
    public function addReservation(Reservation $reservation): Book {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->addBook($this);
        }
        return $this;
    }

    /**
     * @param Reservation $reservation reservation to be removed from the book
     * @return Book current book object
     */
    public function removeReservation(Reservation $reservation): Book {
        if ($this->reservations->contains($reservation)) {
            $this->reservations->removeElement($reservation);
            $reservation->removeBook($this);
        }
        return $this;
    }

}