<?php

namespace Models\Controllers;

use Models\UserLogin\LoginUser;

class LoginController
{
    /**
     * Summary of handleRequest
     * @return mixed
     */
    public function handleRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();

            $username = $_POST['email'];
            $password = $_POST['password'];

            $userLogin = new LoginUser();
            $userLogin->login($username, $password);
        }
    }
}