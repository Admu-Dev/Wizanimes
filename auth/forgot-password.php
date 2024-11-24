<?php require_once "controllerUserData.php";

if (isset($_SESSION['id'])) {
    header('Location: ../');
    exit;
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Forgot Password - Wizanimes</title>
    <meta property="og:title" content="Wizanimes - #1 du streaming d'animés">
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


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/verif.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="forgot-password.php" method="POST" autocomplete="">
                    <h2 class="text-center">Mot de passe oublié</h2>
                    <p class="text-center">Entrez votre adresse email</p>
                    <?php
                    if (count($errors) > 0) {
                    ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach ($errors as $error) {
                                echo $error;
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Enter email address" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-email" value="Continue">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>