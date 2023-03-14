<?php

require_once 'DataBase.php';
require_once 'student.php';

class reservation
{
    private ?int $id;
    private student $student;
    private DateTime $date;
    private array $books;

    public function __construct(student $student, array $books)
    {
        $this->student = $student;
        $this->books = $books;
        $this->date = new DateTime();
    }


    public function save(): reservation
    {
        $db = (new Database())->getConnection();
        $statement = $db->prepare("INSERT INTO reservation (student_id, date) VALUES (:student_id, :date)");
        $statement->execute([
            'student_id' => $this->getStudentId(),
            'book_id' => $this->getBookId(),
            'date' => $this->getDate()
        ]);

        $this->id = $db->lastInsertId();


        $statement = $db->prepare("INSERT INTO reservation_book (reservation_id, book_id) VALUES (:reservation_id, :book_id)");
        $statement->execute([
            'reservation_id' => $this->getId(),
            'book_id' => $book->getId()
        ]);


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
     * @return int
     */
    public function getStudentId()
    {
        return $this->student_id;
    }

    /**
     * @param int $student_id
     */
    public function setStudentId($student_id)
    {
        $this->student_id = $student_id;
    }

    /**
     * @return int
     */
    public function getBookId()
    {
        return $this->book_id;
    }

    /**
     * @param int $book_id
     */
    public function setBookId($book_id)
    {
        $this->book_id = $book_id;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }
}
