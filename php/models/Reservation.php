<?php


require_once 'php/DataBase.php';
require_once 'php/models/Student.php';

class Reservation
{
    private ?int $id;
    private Student $student;
    private DateTime $date;
    private array $books;

    public function __construct(Student $student, array $books)
    {
        $this->student = $student;
        $this->books = $books;
        $this->date = new DateTime();
    }


    public function save(): Reservation
    {
        $db = (new Database())->getConnection();
        $statement = $db->prepare("INSERT INTO reservation (student, created) VALUES (:student_id, :date)");
        $statement->execute([
            'student_id' => $this->student->getId(),
            'date' => $this->date->format("Y-m-d H:i:s")
        ]);

        $this->id = $db->lastInsertId();


        $statement = $db->prepare("INSERT INTO reservation_book (reservation, book) VALUES (:reservation, :book)");

        foreach ($this->books as $book) {
            $statement->execute([
                ':reservation' => $this->id,
                ':book' => $book->getId()
            ]);
        }


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
     * @return Student
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * @param Student $student
     */
    public function setStudent($student)
    {
        $this->student = $student;
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
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     */
    public function setDate(DateTime $date)
    {
        $this->date = $date;
    }
}
