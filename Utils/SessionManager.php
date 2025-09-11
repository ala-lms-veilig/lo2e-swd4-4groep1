<?php 
namespace BeveiligingApp\Utils;


class SessionManager
{
    public static function startSess()
    { 
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
    }
    }

    public static function isLoggedIn(){
        
    }

}



