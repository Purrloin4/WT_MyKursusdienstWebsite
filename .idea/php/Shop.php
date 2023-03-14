<?php

require_once 'DataBase.php';



class Shop {
private $steps;


public function __construct($steps) {
$this->steps = $_SESSION['steps'] ?? 1;
}

public function storeOrder($data) {
$this->stepData[0] = [
'fase' => $data['fase'],
'email' => $data['email']
];
}

public function processStep($step, $data) {
$this->stepData[$step] = $data;
}

public function getStep($step) {
return $this->stepData[$step];
}

    public function getCourses() {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "SELECT * FROM course";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBooks() {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "SELECT * FROM book";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}