<?php

require_once 'Database.php';

$db = (new Database())->getConnection();
$shop = new Shop(3);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['step1'])) {
        $shop->storeOrder($_POST);
    } else {
        $shop->processStep($_POST['step'], $_POST);
    }
}

$step1Data = $shop->getStep(1);
$step2Data = $shop->getStep(2);
$step3Data = $shop->getStep(3);
class Shop {
private $steps;
private $stepData;

public function __construct($steps) {
$this->steps = $steps;
$this->stepData = array_fill(0, $steps, []);
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