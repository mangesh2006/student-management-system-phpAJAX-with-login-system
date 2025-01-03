<?php
include 'student_db.php';

$rollno = $_GET['rollno'];

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    $sql = "DELETE FROM students WHERE rollno = '" . $rollno . "'";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(['delete' => 'success']);
    } else {
        echo json_encode(['delete' => 'failed']);
    }
}
