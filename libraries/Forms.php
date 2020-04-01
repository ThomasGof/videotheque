<?php
require_once "autoloader.php";

class Forms
{
  public static function regForm()
  {
    $dataReg = "";
    $imgFile = "";
    if (isset($_POST['formReg']) && !empty($_POST['formReg'])){
      $dataReg = $_POST;
      if(!empty($_FILES['avatar'])){
          $imgFile = $_FILES['avatar'];
      }
    }
    if ($dataReg !== "") {
      //insertion avec formulaire d'inscription protégé
      $erreur = '';
      $urlAvatar = '';
      //filtres
      // plus rapide : $dataReg = array_map('htmlspecialchars', $dataReg);
      foreach ($dataReg as $key => $value) {
        $dataReg[$key] = htmlspecialchars($value, ENT_QUOTES, "UTF-8");
        if (empty($value)) {
          $erreur .= "<div>Le champ $key est vide.</div>";
        }
      }
      if ($dataReg['password1'] !== $dataReg['password2'] && !empty($dataReg['password1'])) {
        $erreur .= "<div>Vos mots de pass ne sont pas identiques.</div>";
      }
      if (filter_var($dataReg['email'], FILTER_VALIDATE_EMAIL)) {
        $selectEmail = Model::select('email','users','',''," WHERE email=?",[$dataReg['email']]);
        $result = $selectEmail->rowCount();
        if ($result !== 0) {
          $erreur .= "<div>Vous êtes déjà enregistré sur ce site.</div>";
        }
      } else {
          $erreur .= "<div>Le format de votre email n'est pas valide.</div>";
      }
      // detection image
      if (!empty($imgFile) && $imgFile['size']>0) {
        $urlAvatar = Image::imgResize($imgFile,300,'assets/img/');
      }
      if ($erreur === ""){
        Model::insert(
          'pseudo,email,password,avatar,reg_Date',
          'users',
          '?,?,?,?,?',
          [$dataReg['pseudo'],$dataReg['email'],hash('sha256',$dataReg['password1']),$urlAvatar,date("Y-m-d")]
        );
        $_SESSION['pseudo']=$dataReg['pseudo'];
        $_SESSION['avatar']=$urlAvatar;
        header("Location: index.php");
      } else {
        echo $erreur;
      }
    }
  }
  public static function connectForm()
  {
    $dataConnect = "";
    if (isset($_POST['formConnect']) && !empty($_POST['formConnect'])){
        $dataConnect = $_POST;
    }
    if($dataConnect !== ""){
    $erreur = "";
      if (!empty($dataConnect['email']) && !empty($dataConnect['password'])){
        $email = $dataConnect['email'];
        $password = hash('sha256',$dataConnect['password']);
        $rq = Model::select('*','users','',''," WHERE email=? AND password=?",[$email,$password]);
        $active = $rq->rowCount();      
      } else {
        $erreur .= "<div>Une erreur s'est produite lors de votre saisie.</div>";
      }
      if($active !== 0){
        // reussite -> enregister dans $_SESSION les données de l'utilisateur
        $result = $rq -> fetch(PDO::FETCH_ASSOC);
        $_SESSION['pseudo']=$result['pseudo'];
        $_SESSION['avatar']=$result['avatar'];
        header("Location: index.php");
      } else {
        $erreur .= "<div>Une erreur s'est produite lors de votre saisie.</div>";
      }
      echo $erreur;
    }
  }
}
