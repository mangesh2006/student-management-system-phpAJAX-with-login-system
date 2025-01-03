<?php
include 'user_db.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Content-Type: application/json');

$input = file_get_contents('php://input');
$decoded = json_decode($input, true);

$user = $decoded['username'];
$pass = $decoded['password'];
$email = $decoded['email'];

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    $check = "SELECT username FROM users WHERE username = '$user'";
    $check_result = mysqli_query($conn, $check);
    if (!($check_result && mysqli_num_rows($check_result) > 0)) {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, password) VALUES ('$user', '$email', '$hash')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo json_encode(['signup' => 'success']);
        } else {
            echo json_encode(['signup' => 'failed', 'message' => 'Error in signup']);
        }
    } else {
        echo json_encode(['signup' => 'failed', 'message' => 'User already exists']);
    }
}
