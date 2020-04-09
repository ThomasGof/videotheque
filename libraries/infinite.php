<?php
require_once 'Film.php';

// skdfgqkjsf
if(isset($_POST['limite']) && !empty($_POST['limite'])){
    $shortFilmResult = Film::displayShortFilm($_POST['limite']);
    include ("../templates/shortMovie.html.php");
}