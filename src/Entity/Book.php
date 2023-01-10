<?php

namespace App\Entity;

class Book {
    private ?int $id = null;
    private string $title;
    private ?string $isbn;
    private bool $obliged;
    private Course $course;

    /**
     * @param string $title book title
     * @param string|null $isbn book ISBN number
     * @param Course $course course in which the book is used
     * @param bool $obliged indication if book is obliged or not, defaults to not obliged if not given
     */
    public function __construct(string $title, ?string $isbn, Course $course, bool $obliged = false) {
        $this->title = $title;
        $this->isbn = $isbn;
        $this->obliged = $obliged;
        $this->course = $course;
    }

    /**
     * @return int|null unique id from the database
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @param int|null $id unique id from the database
     * @return Book current book object
     */
    protected function setId(?int $id): Book {
        $this->id = $id;
        return $this;
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
     * @param Course $course course in which the book is used
     * @return Book current book object
     */
    public function setCourse(Course $course): Book {
        $this->course = $course;
        return $this;
    }

}