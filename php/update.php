<?php
include 'student_db.php';

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    $sql = "UPDATE students SET rollno = '" . $data['rollno'] . "', name = '" . $data['name'] . "', mobileno = '" . $data['mobileno'] . "', course = '" . $data['course'] . "', semester = '" . $data['semester'] . "' WHERE rollno = '" . $data['rollno'] . "'";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(['update' => 'success']);
    } else {
        echo json_encode(['update' => 'failed']);
    }
}
