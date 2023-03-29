<?php


require_once 'php/models/Student.php';

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    if (!empty($email)) {
        // check if the email address is in the database
        $student = Student::getStudentFromEmail($email);
        if ($student) {
            // email address was found in the database
            $response = array(
                'status' => 'success',
                'message' => 'Email found, welcome back!'
            );
        } else {
            // email address was not found in the database
            $response = array(
                'status' => 'failure',
                'message' => 'Error: email not found'
            );
        }
    } else {
        // no email address was entered
        $response = array(
            'status' => 'error',
            'message' => 'Error: no email entered'
        );
    }

    // return the response as a JSON encoded string
    echo json_encode($response);
}
