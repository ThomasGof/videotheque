<?php
require_once "autoloader.php";
if(isset($_POST['searchFilm']) && !empty($_POST['searchFilm'])){
    Film::autoFilm($_POST['searchFilm']);
}