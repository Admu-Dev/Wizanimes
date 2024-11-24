<?php
session_start();
include('bd/connexionDB.php');

$afficher_anime_VO = $DB->query("SELECT * 
  FROM images WHERE categorie = 'Film'");

$afficher_anime_VO = $afficher_anime_VO->fetchAll();

?>



<html lang="fr">

<head>
  <!--title-->
  <title>Film - Wizanimes</title>
  <meta property="og:title" content="Wizanimes - #1 du streaming d'animés">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.0/css/all.css">

  <!--Canonical-->
  <link rel="canonical" href="https://wizanimes.com"> <!-- C'est l'url de la page ex: https://wizanimes.com/streaming/naruto si l'url c'est ça-->
  <meta property="og:url" content="https://wizanimes.com"> <!-- Même chose ici-->

  <!--favicon icon-->
  <link rel="apple-touch-icon" sizes="180x180" href="image/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="image/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="image/favicon/favicon-16x16.png">
  <link rel="manifest" href="image/favicon/site.webmanifest">
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


  <link rel="stylesheet" href="style.css">
</head>

<body>

  <img src="image/1000_F_242421589_CL3PVkynEim1fXZjv9jGoXYeYZb8OYRQ-removebg-preview.png" alt="" class="fond-ecran camera-img ">
  <img src="image/Streaming_1-removebg-preview.png" alt="" class="fond-ecran stream-img ">

  <header class="Header">

    <div class="menu">
      <a href="./"><img src="./image/logo.png" alt="Logo" /></a>


      <div class='menu-icon' onclick="responsive()">
        <i class='fas fa-bars'></i>
      </div>

      <ul id="nav">
        <li><a href="./"><i class="fas fa-home"></i>Accueil</a></li>
        <li><a href="./Anime VO"><i class="fas fa-globe-americas"></i>Animé VO</a></li>
        <li><a href="./Anime VF"><i class="fas fa-globe-europe"></i> Animé VF</a></li>
        <li><a href="./Film" class="active"><i class="fas fa-video"></i>Film</a></li>
        <li><a href="./Ajouts récents"><i class="fas fa-plus-square"></i>Ajouts récents</a></li>
        <li><a href="./auth/profil"><i class="fas fa-list-alt"></i>Ma liste</a></li>

        <div class="account-mobil">
          <?php
          if (!isset($_SESSION['id'])) {

          ?>
            <a href="./auth/connexion"><button type="button" class="btn btn-outline-light">Login</button></a>
            <a href="./auth/inscription"><button type="button" class="btn btn-warning">Sign-up</button></a>
          <?php
          } else if ($_SESSION['id'] == 9) {
          ?>
            <a href="./auth/profil"><button type="button" class="btn btn-warning">Mon Profil</button></a>
            <a href="./admin/dashboard"><button type="button" class="btn btn-warning-red">Admin</button></a>
            <a href="./auth/deconnexion"><button type="button" class="btn btn-outline-light">Logout</button></a>
          <?php
          } else {
          ?>
            <a href="./auth/profil"><button type="button" class="btn btn-warning">Mon Profil</button></a>
            <a href="./auth/deconnexion"><button type="button" class="btn btn-outline-light">Logout</button></a>
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
        <a href="./auth/connexion"><button type="button" class="btn btn-outline-light">Login</button></a>
        <a href="./auth/inscription"><button type="button" class="btn btn-warning">Sign-up</button></a>
      <?php
      } else if ($_SESSION['id'] == 9) {
      ?>
        <a href="./auth/profil"><button type="button" class="btn btn-warning">Mon Profil</button></a>
        <a href="./admin/dashboard"><button type="button" class="btn btn-warning-red">Admin</button></a>
        <a href="./auth/deconnexion"><button type="button" class="btn btn-outline-light">Logout</button></a>
      <?php
      } else {
      ?>
        <a href="./auth/profil"><button type="button" class="btn btn-warning">Mon Profil</button></a>
        <a href="./auth/deconnexion"><button type="button" class="btn btn-outline-light">Logout</button></a>
      <?php
      }
      ?>
    </div>


  </header>

  <section class="Film">
    <h2>Les Films</h2>
    <div class="container">
      <div class="row">
        <div class="row-inner">

          <?php
          foreach ($afficher_anime_VO as $VO) {
          ?>
            <div class="card">
              <a href="./stream/stream?id=<?= $VO['NameAnime'] ?>" class="cards-a">
                <div class="card-media">
                  <img class="card-img" src="upload/images/<?= $VO['img'] ?>" alt="" />
                </div>
                <div class="card-details">
                  <div class="card-title">
                    <?= $VO['NameAnime'] ?>
                  </div>
                </div>
              </a>
            </div>
          <?php
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

  <script src="main.js"></script>
</body>

</html>