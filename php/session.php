<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username']) && !isset($_COOKIE['username'])) {
    header('Location: login.html');
    exit();
}

if (isset($_COOKIE['username']) && !isset($_SESSION['username'])) {
    include 'php/auto_login.php';
}

if (!isset($_SESSION['username'])) {
    header('Location: login.html');
    exit();
}
