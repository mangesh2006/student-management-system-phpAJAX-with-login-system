<?php

include "user_db.php";

$input = file_get_contents("php://input");
$decode = json_decode($input, true);

$sql = "Select * from users where username = '" . $decode['user'] . "'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $hash = password_hash($decode['password'], PASSWORD_DEFAULT);
    $update = "Update users set password = '$hash' where username = '" . $decode['user'] . "'";
    $update_result = mysqli_query($conn, $update);

    if ($update_result) {
        echo json_encode(['reset' => 'success']);
    } else {
        echo json_encode(['reset' => 'error']);
    }
} else {
    echo json_encode(['reset' => 'failed']);
}
