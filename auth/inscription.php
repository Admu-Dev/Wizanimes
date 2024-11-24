<?php
require_once "controllerUserData.php";


if (isset($_SESSION['id'])) {
    header('Location: ../');
    exit;
}
?>

<html lang="fr">

<head>
    <!--title-->
    <title>Register - Wizanimes</title>
    <meta property="og:title" content="Wizanimes - #1 du streaming d'animés">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/login-register.css">
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

</head>

<body>
    <div class="container">

        <header class="text-center">

            <img src="../image/logo.png" alt="logo" class="logo-title">

        </header>
        <h1 class="text-center">Register</h1>
        <form class="registration-form" method="post">
            <label class="col-one-half">
                <span class="label-text">First Name</span>
                <?php
                if (isset($er_prenom)) {
                ?>
                    <div><?= $er_prenom ?></div>
                <?php
                }
                ?>
                <input type="text" name="prenom" value="<?php if (isset($prenom)) {
                                                            echo $prenom;
                                                        } ?>" required>
            </label>
            <label class="col-one-half">
                <span class="label-text">Last Name</span>
                <?php
                if (isset($er_lastName)) {
                ?>
                    <div><?= $er_lastName ?></div>
                <?php
                }
                ?>
                <input type="text" name="nom" value="<?php if (isset($nom)) {
                                                            echo $nom;
                                                        } ?>" required>
            </label>

            <label>
                <span class="label-text">Pseudo</span>
                <?php
                if (isset($er_pseudo)) {
                ?>
                    <div><?= $er_pseudo ?></div>
                <?php
                }
                ?>
                <input type="text" name="pseudo" value="<?php if (isset($pseudo)) {
                                                            echo $pseudo;
                                                        } ?>" required>
            </label>

            <label>
                <span class="label-text">Email</span>
                <?php
                if (isset($er_mail)) {
                ?>
                    <div><?= $er_mail ?></div>
                <?php
                }
                ?>
                <input type="email" name="mail" value="<?php if (isset($mail)) {
                                                            echo $mail;
                                                        } ?>" required>
            </label>
            <label class="password">
                <span class="label-text">Password</span>
                <button class="toggle-visibility" title="toggle password visibility" tabindex="-1">
                    <span class="glyphicon glyphicon-eye-close"></span>
                </button>
                <?php
                if (isset($er_mdp)) {
                ?>
                    <div><?= $er_mdp ?></div>
                <?php
                }
                ?>
                <input type="password" name="mdp" value="<?php if (isset($mdp)) {
                                                                echo $mdp;
                                                            } ?>" required>
            </label>
            <label class="password">
                <span class="label-text">Comfirm Password</span>
                <button class="toggle-visibility" title="toggle password visibility" tabindex="-1">
                    <span class="glyphicon glyphicon-eye-close"></span>
                </button>
                <input type="password" name="confmdp" required>
            </label>

            <div class="text-center">
                <button class="submit" name="inscription">Sign Me Up</button>
            </div>

            <p class="text-center">Are you a member? <a class="connexion" href="connexion">Sign up now</a> <svg class="icon">
                    <use xlink:href="#icon-arrow-right"></use>
                </svg></p>

            <svg xmlns="http://www.w3.org/2000/svg" class="icons">
                <symbol id="icon-arrow-right" viewBox="0 0 1792 1792">
                    <path d="M1600 960q0 54-37 91l-651 651q-39 37-91 37-51 0-90-37l-75-75q-38-38-38-91t38-91l293-293H245q-52 0-84.5-37.5T128 1024V896q0-53 32.5-90.5T245 768h704L656 474q-38-36-38-90t38-90l75-75q38-38 90-38 53 0 91 38l651 651q37 35 37 90z" />
                </symbol>
                <symbol id="icon-lock" viewBox="0 0 1792 1792">
                    <path d="M640 768h512V576q0-106-75-181t-181-75-181 75-75 181v192zm832 96v576q0 40-28 68t-68 28H416q-40 0-68-28t-28-68V864q0-40 28-68t68-28h32V576q0-184 132-316t316-132 316 132 132 316v192h32q40 0 68 28t28 68z" />
                </symbol>
                <symbol id="icon-user" viewBox="0 0 1792 1792">
                    <path d="M1600 1405q0 120-73 189.5t-194 69.5H459q-121 0-194-69.5T192 1405q0-53 3.5-103.5t14-109T236 1084t43-97.5 62-81 85.5-53.5T538 832q9 0 42 21.5t74.5 48 108 48T896 971t133.5-21.5 108-48 74.5-48 42-21.5q61 0 111.5 20t85.5 53.5 62 81 43 97.5 26.5 108.5 14 109 3.5 103.5zm-320-893q0 159-112.5 271.5T896 896 624.5 783.5 512 512t112.5-271.5T896 128t271.5 112.5T1280 512z" />
                </symbol>
            </svg>


        </form>
    </div>
</body>

</html>