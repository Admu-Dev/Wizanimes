<?php
session_start();
include('bd/connexionDB.php');

$afficher_anime_recommandations = $DB->query("SELECT * 
  FROM images WHERE categorie = 'recommandations'");

$afficher_anime_recommandations = $afficher_anime_recommandations->fetchAll();
/**___________________________________________________________________________________________
   ___________________________________________________________________________________________ */

$afficher_anime_seriesViolentes = $DB->query("SELECT * 
  FROM images WHERE categorie = 'SeriesViolentes'");

$afficher_anime_seriesViolentes = $afficher_anime_seriesViolentes->fetchAll();

/**___________________________________________________________________________________________
   ___________________________________________________________________________________________ */

$afficher_anime_actionAventure = $DB->query("SELECT * 
   FROM images WHERE categorie = 'ActionAventure'");

$afficher_anime_actionAventure = $afficher_anime_actionAventure->fetchAll();

?>



<html lang="fr">

<head>
  <!--title-->
  <title>Accueil - Wizanimes</title>
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

  <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

</head>

<body>

  <header class="Header">

    <div class="menu">
      <a href="./"><img src="./image/logo.png" alt="Logo" /></a>


      <div class='menu-icon' onclick="responsive()">
        <i class='fas fa-bars'></i>
      </div>

      <ul id="nav">
        <li><a href="./" class="active"><i class="fas fa-home"></i>Accueil</a></li>
        <li><a href="./Anime VO"><i class="fas fa-globe-americas"></i>Animé VO</a></li>
        <li><a href="./Anime VF"><i class="fas fa-globe-europe"></i> Animé VF</a></li>
        <li><a href="./Film"><i class="fas fa-video"></i>Film</a></li>
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


  <section class="home">
    <div class="swiper home-slider">
      <div class="swiper-wrapper">

        <div class="swiper-slide">
          <div class="box second" style="background: url(image/default_2021-01-27_99dd0d99-f818-4694-b6ff-38af4b57cd10.png) no-repeat;">
            <div class="content">
              <span>Attaque des titans</span>
              <h3>Stream</h3>
              <p>Dans un monde ravagé par des titans mangeurs d'homme depuis plus d'un siècle, les rares survivants de l'Humanité n'ont d'autre choix pour survivre que de se barricader dans une cité-forteresse.</p>
              <a href="./stream/stream?id=Attaque des titans" class="btn-home">Get started</a>
            </div>
          </div>
        </div>

        <div class="swiper-slide">
          <div class="box center" style="background: url(image/borutoooo.webp) no-repeat;">
            <div class="content">
              <span>Boruto</span>
              <h3>Stream</h3>
              <p>Boruto est le fils de Naruto Uzumaki, le héros de la guerre est désormais le 7e Hokage. Le jeune Boruto est déçu de voir que son père soit toujours occupé par son travail. Alors que l'examen chûnin approche, Boruto demande à un ninja célèbre d'être son professeur : il s'agit de Sasuke Uchiwa.</p>
              <a href="./stream/stream?id=boruto" class="btn-home">Get started</a>
            </div>
          </div>
        </div>

        <div class="swiper-slide">
          <div class="box second" style="background: url(image/onepiece2.webp) no-repeat;">
            <div class="content">
              <span>One piece</span>
              <h3>Stream</h3>
              <p>Avant son exécution, le pirate légendaire Gold Roger lance une chasse au trésor sans précédent et stimule ainsi les pirates du monde entier. Luffy, transformé en homme élastique après avoir mangé un fruit du démon, rêve de devenir le roi des pirates et de trouver le mystérieux “One Piece”.</p>
              <a href="./stream/stream?id=One piece" class="btn-home">Get started</a>
            </div>
          </div>
        </div>

      </div>

      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>

    </div>
  </section>

  <!-- Les films et séries -->


  <!-- Les tendances -->
  <section class="Tendances">
    <h2>Nos recommandations</h2>
    <div class="container">
      <div class="row">
        <div class="row-inner">

          <?php
          foreach ($afficher_anime_recommandations as $ap) {
          ?>
            <div class="card">
              <a href="./stream/stream?id=<?= $ap['NameAnime'] ?>" class="cards-a">
                <div class="card-media">
                  <img class="card-img" src="upload/images/<?= $ap['img'] ?>" alt="" />
                </div>
                <div class="card-details">
                  <div class="card-title">
                    <?= $ap['NameAnime'] ?>
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


  <!-- Les séries violentes -->
  <section class="series-violentes">
    <h2>Les series violentes</h2>
    <div class="container">
      <div class="row">
        <div class="row-inner">

          <?php
          foreach ($afficher_anime_seriesViolentes as $sv) {
          ?>
            <div class="card">
              <a href="./stream/stream?id=<?= $sv['NameAnime'] ?>" class="cards-a">
                <div class="card-media">
                  <img class="card-img" src="upload/images/<?= $sv['img'] ?>" alt="" />
                </div>
                <div class="card-details">
                  <div class="card-title">
                    <?= $sv['NameAnime'] ?>
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
  <!-- Fin des séries violentes -->

  <!-- Films d'action et aventures -->
  <section class="action-aventure">
    <h2>Animé pour enfants</h2>
    <div class="container">
      <div class="row">
        <div class="row-inner">

          <?php
          foreach ($afficher_anime_actionAventure as $av) {
          ?>
            <div class="card">
              <a href="./stream/stream?id=<?= $av['NameAnime'] ?>" class="cards-a">
                <div class="card-media">
                  <img class="card-img" src="upload/images/<?= $av['img'] ?>" alt="" />
                </div>
                <div class="card-details">
                  <div class="card-title">
                    <?= $av['NameAnime'] ?>
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
  <!-- Fin des films d'action et aventure -->

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


  <script src="./main.js"></script>

  <!-- Swiper JS -->
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".home-slider", {
      loop: true,
      autoplay: true,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  </script>
</body>

</html>