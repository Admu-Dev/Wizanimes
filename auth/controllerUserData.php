<?php
session_start();
include('../bd/connexionDB.php');
$email = "";
$name = "";
$errors = array();

//if user signup button
if (isset($_POST['inscription'])) {
    $valid = true;
    $nom  = htmlentities(trim($_POST['nom'])); // On récupère le nom
    $prenom = htmlentities(trim($_POST['prenom'])); // on récupère le prénom
    $pseudo = htmlentities(trim($_POST['pseudo'])); // on récupère le pseudo
    $mail = htmlentities(strtolower(trim($_POST['mail']))); // On récupère le mail
    $mdp = trim($_POST['mdp']); // On récupère le mot de passe 
    $confmdp = trim($_POST['confmdp']); //  On récupère la confirmation du mot de passe

    //  Vérification du nom
    if (empty($nom)) {
        $valid = false;
        $er_nom = ("Le nom d' utilisateur ne peut pas être vide");
    }

    //  Vérification du prénom
    if (empty($prenom)) {
        $valid = false;
        $er_prenom = ("Le prenom d' utilisateur ne peut pas être vide");
    }
    if (empty($pseudo)) {
        $valid = false;
        $er_pseudo = ("Le pseudo ne peut pas être vide");
    }
    // Vérification du mail
    if (empty($mail)) {
        $valid = false;
        $er_mail = "Le mail ne peut pas être vide";

        // On vérifit que le mail est dans le bon format
    } elseif (!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $mail)) {
        $valid = false;
        $er_mail = "Le mail n'est pas valide";
    } else {
        // On vérifit que le mail est disponible
        $req_mail = $DB->prepare("SELECT id FROM utilisateur WHERE email = ?");
        $req_mail->execute(array($mail));

        $req_mail = $req_mail->fetch();

        if (isset($req_mail['id'])) {
            $valid = false;
            $er_mail = "Ce mail existe déjà";
        }
    }

    // Vérification du mot de passe
    if (empty($mdp)) {
        $valid = false;
        $er_mdp = "Le mot de passe ne peut pas être vide";
    } else if ($mdp != $confmdp) {
        $valid = false;
        $er_mdp = "La confirmation du mot de passe ne correspond pas";
    }

    // Si toutes les conditions sont remplies alors on fait le traitement
    if ($valid) {

        $mdpCrypte = password_hash("$mdp", PASSWORD_ARGON2ID);

        $date_creation_compte = date('Y-m-d H:i:s');

        $code = rand(999999, 111111);
        $status = "notverified";

        // On insert nos données dans la table utilisateur
        $req = $DB->prepare("INSERT INTO utilisateur (lastName, firstName, pseudo, email, passwords, date_creation_compte, code, status) VALUES 
                (?, ?, ?, ?, ?, ?, ?, ?)");
        $req->execute(array($nom, $prenom, $pseudo, $mail, $mdpCrypte, $date_creation_compte, $code, $status));

        $req_research = $DB->prepare("SELECT *
                FROM utilisateur
                WHERE email = ?");
        $req_research->execute(array($mail));

        $req_research = $req_research->fetch();
        if ($req_research) {

            $mail_to = $req_research['email'];
            $subject = 'Wizanimes: Confirmez votre adresse e-mail';

            //=====Création du header de l'e-mail.

            // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=iso-8859-1';

            // En-têtes additionnels
            $headers[] = 'From: Wizanimes <contact@wizanimes.fr>';

            //  Mail HTML
            $message = '<!DOCTYPE html>
                    <html>
                    
                    <head>
                        <title></title>
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                        <style type="text/css">
                            @media screen {
                                @font-face {
                                    font-family: \'Lato\';
                                    font-style: normal;
                                    font-weight: 400;
                                    src: local(\'Lato Regular\'), local(\'Lato-Regular\'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format(\'woff\');
                                }
                    
                                @font-face {
                                    font-family: \'Lato\';
                                    font-style: normal;
                                    font-weight: 700;
                                    src: local(\'Lato Bold\'), local(\'Lato-Bold\'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format(\'woff\');
                                }
                    
                                @font-face {
                                    font-family: \'Lato\';
                                    font-style: italic;
                                    font-weight: 400;
                                    src: local(\'Lato Italic\'), local(\'Lato-Italic\'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format(\'woff\');
                                }
                    
                                @font-face {
                                    font-family: \'Lato\';
                                    font-style: italic;
                                    font-weight: 700;
                                    src: local(\'Lato Bold Italic\'), local(\'Lato-BoldItalic\'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format(\'woff\');
                                }
                            }
                    
                            /* CLIENT-SPECIFIC STYLES */
                            body,
                            table,
                            td,
                            a {
                                -webkit-text-size-adjust: 100%;
                                -ms-text-size-adjust: 100%;
                            }
                    
                            table,
                            td {
                                mso-table-lspace: 0pt;
                                mso-table-rspace: 0pt;
                            }
                    
                            img {
                                -ms-interpolation-mode: bicubic;
                            }
                    
                            /* RESET STYLES */
                            img {
                                border: 0;
                                height: auto;
                                line-height: 100%;
                                outline: none;
                                text-decoration: none;
                            }
                    
                            table {
                                border-collapse: collapse !important;
                            }
                    
                            body {
                                height: 100% !important;
                                margin: 0 !important;
                                padding: 0 !important;
                                width: 100% !important;
                            }
                    
                            /* iOS BLUE LINKS */
                            a[x-apple-data-detectors] {
                                color: inherit !important;
                                text-decoration: none !important;
                                font-size: inherit !important;
                                font-family: inherit !important;
                                font-weight: inherit !important;
                                line-height: inherit !important;
                            }
                    
                            /* MOBILE STYLES */
                            @media screen and (max-width:600px) {
                                h1 {
                                    font-size: 32px !important;
                                    line-height: 32px !important;
                                }
                            }
                    
                            /* ANDROID CENTER FIX */
                            div[style*="margin: 16px 0;"] {
                                margin: 0 !important;
                            }
                        </style>
                    </head>
                    
                    <body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
                        <!-- HIDDEN PREHEADER TEXT -->
                        <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: \'Lato\', Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;"> Nous sommes ravis de vous avoir ici ! Préparez-vous à plonger dans votre nouveau compte.
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <!-- LOGO -->
                            <tr>
                                <td bgcolor="#FFA73B" align="center">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                        <tr>
                                            <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#FFA73B" align="center" style="padding: 0px 10px 0px 10px;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                        <tr>
                                            <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                                                <h1 style="font-size: 48px; font-weight: 400; margin: 2;">Welcome!</h1> <img src="https://i.ibb.co/wYxy7DB/logo.png" width="400" height="120" style="display: block; border: 0px;" />
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                        <tr>
                                            <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                                <p style="margin: 0;">Nous sommes ravis que vous commenciez. Tout d\'abord, vous devez confirmer votre compte. Pour cela, saisissez ce code sur notre site web :</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#ffffff" align="left">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
                                                            <table border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                    <td align="center" style="border-radius: 3px;" bgcolor="#ff3b3b"><p style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; padding: 20px 50px; border-radius: 2px; border: 1px solid #ff3b3b; width="auto"; display: block;">&emsp;&emsp;&nbsp;' . $code . '&emsp;&emsp;<span style="color: #ff3b3b;">.</span></p></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr> <!-- COPY -->
                                        <tr>
                                            <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                                <p style="margin: 0;">Si cela ne fonctionne pas, merci de nous contacter &agrave; cette adresse email :</p>
                                            </td>
                                        </tr> <!-- COPY -->
                                        <tr>
                                            <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                                <p style="margin: 0;"><a href="#" target="_blank" style="color: #ff3b3b;">contact@wizanimes.fr</a></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                                <p style="margin: 0;">Si vous avez des questions, r&eacute;pondez simplement &agrave; cet e-mail. Nous serons toujours ravis de vous aider.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                                <p style="margin: 0;">Nous sommes heureux que vous soyez l&agrave; !<br>L\'&eacute;quipe de wizanimes</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0px 10px;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                        <tr>
                                            <td bgcolor="#FFECD1" align="center" style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                                <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">Need more help?</h2>
                                                <p style="margin: 0;"><a href="#" target="_blank" style="color: #ff3b3b;">We&rsquo;re here to help you out</a></p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                        <tr>
                                            <td bgcolor="#f4f4f4" align="left" style="padding: 0px 30px 30px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;"> <br>
                                                <p style="margin: 0;">If these emails get annoying, please feel free to <a href="#" target="_blank" style="color: #111111; font-weight: 700;">unsubscribe</a>.</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </body>
                    
                    </html>';

            
            if (mail($mail_to, $subject, $message, implode("\r\n", $headers))) {
                $info = "Nous avons envoyé un code de vérification à votre adresse e-mail - $mail";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $mail;
                $_SESSION['password'] = $mdp;
                header('location: user-otp');
                exit();
            } else {
                $errors['otp-error'] = "Échec lors de l'envoi du code !";
            }
        } else {
            $errors['db-error'] = "Échec lors de l'insertion des données dans la base de données !";
        }
    }
}

//if user click verification code submit button
if (isset($_POST['check'])) {
    $_SESSION['info'] = "";
    $otp_code = htmlentities(trim($_POST['otp']));
    $check_code = $DB->prepare("SELECT * FROM utilisateur WHERE email = ?");
    $check_code->execute(array($_SESSION['email']));
    $code_res = $check_code->fetch();

    if ($code_res['code'] == $otp_code) {
        $fetch_code = $code_res['code'];
        $email = $code_res['email'];
        $code = 0;
        $status = 'verified';
        $update_otp = $DB->prepare("UPDATE utilisateur SET code = $code, status = '$status' WHERE code = ?");
        $update_otp->execute(array($fetch_code));
        if ($update_otp) {
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            header('location: ../');
            exit();
        } else {
            $errors['otp-error'] = "Échec lors de la mise à jour du code !";
        }
    } else {
        $errors['otp-error'] = "Vous avez saisi un code incorrect !";
    }
}


if (isset($_POST['connexion'])) {
    $valid = true;
    $mail = htmlentities(strtolower(trim($_POST['mail'])));
    $mdp = trim($_POST['mdp']);

    if (empty($mail)) { // Vérification qu'il y est bien un mail de renseigné
        $valid = false;
        $er_mail = "Il faut mettre un mail";
    }

    if (empty($mdp)) { // Vérification qu'il y est bien un mot de passe de renseigné
        $valid = false;
        $er_mdp = "Il faut mettre un mot de passe";
    }

    if ($valid) {
        // On fait une requête pour savoir si le couple mail / mot de passe existe bien car le mail est unique !
        $req = $DB->prepare("SELECT passwords 
            FROM utilisateur 
            WHERE email = ? ");
        $req->execute(array($mail));
        $req = $req->fetch();

        if (isset($req['passwords'])) {
            if (!password_verify($mdp, $req['passwords'])) {
                if (empty($_SESSION['login_fail'])) { //si la session est vide
                    $_SESSION['login_fail'] = 1; //one incrémente de 1
                    $_SESSION['login_time'] = time() + 60 * 3; // et ici aussi time()
                } else {
                    $_SESSION['login_fail']++;
                }
                $er_connexion = "Le mail ou le mot de passe est incorrecte";
                $valid = false;
            }


            if (!empty($_SESSION['login_time']) && $_SESSION['login_time'] < time()) { // on vide la session une fois le temps écoulé
                unset($_SESSION['login_fail']);
                unset($_SESSION['login_time']);
            }

            if (!empty($_SESSION['login_fail']) && $_SESSION['login_fail'] >= 5) { // si la session fail n'est pas vide on redirige
                date_default_timezone_set('Europe/Paris');
                $er_connexion = 'Vous avez entré de mauvais identifiants 10 fois de suite il vous faut attendre ' . date('H\hi', $_SESSION['login_time']) . ' pour réessayer';
                $valid = false;
            }
        } else {
            $er_connexion = "Le mail ou le mot de passe est incorrecte";
            $valid = false;

            if (empty($_SESSION['login_fail'])) { //si la session et vide
                $_SESSION['login_fail'] = 1; //one incrémente de 1
                $_SESSION['login_time'] = time() + 60 * 3; // et ici aussi time()
            } else {
                $_SESSION['login_fail']++;
            }
            $er_connexion = "Le mail ou le mot de passe est incorrecte";
            $valid = false;
        }


        if (!empty($_SESSION['login_time']) && $_SESSION['login_time'] < time()) { // on vide la session une fois le temps écoulé
            unset($_SESSION['login_fail']);
            unset($_SESSION['login_time']);
        }

        if (!empty($_SESSION['login_fail']) && $_SESSION['login_fail'] >= 6) { // si la session fail n'est pas vide on redirige
            date_default_timezone_set('Europe/Paris');
            $er_connexion = 'Vous avez entré de mauvais identifiants 10 fois de suite il vous faut attendre ' . date('H\hi', $_SESSION['login_time']) . ' pour réessayer';
            $valid = false;
        }
    }

    if ($valid) {
        $req = $DB->prepare("SELECT * 
          FROM utilisateur 
          WHERE email = ? ");
        $req->execute(array($mail));
        $req_user = $req->fetch();

        // S'il y a un résultat alors on va charger la SESSION de l'utilisateur en utilisateur les variables $_SESSION
        if (isset($req_user['id'])) {
            if ($req_user['status'] == 'verified') {
                $_SESSION['id'] = $req_user['id']; // id de l'utilisateur unique pour les requêtes futures
                $_SESSION['nom'] = $req_user['lastName'];
                $_SESSION['prenom'] = $req_user['firstName'];
                $_SESSION['mail'] = $req_user['email'];

                header('Location:  ../');
                exit;
            } else {
                $info = "Il semble que vous n'ayez pas encore vérifié votre adresse e-mail - $email";
                $_SESSION['info'] = $info;
                header('location: user-otp.php');
            }
        }
    }
}


//if user click continue button in forgot password form
if (isset($_POST['check-email'])) {
    $email = htmlentities(strtolower(trim($_POST['email'])));
    $check_email = $DB->prepare("SELECT * FROM utilisateur WHERE email ='$email'");
    $check_email->execute();
    $check_email = $check_email->fetch();

    if (isset($check_email["email"])) {
        $code = rand(999999, 111111);
        $insert_code = $DB->prepare("UPDATE utilisateur SET code = $code WHERE email = '$email'");
        $insert_code->execute();
        if ($insert_code) {

            $subject = 'Wizanimes: R&eacute;initialisation du mot de passe';

            // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=iso-8859-1';
            $headers[] = 'From: Wizanimes <contact@wizanimes.fr>';
            
            //  Mail HTML
            $message = '<!DOCTYPE html>
                    <html>
                    
                    <head>
                        <title></title>
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                        <style type="text/css">
                            @media screen {
                                @font-face {
                                    font-family: \'Lato\';
                                    font-style: normal;
                                    font-weight: 400;
                                    src: local(\'Lato Regular\'), local(\'Lato-Regular\'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format(\'woff\');
                                }
                    
                                @font-face {
                                    font-family: \'Lato\';
                                    font-style: normal;
                                    font-weight: 700;
                                    src: local(\'Lato Bold\'), local(\'Lato-Bold\'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format(\'woff\');
                                }
                    
                                @font-face {
                                    font-family: \'Lato\';
                                    font-style: italic;
                                    font-weight: 400;
                                    src: local(\'Lato Italic\'), local(\'Lato-Italic\'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format(\'woff\');
                                }
                    
                                @font-face {
                                    font-family: \'Lato\';
                                    font-style: italic;
                                    font-weight: 700;
                                    src: local(\'Lato Bold Italic\'), local(\'Lato-BoldItalic\'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format(\'woff\');
                                }
                            }
                    
                            /* CLIENT-SPECIFIC STYLES */
                            body,
                            table,
                            td,
                            a {
                                -webkit-text-size-adjust: 100%;
                                -ms-text-size-adjust: 100%;
                            }
                    
                            table,
                            td {
                                mso-table-lspace: 0pt;
                                mso-table-rspace: 0pt;
                            }
                    
                            img {
                                -ms-interpolation-mode: bicubic;
                            }
                    
                            /* RESET STYLES */
                            img {
                                border: 0;
                                height: auto;
                                line-height: 100%;
                                outline: none;
                                text-decoration: none;
                            }
                    
                            table {
                                border-collapse: collapse !important;
                            }
                    
                            body {
                                height: 100% !important;
                                margin: 0 !important;
                                padding: 0 !important;
                                width: 100% !important;
                            }
                    
                            /* iOS BLUE LINKS */
                            a[x-apple-data-detectors] {
                                color: inherit !important;
                                text-decoration: none !important;
                                font-size: inherit !important;
                                font-family: inherit !important;
                                font-weight: inherit !important;
                                line-height: inherit !important;
                            }
                    
                            /* MOBILE STYLES */
                            @media screen and (max-width:600px) {
                                h1 {
                                    font-size: 32px !important;
                                    line-height: 32px !important;
                                }
                            }
                    
                            /* ANDROID CENTER FIX */
                            div[style*="margin: 16px 0;"] {
                                margin: 0 !important;
                            }
                        </style>
                    </head>
                    
                    <body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
                        <!-- HIDDEN PREHEADER TEXT -->
                        <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: \'Lato\', Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;"> Nous sommes ravis de vous avoir ici ! Préparez-vous à plonger dans votre nouveau compte.
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <!-- LOGO -->
                            <tr>
                                <td bgcolor="#FFA73B" align="center">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                        <tr>
                                            <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#FFA73B" align="center" style="padding: 0px 10px 0px 10px;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                        <tr>
                                            <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                                                <h1 style="font-size: 48px; font-weight: 400; margin: 2;">Welcome!</h1> <img src="https://i.ibb.co/wYxy7DB/logo.png" width="400" height="120" style="display: block; border: 0px;" />
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                        <tr>
                                            <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                                <p style="margin: 0;">Quelqu\'un a demand&eacute; un nouveau mot de passe pour le compte Wizanimes associ&eacute; &agrave; ' . $email .'.<br/>Aucune modification n\'a encore &eacute;t&eacute; apport&eacute;e &agrave; votre compte.</p>
                                            </td>
                                        </tr>
                                        <tr>

                                        <tr>
                                            <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                                <p style="margin: 0;">Vous pouvez r&eacute;initialiser votre mot de passe en saisissant ce code sur notre site web :</p>
                                            </td>
                                        </tr>
                                        <tr>

                                            <td bgcolor="#ffffff" align="left">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
                                                            <table border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                    <td align="center" style="border-radius: 3px;" bgcolor="#ff3b3b"><p style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; padding: 20px 50px; border-radius: 2px; border: 1px solid #ff3b3b; width="auto"; display: block;">&emsp;&emsp;&nbsp;' . $code . '&emsp;&emsp;<span style="color: #ff3b3b;">.</span></p></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr> <!-- COPY -->
                                        <tr>
                                            <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                                <p style="margin: 0;">Si cela ne fonctionne pas, merci de nous contacter &agrave; cette adresse email :</p>
                                            </td>
                                        </tr> <!-- COPY -->
                                        <tr>
                                            <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                                <p style="margin: 0;"><a href="#" target="_blank" style="color: #ff3b3b;">contact@wizanimes.fr</a></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                                <p style="margin: 0;">Si vous n\'avez pas demand&eacute; de nouveau mot de passe, veuillez nous en informer imm&eacute;diatement &agrave; cette adresse email : </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                                <p style="margin: 0;"><a href="#" target="_blank" style="color: #ff3b3b;">contact@wizanimes.fr</a></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                                <p style="margin: 0;">Nous sommes heureux que vous soyez l&agrave; !<br>L\'&eacute;quipe de wizanimes</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#f4f4f4" align="center" style="padding: 30px 10px 0px 10px;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                        <tr>
                                            <td bgcolor="#FFECD1" align="center" style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                                <h2 style="font-size: 20px; font-weight: 400; color: #111111; margin: 0;">Need more help?</h2>
                                                <p style="margin: 0;"><a href="#" target="_blank" style="color: #ff3b3b;">We&rsquo;re here to help you out</a></p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                        <tr>
                                            <td bgcolor="#f4f4f4" align="left" style="padding: 0px 30px 30px 30px; color: #666666; font-family: \'Lato\', Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;"> <br>
                                                <p style="margin: 0;">If these emails get annoying, please feel free to <a href="#" target="_blank" style="color: #111111; font-weight: 700;">unsubscribe</a>.</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </body>
                    
                    </html>';

            if (mail($email, $subject, $message, implode("\r\n", $headers))) {
                $info = "Nous avons envoyé un mot de passe de réinitialisation du mot de passe à votre adresse e-mail - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: reset-code');
                exit();
            } else {
                $errors['otp-error'] = "Échec lors de l'envoi du code par mail !";
            }
        } else {
            $errors['db-error'] = "Quelque chose s'est mal passé !";
        }
    } else {
        $errors['email'] = "Cette adresse e-mail n'existe pas !";
    }
}

//if user click check reset otp button
if (isset($_POST['check-reset-otp'])) {
    $_SESSION['info'] = "";
    $otp_code = htmlentities(trim($_POST['otp']));
    $check_code = $DB->prepare("SELECT * FROM utilisateur WHERE email = ?");
    $check_code->execute(array($_SESSION['email']));
    $code_res = $check_code->fetch();

    if ($code_res['code'] == $otp_code) {
        $fetch_code = $code_res['code'];
        $email = $code_res['email'];
        $_SESSION['email'] = $email;
        $info = "Veuillez créer un nouveau mot de passe que vous n'utilisez sur aucun autre site.";
        $_SESSION['info'] = $info;
        header('location: new-password');
        exit();
    } else {
        $errors['otp-error'] = "Vous avez saisi un code incorrect !";
    }
}

//if user click change password button
if (isset($_POST['change-password'])) {
    $_SESSION['info'] = "";
    $password = trim($_POST['password']);
    $cpassword = trim($_POST['cpassword']);
    if ($password !== $cpassword) {
        $errors['password'] = "Confirmer le mot de passe ne correspond pas !";
    } else {
        $code = 0;
        $email = $_SESSION['email']; //getting this email using session
        $encpass = password_hash($password, PASSWORD_ARGON2ID);
        $update_pass = $DB->prepare("UPDATE utilisateur SET code = $code, passwords = '$encpass' WHERE email = '$email'");
        $update_pass->execute();

        if ($update_pass) {
            $info = "Votre mot de passe a changé. Vous pouvez maintenant vous connecter avec votre nouveau mot de passe.";
            $_SESSION['info'] = $info;
            header('Location: password-changed');
        } else {
            $errors['db-error'] = "Échec de la modification de votre mot de passe !";
        }
    }
}

//if login now button click
if (isset($_POST['login-now'])) {
    header('Location: connexion');
}
