<?php

require_once 'php/DataBase.php';

class staff
{
    private ?int $id = null;
    private string $name;
    private string $email;

    /**
     * @param string $name
     * @param string $email
     */
    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
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

    public function save() : staff
    {
        $db = (new Database())->getConnection();
        $statement = $db->prepare("INSERT INTO staff (name, email) VALUES (:name, :email)");
        $statement->execute([
            'name' => $this->getName(),
            'email' => $this->getEmail()
        ]);

        $this->id = $db->lastInsertId();

        return $this;
    }

    static function getstaffbyid($id)
    {
        $db = (new Database())->getConnection();
        $stm = $db->prepare('SELECT id, name, email FROM staff WHERE id like :id');
        $stm->execute([
            'id' => $id
        ]);

        while ($item = $stm->fetch()) {
            $staff = new staff($item['id'], $item['name'], $item['email']);
            $staff->setId($item['id']);
        };
        return $staff;
    }


}