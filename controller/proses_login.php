<?php
session_start();

// Kredensial sederhana (dalam praktiknya, gunakan database)
$valid_username = 'admin';
$valid_password = 'admin123'; // Dalam praktik, password di-hash

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['username'] = $username;
        header('Location: ../indexs.php');
        exit;
    } else {
        header('Location: ../login.php?error=1');
        exit;
    }
} else {
    header('Location: ../login.php');
    exit;
}