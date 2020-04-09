<?php
    require_once "libraries/autoloader.php";
    if ((isset($_GET['limite'])) && (!empty($_GET['limite'])) && ($_GET['limite'] > 0)) {
        $limite = $_GET['limite'];
    } else {
        $limite = 0;
    }
    if ( (!isset($limite2)) && (empty($limite2)) ) {
        $limite2 = 15;
    } 
    if (isset($_POST) && !empty($_POST)) {
        // print_r($_POST);
        $numPage = ($_POST[allerPage]*15)-15;
        header("Location: index.php?limite=".$numPage);
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>video</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.2.6/gsap.min.js"></script>
    <script src="assets/js/mainth.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/lestyle.css" />
</head>
<body>
    <?php
    
    Nav::displayNav();
    include ("templates/nav.html.php");
    $shortFilmResult = Film:: displayShortFilm($limite);
    include ("templates/shortMovie.html.php");
    echo Footer::displayFooter();
    include ("templates/footer.html.php");
    
    ?>
</body>
</html>