<?php

namespace App\Entity;

class Student {
    private ?int $id = null;
    private string $email;

    /**
     * @param string $email students email
     */
    public function __construct(string $email) {
        $this->email = $email;
    }

    /**
     * @return int|null unique id from the database
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @param int|null $id unique id from the database
     * @return Student current student object
     */
    protected function setId(?int $id): Student {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string students email
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * @param string $email students email
     * @return Student current student object
     */
    public function setEmail(string $email): Student {
        $this->email = $email;
        return $this;
    }

}