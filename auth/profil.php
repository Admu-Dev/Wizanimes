<?php
session_start();
include('../bd/connexionDB.php');
// S'il n'y a pas de session alors on ne va pas sur cette page
if (!isset($_SESSION['id'])) {
  header('Location: connexion');
  exit;
}

// On récupère les informations de l'utilisateur connecté
$afficher_profil = $DB->prepare("SELECT * 
    FROM utilisateur 
    WHERE id = ?");
$afficher_profil->execute(array($_SESSION['id']));

$afficher_profil = $afficher_profil->fetch();

if($afficher_profil['status'] == 'notverified') {
  header('Location: user-otp');
  exit;
}

$IDutilisateur = $_SESSION['id'];

$afficher_anime_like = $DB->prepare("SELECT * 
  FROM add_list WHERE id = $IDutilisateur");
$afficher_anime_like->execute();

$afficher_anime_like = $afficher_anime_like->fetchAll();

$afficher_anime = $DB->prepare("SELECT * 
  FROM images");
$afficher_anime->execute();
$afficher_anime = $afficher_anime->fetchAll();


?>



<html lang="fr">

<head>
  <!--title-->
  <title>Profil - Wizanimes</title>
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
        <li><a href="../"><i class="fas fa-home"></i>Accueil</a></li>
        <li><a href="../Anime VO"><i class="fas fa-globe-americas"></i>Animé VO</a></li>
        <li><a href="../Anime VF"><i class="fas fa-globe-europe"></i> Animé VF</a></li>
        <li><a href="../Film"><i class="fas fa-video"></i>Film</a></li>
        <li><a href="../Ajouts récents"><i class="fas fa-plus-square"></i>Ajouts récents</a></li>
        <li><a href="profil" class="active"><i class="fas fa-list-alt"></i>Ma liste</a></li>

        <div class="account-mobil">
          <?php
          if (!isset($_SESSION['id'])) {

          ?>
            <a href="connexion"><button type="button" class="btn btn-outline-light">Login</button></a>
            <a href="inscription"><button type="button" class="btn btn-warning">Sign-up</button></a>
          <?php
          } else if ($_SESSION['id'] == 9) {
          ?>
            <a href="profil"><button type="button" class="btn btn-warning">Mon Profil</button></a>
            <a href="../admin/dashboard"><button type="button" class="btn btn-warning-red">Admin</button></a>
            <a href="deconnexion"><button type="button" class="btn btn-outline-light">Logout</button></a>
          <?php
          } else {
          ?>
            <a href="profil"><button type="button" class="btn btn-warning">Mon Profil</button></a>
            <a href="deconnexion"><button type="button" class="btn btn-outline-light">Logout</button></a>
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
        <a href="connexion"><button type="button" class="btn btn-outline-light">Login</button></a>
        <a href="inscription"><button type="button" class="btn btn-warning">Sign-up</button></a>
      <?php
      } else if ($_SESSION['id'] == 9) {
      ?>
        <a href="profil"><button type="button" class="btn btn-warning">Mon Profil</button></a>
        <a href="../admin/dashboard"><button type="button" class="btn btn-warning-red">Admin</button></a>
        <a href="deconnexion"><button type="button" class="btn btn-outline-light">Logout</button></a>
      <?php
      } else {
      ?>
        <a href="profil"><button type="button" class="btn btn-warning">Mon Profil</button></a>
        <a href="deconnexion"><button type="button" class="btn btn-outline-light">Logout</button></a>
      <?php
      }
      ?>
    </div>


  </header>

  <section class="profil">

    <div class="container">
      <div class="image">
        <img src="../image/user-removebg-preview.png" alt="logo user">
      </div>
      <div class="content">
        <h1 class="name"><?= $afficher_profil['lastName'] ?> . <?= $afficher_profil['firstName']; ?></h1>

        <h3 class="post"><?php
                          if ($_SESSION['id'] == 9) {
                          ?>
            Admin
          <?php
                          } else {
          ?>
            Viewer
          <?php
                          } ?>
        </h3>

        <ul class="contact">
          <li><i class="fas fa-headset"></i><?= $afficher_profil['pseudo'] ?></li>
          <li><i class="fas fa-envelope"></i><?= $afficher_profil['email'] ?></li>
          <li><i class="far fa-calendar-alt"></i><?= $afficher_profil['date_creation_compte'] ?></li>
        </ul>
      </div>
    </div>


    <div class="container-like">
      <h2>Votre liste d'animé(s)</h2>

      <?php
      if ($afficher_anime_like == null) {
      ?>
        <h3>Vous n'avez pas ajouté d'anime à votre liste</h3>

      <?php
      } else {
      ?>

        <div class="row">
          <div class="row-inner">
            <?php
            foreach ($afficher_anime_like as $AnimeLike) {
              foreach ($afficher_anime as $IMG_anime) {
                if ($AnimeLike['like_Name'] === $IMG_anime['NameAnime']) {
            ?>
                  <div class="card">
                    <a href="../stream/stream?id=<?= $AnimeLike['like_Name'] ?>" class="cards-a">
                      <div class="card-media">
                        <img class="card-img" src="../upload/images/<?= $IMG_anime['img'] ?>" alt="" />
                      </div>
                      <div class="card-details">
                        <div class="card-title">
                          <?= $AnimeLike['like_Name'] ?>
                        </div>
                      </div>
                    </a>
                  </div>
          <?php
                }
              }
            }
          }
          ?>

          </div>
        </div>
    </div>

  </section>

  <footer>
    <div class="footer-haut">

      <div class="info">
        <h3>Wizanimes</h3>
        <p>Wizanimes est un projet crée par une communauté qui adore les Animés. Le site vous permet de regarder sans pub plein de sorte d'animés et tout ça sans pub.</p>
      </div>
      <div class="info">
        <h3>Nous contacter</h3>
        <a href="#">📞 tel wizanimes</a>
        <a href="mailto:contact@Wizanimes.fr">📧 contact@wizanimes.fr</a>
        <a href="https://discord.gg/animesfr"><i class="fab fa-discord"></i> Wizanimes</a>
      </div>
      <div class="info">
        <h3>Créateur du site</h3>
        <a href="#"><i class="fab fa-discord"></i> Admu#2484</a>
        <a href="#">Développeur de site web</a>
        <a href="#">Développeur : <div>
            <li>React js</li>
            <li>JavaScript</li>
            <li>HTML</li>
            <li>CSS</li>
            <li>PHP</li>
          </div></a>
      </div>

    </div>
    <div class="footer-bas">
      <p>Wizanimes - 2022 - TOUS DROITS RÉSERVÉS ©</p>
    </div>
  </footer>


  <script src="../main.js"></script>

</body>

</html>