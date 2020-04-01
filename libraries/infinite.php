<?php
require_once 'Film.php';


if(isset($_POST['limite']) && !empty($_POST['limite'])){
    $shortFilmResult = Film::displayShortFilm($_POST['limite']);
    include ("../templates/index.html.php");
}
