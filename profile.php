<?php
include 'php/auto_login.php';
include 'php/user_db.php';
include 'php/session.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    $sql = "SELECT email FROM users WHERE username = '" . $_SESSION['username'] . "'";
    $result = mysqli_query($conn, $sql);
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    setcookie('username', '', time() - 3600, '/');
    header('Location: login.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container">
        <div class="profile">
            <h2><a href="welcome.php"><i class="bi bi-arrow-left-circle"></i></a>Profile <i class="bi bi-person-circle"></i></h2>
            <div class="profile-info">
                <h3><i class="bi bi-person-fill"></i> Username</h3>
                <h3><?php echo $_SESSION['username']; ?></h3>
            </div>
            <div class="profile-info">
                <h3><i class="bi bi-envelope-fill"></i> Email</h3>
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    echo '<h3>' . $row['email'] . '</h3>';
                }
                ?>
            </div>
            <div class="profile-info">
                <form method="POST">
                    <button class="btn" type="submit" id="logout" name="logout"><i class="bi bi-box-arrow-left"></i> Log-out</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
