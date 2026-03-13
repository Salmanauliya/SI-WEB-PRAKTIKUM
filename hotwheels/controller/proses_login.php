<?php
session_start();

$valid_username = 'admin';
$valid_password = 'admin123'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $valid_username && $password === $valid_password) {

        $_SESSION['username'] = $username;

        if (isset($_POST['remember'])) {
 
            setcookie('remember_username', $username, time() + (86400 * 7), "/");
        } else {

            if (isset($_COOKIE['remember_username'])) {
                setcookie('remember_username', '', time() - 3600, "/");
            }
        }

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