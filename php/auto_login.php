<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username']) && isset($_COOKIE['username'])) {
    $user = $_COOKIE['username'];
    $username = 'root';
    $password = '';
    $database = 'users';
    $hostname = 'localhost';

    $conn = mysqli_connect($hostname, $username, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT username FROM users WHERE username = '$user'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
    }

    mysqli_close($conn);
}
