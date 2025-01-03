<?php
include 'php/auto_login.php';
include 'php/session.php';

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
    <link rel="stylesheet" href="welcome.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <nav class="navbar">
        <h1><i class="bi bi-person-circle"></i> <?php echo $_SESSION['username']; ?> <i class="bi bi-caret-down-fill" style="font-size: 17px;cursor: pointer;" id="dropdown-menu"></i></h1>
        <ul>
            <form method="POST">
                <button type="submit" id="logout" name="logout"><i class="bi bi-box-arrow-left"></i> Log-out</button>
            </form>
        </ul>
    </nav>

    <div class="container">
        <div class="form">
            <h2 style="margin-top: 0px;">Add Student</h2>
            <div id="success_message" class="success"></div>
            <div id="error_message" class="error"></div>
            <div class="input-field">
                <input type="text" name="name" id="rollno" autocomplete="off" required>
                <label for="rollno"><i class="bi bi-person-vcard"></i> Student Rollno</label>
            </div>
            <div class="input-field">
                <input type="text" name="name" id="name" autocomplete="off" required>
                <label for="name"><i class="bi bi-person"></i> Student Name</label>
            </div>
            <div class="input-field">
                <input type="text" name="mobileno" id="mobileno" autocomplete="off" required>
                <label for="mobileno"><i class="bi bi-telephone"></i> Student Mobile No.</label>
            </div>
            <div class="input-field">
                <input type="text" name="course" id="course" autocomplete="off" required>
                <label for="course"><i class="bi bi-book"></i> Student Course</label>
            </div>
            <div class="input-field">
                <input type="text" name="semester" id="semester" autocomplete="off" required>
                <label for="semester"><i class="bi bi-list-ol"></i> Student Semester</label>
            </div>
        </div>
        <button type="submit" id="add_btn"><i class="bi bi-person-add"></i> Add Student</button>
    </div>

    <div class="dropdown">
        <div class="dropdown-content" id="dropdown">
            <a href="profile.php"><i class="bi bi-person-lines-fill"></i> Profile</a>
            <a href="record.html"><i class="bi bi-table"></i> Records</a>
        </div>
    </div>
    <script src="student.js"></script>
</body>

</html>
