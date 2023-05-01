<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
class Course
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'course', targetEntity: Book::class)]
    private Collection $books;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name:"staff", nullable: false)]
    private ?Staff $teacher = null;


    public function __construct()
    {
        $this->books = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return Collection<int, Book>
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books->add($book);
            $book->setCourse($this);
        }

        return $this;
    }

    public function removeBook(Book $book): self
    {
        if ($this->books->removeElement($book)) {
            // set the owning side to null (unless already changed)
            if ($book->getCourse() === $this) {
                $book->setCourse(null);
            }
        }

        return $this;
    }

    public function getTeacher(): ?Staff
    {
        return $this->teacher;
    }

    public function setTeacher(?Staff $teacher): self
    {
        $this->teacher = $teacher;

        return $this;
    }

}
