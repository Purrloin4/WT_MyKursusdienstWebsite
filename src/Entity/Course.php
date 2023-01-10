<?php

namespace App\Entity;

class Course {
    private ?string $id = null;
    private int $fase;
    private string $name;
    private Staff $teacher;

    /**
     * @param string $name course name
     * @param int $fase fase in which the course is given
     * @param Staff $teacher staff member responsible for the course
     */
    public function __construct(string $name, int $fase, Staff $teacher) {
        $this->name = $name;
        $this->fase = $fase;
        $this->teacher = $teacher;
    }

    /**
     * @return string|null unique id from the database
     */
    public function getId(): ?string {
        return $this->id;
    }

    /**
     * @param string|null $id unique id from the database
     * @return Course current course object
     */
    protected function setId(?string $id): Course {
        $this->id = $id;
        return $this;
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

}