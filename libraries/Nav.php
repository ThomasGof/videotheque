<?php
class Nav {
    public static function displayNav(){
        session_start();
        if(isset($_GET['deconnect']) && $_GET['deconnect']){
            $_SESSION = [];
            session_destroy();   
            session_unset();
            header("Location: index.php");
        }
    }
}