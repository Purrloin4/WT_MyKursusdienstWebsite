<?php

require_once 'DataBase.php';

class student{
    private ?int $id = null;
    private string $email;

    public function __construct(String $email)
    {
        $this->email = $email;
    }

    static function getStudentFromEmail() : student
    {
        $db = (new Database())->getConnection();
        $stm = $db->prepare('SELECT id, email FROM student WHERE email like :email');
        $stm->execute([
            'email' => $email
        ]);

        while ($item = $stm->fetch()) {
            $student = new student($item['email']);
            $student->setId($item['id']);
        };
        return $student;
    }

    public function save() : student
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

}


