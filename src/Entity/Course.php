<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
#[ORM\Table('course')]
class Course
{
    #[ORM\Id]
    #[ORM\Column(type: "string", nullable: false)]
    private ?string $id = null;

    #[ORM\Column(type: "integer", nullable: false)]
    private ?int $fase = null;

    #[ORM\Column(type: "string", length: 50, nullable: false)]
    private ?string $name = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: "staff",nullable: false)]
    private ?Staff $teacher = null;

    #[ORM\OneToMany(mappedBy: 'course', targetEntity: Book::class)]
    private Collection $books;

    /**
     * Entity constructor must have no parameters
     */
    public function __construct() {
        $this->books = new ArrayCollection();
    }

    /**
     * @return string|null unique id from the database
     */
    public function getId(): ?string {
        return $this->id;
    }

    /**
     * @return int fase in which the course is given
     */
    public function getFase(): int {
        return $this->fase;
    }

    /**
     * @param int $fase fase in which the course is given
     * @return Course current course object
     */
    public function setFase(int $fase): Course {
        $this->fase = $fase;
        return $this;
    }

    /**
     * @return string course name
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name course name
     * @return Course current course object
     */
    public function setName(string $name): Course {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Staff staff member responsible for the course
     */
    public function getTeacher(): Staff {
        return $this->teacher;
    }

    /**
     * @param Staff $teacher staff member responsible for the course
     * @return Course current course object
     */
    public function setTeacher(Staff $teacher): Course {
        $this->teacher = $teacher;
        return $this;
    }

    /**
     * @return Collection<Book> all books in this course
     */
    public function getBooks(): Collection {
        return $this->books;
    }

    /**
     * @param Book $book book to add to this course
     * @return Course current course object
     */
    public function addBook(Book $book): Course {
        if (!$this->books->contains($book)) {
            $this->books->add($book);
            $book->setCourse($this);
        }
        return $this;
    }

    /**
     * @param Book $book book to be removed from this course
     * @return Course current course object
     */
    public function removeBook(Book $book): Course {
        if ($this->books->contains($book)) {
            $this->books->removeElement($book);
            // set the owning side to null (unless already changed)
            if ($book->getCourse() === $this) {
                $book->setCourse(null);
            }
        }
        return $this;
    }

}