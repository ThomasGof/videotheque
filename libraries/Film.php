
<?php
require_once "autoloader.php";
class Film extends Model{
    public static function displayShortFilm($limite){
        $rq = Model::select('id_movie, title, year, genres, plot','movies_full',' ORDER BY title',' LIMIT '.$limite.',15','','');
        $shortFilmResult = [];
        $nbFilm = 5780;
        $totalPage = ceil($nbFilm/15);
        $nbPage = ceil($limite/15)+1;

        while($result = $rq -> fetch(PDO::FETCH_ASSOC)){
            array_push($shortFilmResult,$result); 
        }
        return $shortFilmResult;
        return $totalPage;
        return $nbPage;
    }
    public static function displayFilm($id){
        $rq = Model::select("*","movies_full","","","WHERE id_movie=?",[$id]);
        $result = $rq -> fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function displayShortFilmUser($ids){


        $shortFilmResult = [];
        foreach($ids as $value){
            $rq = Model::select('id_movie, title, year, genres, plot','movies_full','','','WHERE id_movie=?',[$value]);
            $result = $rq -> fetch(PDO::FETCH_ASSOC);
            array_push($shortFilmResult,$result);
        }
        return $shortFilmResult;
    }
    public static function simple_userForm()
    {
        // recuperation de genres et year pour select
        $rq = Model::select('genres,year', 'movies_full', '', '', '', '');
        $listeGenres = [];
        $listeYear = [];
        // Utilisation de function php 
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
        // traitement des données POST
        $ureRef = ['title', 'genres', 'year', 'directors', 'cast', 'writers'];
        $userSelection = [];

        foreach ($ureRef as $value) {
            if (isset($_POST[$value]) && !empty($_POST[$value])) {
                $rq = Model::select('id_movie,title,genres,year,directors,cast,writers', 'movies_full', '', '', "WHERE $value LIKE ?", ["%" . $_POST[$value] . "%"]);
                while ($result = $rq->fetch(PDO::FETCH_ASSOC)) {
                    array_push($userSelection, $result['id_movie']);
                }
            }
        }

        return [$listeGenres, $listeYear, $userSelection];
    }
    public static function autoFilm($searchFilm){
        $searchFilm = "%".$searchFilm."%";
        $rq = Model::select('title,id_movie','movies_full','','','WHERE title LIKE ?',[$searchFilm]);
        while ($result = $rq->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='fixed'><a href='movie.php?id=".$result['id_movie']."'>".$result['title']."</a></div>";
        }
    }

}

