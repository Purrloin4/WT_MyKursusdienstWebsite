<?php

require_once 'php/DataBase.php';

class Student
{
    private ?int $id = null;
    private string $email;

    public function __construct(String $email)
    {
        $this->email = $email;
    }

    static function getStudentFromEmail(string $email): ?Student
    {
        $db = (new Database())->getConnection();
        $stm = $db->prepare('SELECT id, email FROM student WHERE email like :email');
        $stm->execute([
            'email' => $email
        ]);

        while ($item = $stm->fetch()) {
            $student = new Student($item['email']);
            $student->setId($item['id']);
        };
        return $student;
    }

    public function save(): Student
    {
        $db = (new Database())->getConnection();
        $statement = $db->prepare("INSERT INTO student (email) VALUES (:email)");
        $statement->execute([
            'email' => $this->getEmail()
        ]);

        $this->id = $db->lastInsertId();

        return $this;
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

}


