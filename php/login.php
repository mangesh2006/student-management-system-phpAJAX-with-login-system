<?php
include 'user_db.php';

$input = file_get_contents('php://input');
$decode = json_decode($input, true);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $decode['username'];
    $pass = $decode['password'];
    $remember = isset($decode['remember']) ? $decode['remember'] : false;

    $sql = "SELECT username, password FROM users WHERE username = '$user'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($pass, $row['password'])) {
            session_start();
            $_SESSION['username'] = $row['username'];

            if ($remember) {
                setcookie('username', $row['username'], 0, '/');
            }
            echo json_encode(['login' => 'success']);
        } else {
            echo json_encode(['login' => 'failed']);
        }
    } else {
        echo json_encode(['login' => 'failed']);
    }
}
