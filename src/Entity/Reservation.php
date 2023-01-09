<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
#[ORM\Table('reservation')]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer", nullable: false)]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: "student", nullable: false)]
    private ?Student $student = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: false)]
    private ?\DateTime $created = null;

    #[ORM\ManyToMany(targetEntity: Book::class, mappedBy: 'reservations')]
    #[ORM\JoinTable(name: "reservation_book")]
    #[ORM\JoinColumn(name: "reservation")]
    #[ORM\InverseJoinColumn(name: "book")]
    private Collection $books;

    /**
     * Entity constructor must have no parameters
     */
    public function __construct() {
        $this->created = new \DateTime();
        $this->books = new ArrayCollection();
    }

    /**
     * @return int|null unique id from the database
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @return Student student object for current reservation
     */
    public function getStudent(): Student {
        return $this->student;
    }

    /**
     * @param Student $student student object for current reservation
     * @return Reservation current reservation object
     */
    public function setStudent(Student $student): Reservation {
        $this->student = $student;
        return $this;
    }

    /**
     * @return \DateTime the time when the reservation was created
     */
    public function getCreated(): \DateTime {
        return $this->created;
    }

    /**
     * @param \DateTime $created the creation time of the reservation
     */
    public function setCreated(\DateTime $created): void {
        $this->created = $created;
    }

    /**
     * @return Collection<Book> all books in this reservation
     */
    public function getBooks(): Collection {
        return $this->books;
    }

    /**
     * @param Book $book book to add to the reservation
     * @return Reservation current reservation object
     */
    public function addBook(Book $book): Reservation {
        if (!$this->books->contains($book)) {
            $this->books->add($book);
            $book->addReservation($this);
        }
        return $this;
    }

    /**
     * @param Book $book book to remove from the reservation
     * @return Reservation current reservation object
     */
    public function removeBook(Book $book): Reservation {
        if ($this->books->contains($book)) {
            $this->books->removeElement($book);
            $book->removeReservation($this);
        }
        return $this;
    }

}