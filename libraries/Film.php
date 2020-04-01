
<?php
require_once "autoloader.php";

class Film extends Model{


    public static function displayShortFilm($limite){
        $rq = Model::select('id_movie, title, year, genres, plot','movies_full',' ORDER BY title',' LIMIT '.$limite.',20','','');
        $shortFilmResult = [];

        while($result = $rq -> fetch(PDO::FETCH_ASSOC)){
            array_push($shortFilmResult,$result); 
        }
        return $shortFilmResult;
    }


    public static function displayFilm($id){
        $rq = Model::select("*","movies_full","","","WHERE id_movie=?",[$id]);
        $result = $rq -> fetch(PDO::FETCH_ASSOC);
        return $result;
    }


    public static function simple_userForm() {
    // recuperation de genres et year pour select
    $rq = Model::select('genres,year', 'movies_full', '', '', '', '');
    $listeGenres = [];
    $listeYear = [];
    while ($result = $rq->fetch(PDO::FETCH_ASSOC)) {
      $genreTmp = array_map('trim', explode(',', $result['genres']));
      $listeGenres = array_merge($genreTmp, $listeGenres);
      array_push($listeYear, $result['year']);
    }
    $listeGenres = array_unique($listeGenres);
    $listeYear = array_unique($listeYear);
    unset($listeGenres[array_search('N/A', $listeGenres)]);
    unset($listeGenres[array_search('', $listeGenres)]);
    sort($listeGenres);
    sort($listeYear);
    $ureRef = ['title', 'genres', 'year', 'directors', 'cast', 'writers'];
    $userSelection = [];
    foreach ($ureRef as $value) {
      if (isset($_POST[$value]) && !empty($_POST[$value])) {
        $rq = Model::select('id_movie,title,genres,year,directors,cast,writers','movies_full', '', '', "WHERE $value LIKE ?", ["%" . $_POST[$value] . "%"]);
        while ($result = $rq->fetch(PDO::FETCH_ASSOC)) {
          array_push($userSelection,$result['id_movie']);
        }
      }
    }
    return [$listeGenres, $listeYear, $userSelection];
  }
}

