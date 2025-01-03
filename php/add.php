<?php
include 'auto_login.php';
include 'student_db.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username']) && !isset($_COOKIE['username'])) {
    header('Location: login.html');
    exit();
}

if (isset($_COOKIE['username']) && !isset($_SESSION['username'])) {
    include 'auto_login.php';
}

if (!isset($_SESSION['username'])) {
    header('Location: login.html');
    exit();
}

$input = file_get_contents("php://input");
$decode = json_decode($input, true);

$rollno = $decode['rollno'];
$name = $decode['name'];
$mobileno = $decode['mobileno'];
$course = $decode['course'];
$semester = $decode['semester'];
$user = $_SESSION['username'];

$check = "Select rollno from students where user = '$user'";
$check_result = mysqli_query($conn, $check);

if ($check_result) {
    $sql = "Insert into students values('$rollno', '$name', '$mobileno', '$course', '$semester', '$user')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo json_encode(['add' => 'success']);
    } else {
        echo json_encode(['add' => 'failed']);
    }
} else {
    echo json_encode(['add' => 'exist']);
}
