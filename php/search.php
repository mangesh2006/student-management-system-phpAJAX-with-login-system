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

$username = 'root';
$password = '';
$database = 'students';
$hostname = 'localhost';

$conn = mysqli_connect($hostname, $username, $password, $database);
$search = $_GET['search'];

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    $sql = "SELECT rollno, name, mobileno, course, semester FROM students WHERE user = '" . $_SESSION['username'] . "' AND (name LIKE '%$search%' or rollno LIKE '%$search%' or course LIKE '%$search%')";
    $result = mysqli_query($conn, $sql);
    $data = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }
    echo json_encode($data);
}
