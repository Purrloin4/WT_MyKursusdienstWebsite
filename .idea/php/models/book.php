<?php

require_once 'php/DataBase.php';
require_once 'course.php';

class book
{
    private int $id;
    private string $title;
    private ?string $isbn;
    private bool $obliged;
    private course $course;

    /**
     * @param string $title
     * @param string|null $isbn
     * @param bool $obliged
     */
    public function __construct($title, $isbn, $obliged, course $course)
    {
        $this->title = $title;
        $this->isbn = $isbn;
        $this->obliged = $obliged;
        $this->course = $course;
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * @param string|null $isbn
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    }

    /**
     * @return course
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * @param course $course
     */
    public function setCourse($course)
    {
        $this->course = $course;
    }



    /**
     * @return bool
     */
    public function isObliged()
    {
        return $this->obliged;
    }

    /**
     * @param bool $obliged
     */
    public function setObliged($obliged)
    {
        $this->obliged = $obliged;
    }


    public static function getBookById($id)
    {
        $db = DataBase::getConnection();
        $stmt = $db->prepare("SELECT * FROM book WHERE id = :id");
        $stmt->execute([':id', $id]);
        while ($item = $stm->fetch()) {
            $course = course::getCourseById($item['course_id']);
            $book = new book($item['title'], $item['isbn'], $item['obliged'], $course);
            $book->setId($item['id']);
        };
        return $book;
    }

    public function getBooksByCourseId($courseId)
    {
        $db = DataBase::getConnection();
        $stmt = $db->prepare("SELECT * FROM book WHERE course_id = :courseId");
        $stmt->execute([':courseId', $courseId]);
        $books = [];
        while ($item = $stm->fetch()) {
            $course = course::getCourseById($item['course_id']);
            $book = new book($item['title'], $item['isbn'], $item['obliged'], $course);
            $book->setId($item['id']);
            $books[] = $book;
        };
        return $books;
    }

    //save
    public function save()
    {
        $db = DataBase::getConnection();
        $stmt = $db->prepare("INSERT INTO book (title, isbn, obliged, course_id) VALUES (:title, :isbn, :obliged, :course_id)");
        $stmt->execute([
            ':title' => $this->getTitle(),
            ':isbn' => $this->getIsbn(),
            ':obliged' => $this->isObliged(),
            ':course_id' => $this->getCourse()->getId()
        ]);
        $this->setId($db->lastInsertId());
    }


}