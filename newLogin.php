<?php

require_once './autoload.php';

use Models\UserLogin\LoginUser;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    $e_mail = $_POST['email'];
    $password = $_POST['password'];

    $userLogin = new LoginUser();
    $userLogin->login($e_mail, $password);
}
?>