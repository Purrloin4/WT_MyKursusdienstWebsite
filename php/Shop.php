<?php

session_start();


require_once 'php/DataBase.php';
require_once 'php/models/Course.php';
require_once 'php/models/Book.php';
require_once 'php/models/Reservation.php';
require_once 'php/models/Student.php';


class Shop
{
    private $steps;


    public function __construct()
    {
        $this->steps = $_SESSION['steps'] ?? 1;
    }

    public function getStep()
    {
        return $this->steps;
    }

    public function processStep(array $data): void
    {
        $session_data = $_SESSION['order_data'] ?? array();
        $session_data = array_merge($session_data, $data);
        foreach ($data as $key => $value) {
            $session_data[$key] = $value;
        }
        $_SESSION['order_data'] = $session_data;

        if ($this->steps == 3) {
            $this->storeOrder($session_data);
            $this->steps = 1;
        } else {
            $this->steps++;
        }
        $_SESSION['steps'] = $this->steps;
    }


    public function getBooksPossible(): array
    {
        $books = [];
        //check if fase is set and step is > 1
        if (isset($_SESSION['order_data']['fase']) && $this->steps > 1) {
            $fase = $_SESSION['order_data']['fase'];
            //get book from courseID and courseID from fase
            $courses = course::getCoursesByFase($fase);
            foreach ($courses as $course) {
                $books = array_merge($books, book::getBooksByCourseId($course->getId()));
            }
        }
        return $books;
    }

    public function getBooksSelected(): array
    {
        $books = [];
        if (isset($_SESSION['order_data']['books'])) {
            $bookIds = $_SESSION['order_data']['books'];
            foreach ($bookIds as $bookId) {
                $books[] = book::getBookById($bookId);
            }
        }
        return $books;
    }

    public function storeOrder(array $data): void
    {
        $student = Student::getStudentFromEmail($data['email']);
        if ($student == null) {
            $student = new Student($data['email']);
            $student = $student->save();
        }
        $books = $this->getBooksSelected();
        $order = new Reservation($student, $books);
        $order->save();
    }

}