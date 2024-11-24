<?php
session_start();
include('../bd/connexionDB.php');

if (!isset($_SESSION['id'])) {
    header('Location: ../');
    exit;
}

if ($_SESSION['id'] != 9) {
    header('Location: ../');
    exit;
}

// On récupère tous les utilisateurs sauf l'utilisateur en cours
$afficher_profil = $DB->prepare("SELECT * 
    FROM utilisateur 
    WHERE id <> ?");
$afficher_profil->execute(array($_SESSION['id']));

$afficher_profil = $afficher_profil->fetchAll(); // fetchAll() permet de récupérer plusieurs enregistrements
?>

<html lang="fr">

<head>
    <!--title-->
    <title>Utilisateurs - Wizanimes</title>
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

    <!--CSS-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/utilisateurs.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
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
                    if (!isset($_SESSION['id'])) {

                    ?>
                        <a href="../auth/connexion"><button type="button" class="btn btn-outline-light">Login</button></a>
                        <a href="../auth/inscription"><button type="button" class="btn btn-warning">Sign-up</button></a>
                    <?php
                    } else if ($_SESSION['id'] == 9) {
                    ?>
                        <a href="../auth/profil"><button type="button" class="btn btn-warning">Mon Profil</button></a>
                        <a href="admin/dashboard"><button type="button" class="btn btn-warning-red">Admin</button></a>
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
                <a href="dashboard"><button type="button" class="btn btn-warning-red">Admin</button></a>
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

    <section class="Utilisateurs">
        <div class="container profile-page">
            <div class="row">

                <?php
                foreach ($afficher_profil as $ap) {
                ?>

                    <div class="col-xl-6 col-lg-7 col-md-12">
                        <div class="card profile-header">
                            <div class="body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="profile-image float-md-right"> <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt=""> </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-12">
                                        <h4 class="m-t-0 m-b-0"><strong><?= $ap['firstName'] ?></strong> <?= $ap['lastName'] ?></h4>
                                        <span class="job_post">Pseudo : <?= $ap['pseudo']?></span>
                                        <h6>Email : <?= $ap['email'] ?></h6>
                                        <h6>Status : <?= $ap['status'] ?></h6>
                                        <h6>Arrivé le <?= $ap['date_creation_compte'] ?></h6>
                                        <div>
                                            <a href="voir_profil?id=<?= $ap['id'] ?>"><button class="btn btn-primary btn-round btn-simple">View Profile</button></a>
                                        </div>
                                        <p class="social-icon m-t-5 m-b-0">
                                            <a title="Twitter" href="javascript:void(0);"><i class="fa fa-twitter"></i></a>
                                            <a title="Facebook" href="javascript:void(0);"><i class="fa fa-facebook"></i></a>
                                            <a title="Google-plus" href="javascript:void(0);"><i class="fa fa-twitter"></i></a>
                                            <a title="Behance" href="javascript:void(0);"><i class="fa fa-behance"></i></a>
                                            <a title="Instagram" href="javascript:void(0);"><i class="fa fa-instagram "></i></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>
        </div>
    </section>

</body>

</html>