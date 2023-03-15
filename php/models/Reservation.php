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


    public function save(): reservation
    {
        $db = (new Database())->getConnection();
        $statement = $db->prepare("INSERT INTO reservation (student, created) VALUES (:student_id, :date)");
        $statement->execute([
            'student_id' => $this->getStudentId(),
            'book_id' => $this->getBookId(),
            'date' => $this->getDate()
        ]);

        $this->id = $db->lastInsertId();


        $statement = $db->prepare("INSERT INTO reservation_book (reservation, book) VALUES (:reservation_id, :book_id)");

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
