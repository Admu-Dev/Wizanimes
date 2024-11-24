<?php
require_once "controllerDashboardData.php";

if (!isset($_SESSION['id'])) {
    header('Location: ../');
    exit;
}

if ($_SESSION['id'] != 9) {
    header('Location: ../');
    exit;
}
?>


<html lang="fr">

<head>
  <!--title-->
  <title>Dashboard Video - Wizanimes</title>
  <meta property="og:title" content="Wizanimes - #1 du streaming d'animés">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.0/css/all.css">

  <!--Canonical-->
  <link rel="canonical" href="https://wizanimes.com">
  <!-- C'est l'url de la page ex: https://wizanimes.com/streaming/naruto si l'url c'est ça-->
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
  <link rel="stylesheet" href="../css/dashboard.css">
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
        <li><a href="../auth/profil"><i class="fas fa-list-alt"></i>Ma liste</a></li>

        <div class="account-mobil">
          <?php
          if(!isset($_SESSION['id'])){
            
        ?>
          <a href="../auth/connexion"><button type="button" class="btn btn-outline-light">Login</button></a>
          <a href="../auth/inscription"><button type="button" class="btn btn-warning">Sign-up</button></a>
          <?php
            }else if($_SESSION['id'] == 9){
              ?>
          <a href="../auth/profil"><button type="button" class="btn btn-warning">Mon Profil</button></a>
          <a href="admin/dashboard"><button type="button" class="btn btn-warning-red">Admin</button></a>
          <a href="../auth/deconnexion"><button type="button" class="btn btn-outline-light">Logout</button></a>
          <?php
            }else{
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
          if(!isset($_SESSION['id'])){
            
        ?>
      <a href="../auth/connexion"><button type="button" class="btn btn-outline-light">Login</button></a>
      <a href="../auth/inscription"><button type="button" class="btn btn-warning">Sign-up</button></a>
      <?php
            }else if($_SESSION['id'] == 9){
              ?>
      <a href="../auth/profil"><button type="button" class="btn btn-warning">Mon Profil</button></a>
      <a href="dashboard"><button type="button" class="btn btn-warning-red">Admin</button></a>
      <a href="../auth/deconnexion"><button type="button" class="btn btn-outline-light">Logout</button></a>
      <?php
            }else{
        ?>
      <a href="../auth/profil"><button type="button" class="btn btn-warning">Mon Profil</button></a>
      <a href="../auth/deconnexion"><button type="button" class="btn btn-outline-light">Logout</button></a>
      <?php
            } 
        ?>
    </div>


  </header>


  <section class="dashboard">

    <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"
      class="contactform">
      <h2>Formulaire pour ajouter le visuel des Animés</h2>
      <div class="content">
        <div class="iconblock">
          <input type="text" name="nom" value="<?php if(isset($nom)){ echo $nom; }?>" size="45" maxlength="100"
            placeholder="Name" required>
        </div>
      </div>

      <h3>Video Category</h3>
      <select id="Categorie" name="Categorie">
        <option value="hide">-- Categorie --</option>
        <option value="recommandations">Recommandations</option>
        <option value="SeriesViolentes">Series-Violentes</option>
        <option value="ActionAventure">Action-Aventure</option>
        <option value="Anime-VO">Animé VO</option>
        <option value="Anime-VF">Animé VF</option>
        <option value="Film">Film</option>
      </select>

      <div class="upload">

        <h3>Image Pour la carte</h3>

        <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <div class="file-upload">
          <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add
            Image</button>

          <div class="image-upload-wrap">
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_SIZE; ?>" />
            <label for="fichier_a_uploader" title="Recherchez le fichier à uploader !"></label>
            <input class="file-upload-input" name="fichier" type="file" id="fichier_a_uploader"
              onchange="readURL(this);" accept="image/*" />
            <div class="drag-text">
              <h3>Drag and drop a file or select add Image</h3>
            </div>
          </div>
          <div class="file-upload-content">
            <img class="file-upload-image" src="#" alt="your image" />
            <div class="image-title-wrap">
              <button type="button" onclick="removeUpload()" class="remove-image">Remove <span
                  class="image-title">Uploaded Image</span></button>
            </div>
            <input type="submit" name="submit_images" value="Uploader" />
          </div>
        </div>

        <div class="erreur">

        <?php 
                if(isset($message))
                {
                  echo '<p>',"\n";
                  echo "\t\t<strong>",  $message ,"</strong>\n";
                  echo "\t</p>\n\n";
                  unset($message);
                }
              ?>
        </div>

      </div>

    </form>

  </section>


  <section class="dashboard-video">

    <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"
      class="contactform-video">
      <h2>Formulaire pour ajouter les video</h2>

      <h3>Sélectionner l'Animé</h3>
      <select id="AllAnimes" name="AllAnimes" class="select-styled">
        <option value="hide">-- Categorie --</option>
        <?php
            foreach ($CountNameAnime as $NameAnime) {
              # code...
              ?>
        <option value="<?= $NameAnime['NameAnime'] ?>"><?= $NameAnime['NameAnime'] ?></option>

        <?php
            }
          ?>
      </select>
      <h3>Saison de l'anime</h3>
      <input type="number" name="season"
       min="1" max="100">

      <div class="upload">

        <h3>Video</h3>

        <input type='file' name='file' />
        <input type='submit' value='video_upload' name='video_upload'>

        <div class="erreur">

          <?php 
                if(isset($_SESSION['message_upload']))
                {
                  echo '<p>',"\n";
                  echo "\t\t<strong>",  $_SESSION['message_upload'] ,"</strong>\n";
                  echo "\t</p>\n\n";
                  unset($_SESSION['message_upload']);
                }
              ?>
        </div>

      </div>

    </form>

  </section>

<!--
  <script language='javascript'>
    function Confirmer()
    {
    if (confirm("Confirmez vous vouloir supprimer cette anime : "+ removeAnime.Categorie.value ))
    {
      removeAnime.submit();
    }
    }
</script>
  -->
  <section class="dashboard-remove">

    <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"
      class="contactform-remove-anime" name="removeAnime">
      <h2>Suprimmer un Anime</h2>

      <h3>Sélectionner l'Animé</h3>
      <select id="Categorie" name="CategorieAnime" class="select-styled">
        <option value="hide">-- Categorie --</option>
        <?php
            foreach ($CountNameAnime as $NameAnime) {
              # code...
              ?>
        <option value="<?=$NameAnime['NameAnime']?>"><?=$NameAnime['NameAnime']?></option>

        <?php
            }
          ?>
      </select>

      <div class="upload">

       <!--
        <input type='button' value='Confirmer' name="removeAnime" onClick='Confirmer'>
          -->

        <input type='submit' value='video_remove' name='video_remove' class="remove-video-submit">
        <div class="erreur">

          <?php 
                if(isset($_SESSION['message-remove']))
                {
                  echo '<p>',"\n";
                  echo "\t\t<strong>",  $_SESSION['message-remove'] ,"</strong>\n";
                  echo "\t</p>\n\n";
                  unset($_SESSION['message-remove']);
                }
              ?>
        </div>

      </div>

    </form>

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
                <a  href="https://discord.gg/animesfr"><i class="fab fa-discord"></i>  Wizanimes</a>
            </div>
            <div class="info">
                <h3>Créateur du site</h3>
                <a href="#"><i class="fab fa-discord"></i> Admu#2484</a>
                <a href="#">Développeur de site web</a>
                <a href="#">Développeur : <div><li>React js</li><li>JavaScript</li><li>HTML</li><li>CSS</li><li>PHP</li></div></a>
            </div>

        </div>
        <div class="footer-bas">
            <p>Wizanimes - 2022 - TOUS DROITS RÉSERVÉS ©</p>
        </div>
      </footer>      
      


  <script src="../main.js"></script>
</body>

</html>