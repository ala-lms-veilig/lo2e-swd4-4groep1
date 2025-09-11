<?php 

namespace Controllers\AccountCheck;

use Models\Controllers\LoginController;

class AcountControllor {

    public function __construct() {
    }

    public function showAccountPage($loginCheck) {
        // Implement the function logic here
        return "Account Page for user";
    }

    public function CheckLogin() {
        $loginCheck = new LoginController();
  
    }
}