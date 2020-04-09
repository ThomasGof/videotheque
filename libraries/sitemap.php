<?php

$racine = __DIR__;

$newRacine = str_replace("\libraries", "", $racine);
$siteMap = scandir($newRacine, SCANDIR_SORT_ASCENDING);
foreach ($siteMap as $value ) {
    $info = new SplFileInfo($value);
    if ( ($value === 'connect.php') && (isset($_SESSION['pseudo'])) ) {
        $value = 'index.php?deconnect=true';
        $ecrit ='Deconnectez-Vous';
    } else if ($value === 'connect.php') {
        $ecrit ='Connectez-Vous';
    }
    if ($value === 'index.php') {$ecrit ='Tous les films';}
    if (($value === 'registration.php') && (isset($_SESSION['pseudo'])) ) {
        $value = '';
        $ecrit ='';
    }  else if ($value === 'registration.php') {
        $ecrit ='Incrivez-Vous';
    }
    if ($value === 'user_pref.php') {$ecrit ='Mes films préférés';}
    if ( ($info->getExtension() === 'php') && ($value !== 'admin.php') && ($value !== 'movie.php') && ($value !== '') ) {
        // $ecrit = str_replace(".php","",$value);
        echo "<a href='$value'>$ecrit</a>";
    }
}

if(is_file(__DIR__)){
    echo "je suis un fichier";
} 