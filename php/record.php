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

$data = [];

$sql = "Select rollno, name, mobileno, course, semester from students where user = '" . $_SESSION['username'] . "'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}

echo json_encode($data);
