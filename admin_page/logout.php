<?php
session_start();

if (isset($_SESSION['login'])) {
    unset($_SESSION['login']);
    unset($_SESSION['user']);
}

header('Location: login.php');
exit();
