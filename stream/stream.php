<?php
session_start();
include('../bd/connexionDB.php');

// Récupèration de l'id passer en argument dans l'URL
$id = htmlspecialchars($_GET["id"]);

$afficher_playlist = $DB->prepare("SELECT * FROM videos WHERE AnimeName = ?");
$afficher_playlist->execute(array($id));
$afficher_playlist = $afficher_playlist->fetchAll();


$afficher_first = $DB->prepare("SELECT * FROM videos WHERE AnimeName = ?");
$afficher_first->execute(array($id));
$afficher_first = $afficher_first->fetch();

$afficher_poster = $DB->prepare("SELECT * FROM images WHERE NameAnime  = ?");
$afficher_poster->execute(array($id));
$afficher_poster = $afficher_poster->fetch();

if (!isset($afficher_first['AnimeName'])) {
  header('Location: ../');
  exit;
}

if (isset($_POST['demander'])) {
  if (isset($_SESSION['id'])) {
    if (!isset($relation['id']) && !isset($relation['like_Name'])) {

      $add_list = $DB->prepare("INSERT INTO add_list (id, like_Name) VALUES (?, ?)");
      $add_list->execute(array($_SESSION['id'], $id));
      $add_list = $add_list->fetch();
    } else {

      header('Location: ../auth/profil');
      exit;
    }
  } else {
    header('Location: ../auth/connexion');
    exit;
  }
}

if (isset($_POST['supprimer'])) {
  if (isset($_SESSION['id'])) {
    $remove_list = $DB->prepare("DELETE FROM add_list WHERE id = ? AND like_Name = ?");
    $remove_list->execute(array($_SESSION['id'], $id));
    $remove_list = $remove_list->fetch();
  }
  header('Location: ../auth/profil');
  exit;
}
if (isset($_SESSION['id'])) {
  $relation = $DB->prepare("SELECT *
    FROM add_list 
    WHERE id = ? AND like_Name = ?");
  $relation->execute(array($_SESSION['id'], $id));

  $relation = $relation->fetch();
}



?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <!--title-->
  <title>Stream - Wizanimes</title>
  <meta property="og:title" content="Wizanimes - #1 du streaming d'animés">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.0/css/all.css">

  <!--Canonical-->
  <link rel="canonical" href="https://wizanimes.com"> <!-- C'est l'url de la page ex: https://wizanimes.com/streaming/naruto si l'url c'est ça-->
  <meta property="og:url" content="https://wizanimes.com"> <!-- Même chose ici-->

  <!--favicon icon-->
  <link rel="apple-touch-icon" sizes="180x180" href="../image/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../image/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../image/favicon/favicon-16x16.png">
  <link rel="manifest" href="../image/favicon/site.webmanifest">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">

  <!--description-->
  <meta name="description" content="Met une descripton de la page">
  <meta property="og:description" content="Tu la remets ici aussi">

  <!--SEO-->
  <meta name="site_name" content="Wizanimes">
  <meta name="author" content="Wizanimes">
  <meta name="copyright" content="Wizanimes">
  <meta name="email" content="mail@freewebs.ml"> <!-- Email de contact -->
  <meta name="domain" content="wizanimes.com"> <!-- Domaine de site ex: wizanimes.com-->
  <meta name="keywords" content="animes, fr, wizanimes">
  <!--Mots clés de ton site-->
  <meta name="dcterms.subject" content="animes, fr, wizanimes">
  <!--Les mêmes ici ausii-->
  <meta name="dcterms.type" content="Service">
  <meta name="distribution" content="global">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="Wizanimes">

  <!--Robots de référencement-->
  <meta name="robots" content="index, follow, all">
  <meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
  <meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">

  <!--Language-->
  <meta http-equiv="content-language" content="fr">
  <meta name="dcterms.language" content="fr">
  <meta property="og:locale" content="fr">
  <link rel="alternate" hreflang="x-default" href="https://www.freewebs.ml/" /> <!-- Remplace par l'url de la page-->
  <link rel="alternate" hreflang="fr" href="https://www.freewebs.ml/fr/" /> <!-- Remplace par l'url de la page-->

  <!-- Google -->
  <!--Inscris toi sur Google Adsence pour les pubs, Search Console pour le référencement et Analytics pour savoir le nombre de personnes qui visitent le site, puis colle les codes qu'ils te donnent ici-->


  <link rel="stylesheet" href="../style.css">
</head>

<body>

  <header class="Header">

    <div class="menu">
      <a href="../"><img src="../image/logo.png" alt="Logo" /></a>


      <div class='menu-icon' onclick="responsive()">
        <i class='fas fa-bars'></i>
      </div>

      <ul id="nav">
        <li><a href="../" class="active"><i class="fas fa-home"></i>Accueil</a></li>
        <li><a href="../Anime VO"><i class="fas fa-globe-americas"></i>Animé VO</a></li>
        <li><a href="../Anime VF"><i class="fas fa-globe-europe"></i> Animé VF</a></li>
        <li><a href="../Film"><i class="fas fa-video"></i>Film</a></li>
        <li><a href="../Ajouts récents"><i class="fas fa-plus-square"></i>Ajouts récents</a></li>
        <li><a href="../auth/profil"><i class="fas fa-list-alt"></i>Ma liste</a></li>

        <div class="account-mobil">
          <?php
          if (!isset($_SESSION['id'])) {

          ?>
            <a href="../auth/connexion"><button type="button" class="btn btn-outline-light">Login</button></a>
            <a href="../auth/inscription"><button type="button" class="btn btn-warning">Sign-up</button></a>
          <?php
          } else if ($_SESSION['id'] == 9) {
          ?>
            <a href="../auth/profil"><button type="button" class="btn btn-warning">Mon Profil</button></a>
            <a href="../admin/dashboard"><button type="button" class="btn btn-warning-red">Admin</button></a>
            <a href="../auth/deconnexion"><button type="button" class="btn btn-outline-light">Logout</button></a>
          <?php
          } else {
          ?>
            <a href="../auth/profil"><button type="button" class="btn btn-warning">Mon Profil</button></a>
            <a href="../auth/deconnexion"><button type="button" class="btn btn-outline-light">Logout</button></a>
          <?php
          }
          ?>
        </div>

      </ul>
    </div>
    <div class="account" id="account">
      <?php
      if (!isset($_SESSION['id'])) {

      ?>
        <a href="../auth/connexion"><button type="button" class="btn btn-outline-light">Login</button></a>
        <a href="../auth/inscription"><button type="button" class="btn btn-warning">Sign-up</button></a>
      <?php
      } else if ($_SESSION['id'] == 9) {
      ?>
        <a href="../auth/profil"><button type="button" class="btn btn-warning">Mon Profil</button></a>
        <a href="../admin/dashboard"><button type="button" class="btn btn-warning-red">Admin</button></a>
        <a href="../auth/deconnexion"><button type="button" class="btn btn-outline-light">Logout</button></a>
      <?php
      } else {
      ?>
        <a href="../auth/profil"><button type="button" class="btn btn-warning">Mon Profil</button></a>
        <a href="../auth/deconnexion"><button type="button" class="btn btn-outline-light">Logout</button></a>
      <?php
      }
      ?>
    </div>


  </header>

  <section class="stream">
    <div class="container-video">
      <div class="main-video">
        <div class="video">
          <video src="<?= $afficher_first['location'] ?>" controls buffered controlslist="nodownload" preload="none" poster="../upload/images/<?= $afficher_poster['img'] ?>"></video>
          <div class="text">
            <h3 class="title"><span>01.</span> <?= $afficher_first['AnimeName'] ?></h3>
            <form method="post" class="btn-list">
              <?php
              if (!isset($_SESSION['id'])) {
              ?>
                <input type="submit" class='submit-list' name="demander" value="Ajouter à votre liste" />
              <?php
              } else if ((isset($_SESSION['id']) && $relation['like_Name']) == $id) {
              ?>
                <input type="submit" class='submit-list sup' name="supprimer" value="Supprimer de votre liste" />
              <?php
              } else {
              ?>
                <input type="submit" class='submit-list' name="demander" value="Ajouter à votre liste" />
              <?php
              }
              ?>

            </form>
          </div>
        </div>
      </div>
      <div class="video-list">
        <?php
        $nombre = 0;
        $season = 1;
        foreach ($afficher_playlist as $playlist) {

          $nombre = $nombre += 1
        ?>

          <div class="vid active">
            <?php
            if ($season == $playlist['season']) {
            ?>
              <video src="<?= $playlist['location'] ?>" poster="../upload/images/<?= $afficher_poster['img'] ?>" buffered controlslist="nodownload" preload="none"></video>
              <h3 class="title"><span><?= $nombre ?>.</span> <?= $playlist['AnimeName'] ?></h3>
            <?php
            } else {
              $season = $season += 1;
              $nombre = $nombre - $nombre + 1;
            ?>
              <video src="<?= $playlist['location'] ?>" poster="../upload/images/<?= $afficher_poster['img'] ?>" buffered controlslist="nodownload" preload="none"></video>
              <h3 class="title"><span><?= $nombre ?>. </span><?= $playlist['AnimeName'] ?></h3>

              <div class="vid season">
                <h3 class="title-season">Season : <?= $season ?></h3>
              </div>

            <?php
            }
            ?>

          </div>

        <?php
        }
        ?>
      </div>
    </div>
  </section>

  <script>
    /*
      __________________________________________________________________________
      
                          Playlist video
      __________________________________________________________________________
       */

    let listVideo = document.querySelectorAll('.video-list .vid')
    let mainVideo = document.querySelector('.main-video video')
    let title = document.querySelector('.main-video .title')

    listVideo.forEach(video => {
      video.onclick = () => {
        listVideo.forEach(vid => vid.classList.remove('active'));
        video.classList.add('active');
        if (video.classList.contains('active')) {
          let src = video.children[0].getAttribute('src');
          console.log(video.children[0].getAttribute('src'))
          mainVideo.src = src
          let text = video.children[1].innerHTML;
          title.innerHTML = text

        }
      }
    })
  </script>
  <script src="../main.js"></script>

  <body>

</html>