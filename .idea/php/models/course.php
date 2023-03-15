<?php

require_once 'php/DataBase.php';
require_once 'Staff.php';

class course
{
    private string $id;
    private string $name;
    private Staff $staff;
    private int $fase;

    /**
     * @param string $name
     * @param Staff $staff
     * @param int $fase
     */
    public function __construct($name, Staff $staff, $fase)
    {
        $this->name = $name;
        $this->staff = $staff;
        $this->fase = $fase;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
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
     * @return Staff
     */
    public function getStaff()
    {
        return $this->staff;
    }

    /**
     * @param Staff $staff
     */
    public function setStaff($staff)
    {
        $this->staff = $staff;
    }

    /**
     * @return int
     */
    public function getFase()
    {
        return $this->fase;
    }

    /**
     * @param int $fase
     */
    public function setFase($fase)
    {
        $this->fase = $fase;
    }

    static function getcoursebyID(String $id) : course
    {
        $db = (new Database())->getConnection();
        $stm = $db->prepare('SELECT id, name, staff, fase FROM course WHERE id like :id');
        $stm->execute([
            'id' => $id
        ]);

        while ($item = $stm->fetch()) {
            $course = new course($item['name'], $item['staff'], $item['fase']);
            $course->setId($item['id']);
        };
        return $course;
    }

    static function getallcourses() : array
    {
        $db = (new Database())->getConnection();
        $stm = $db->prepare('SELECT id, name, staff, fase FROM course');
        $stm->execute();

        $courses = [];
        while ($item = $stm->fetch()) {
            $staff = Staff::getStaffByID($item['staff']);
            $course = new course($item['name'], $staff, $item['fase']);
            $course->setId($item['id']);
            $courses[] = $course;
        };
        return $courses;
    }

    static function getCoursesByFase(int $fase) : array
    {
        $db = (new Database())->getConnection();
        $stm = $db->prepare('SELECT id, name, staff, fase FROM course WHERE fase like :fase');
        $stm->execute([
            'fase' => $fase
        ]);

        $courses = [];
        while ($item = $stm->fetch()) {
            $staff = Staff::getStaffByID($item['staff']);
            $course = new course($item['name'], $staff, $item['fase']);
            $course->setId($item['id']);
            $courses[] = $course;
        };
        return $courses;
    }

    public function save() : course
    {
        $db = (new Database())->getConnection();
        $statement = $db->prepare("INSERT INTO course (name, staff, fase) VALUES (:name, :staff, :fase)");
        $statement->execute([
            'name' => $this->getName(),
            'staff' => $this->getStaff(),
            'fase' => $this->getFase()
        ]);

        $this->id = $db->lastInsertId();

        return $this;
    }




}