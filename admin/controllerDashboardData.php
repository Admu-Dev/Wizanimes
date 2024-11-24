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

/*
  for ($i = 1; $i <= 220; $i++) {
    
    $name2 = "Naruto+-+$i+VOSTFR.avi.mp4";
    $Categorie2 = "Naruto";
    $target_file2 = "../upload/videos/$name2";

    $DB->insert("INSERT INTO videos (name, AnimeName, location) VALUES 
  (?, ?, ?)",
  array($name2, $Categorie2, $target_file2));
  }
*/


$CountNameAnime = $DB->prepare("SELECT *
  FROM images");
  $CountNameAnime->execute();

$CountNameAnime = $CountNameAnime->fetchAll();

$sql = $DB->prepare('SELECT COUNT(*) AS nb FROM images');
$sql->execute();

$columns = $sql->fetch();
$nb = $columns['nb'];






//  Formulaire supprimer un Anime
if (isset($_POST['video_remove'])) {
    $CategorieAnime  = htmlentities(trim($_POST['CategorieAnime']));

    if ($CategorieAnime !== 'hide') {

        $Select = $DB->prepare("SELECT * FROM videos WHERE AnimeName = '$CategorieAnime'");
        $Select->execute();

        $test = $Select->fetch();

        $caractere = strlen($test['name']);
        $dir = substr($test['location'], 0, -$caractere);

        function deleteTree($dir)
        {
            foreach (glob($dir . "/*") as $element) {
                if (is_dir($element)) {
                    deleteTree($element); // On rappel la fonction deleteTree           
                    rmdir($element); // Une fois le dossier courant vidé, on le supprime
                } else { // Sinon c'est un fichier, on le supprime
                    unlink($element);
                }
                // On passe à l'élément suivant
            }
        }

        deleteTree($dir); // On vide le contenu de notre dossier
        rmdir($dir); // Et on le supprimer

        $DeleteVideo = $DB->prepare("DELETE FROM videos WHERE AnimeName = '$CategorieAnime'");
        $DeleteVideo->execute();

        $DeleteImage = $DB->prepare("DELETE FROM images WHERE NameAnime = '$CategorieAnime'");
        $DeleteImage->execute();





        header('Location: ../');
        exit;
    } else {
        $_SESSION['message-remove'] = "Veuillez selectionner une Catégorie svp !";
    }
}


define('TARGET', '../upload/images/');    // Repertoire cible
define('MAX_SIZE', 10485760);    // Taille max en octets du fichier
define('WIDTH_MAX', 4000);    // Largeur max de l'image en pixels
define('HEIGHT_MAX', 4000);    // Hauteur max de l'image en pixels

$tabExt = array('jpg', 'gif', 'png', 'jpeg');    // Extensions autorisees
$infosImg = array();

$extension = '';
$message = '';
$nomImage = '';


if (!is_dir(TARGET)) {
    if (!mkdir(TARGET, 0755)) {
        exit('Erreur : le répertoire cible ne peut-être créé ! Vérifiez que vous diposiez des droits suffisants pour le faire ou créez le manuellement !');
    }
}

//  Formulaire ajout de la card de l'anime
if(isset($_POST['submit_images'])) {

    $nom  = htmlentities(trim($_POST['nom']));
    $Categorie  = htmlentities(trim($_POST['Categorie']));
    echo $nom;
    echo $Categorie;

    if ($Categorie !== 'hide') {

        // On verifie si le champ est rempli
        if (!empty($_FILES['fichier']['name'])) {
            // Recuperation de l'extension du fichier
            $extension  = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);

            // On verifie l'extension du fichier
            if (in_array(strtolower($extension), $tabExt)) {
                // On recupere les dimensions du fichier
                $infosImg = getimagesize($_FILES['fichier']['tmp_name']);

                // On verifie le type de l'image
                if ($infosImg[2] >= 1 && $infosImg[2] <= 14) {
                    // On verifie les dimensions et taille de l'image
                    if (($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize($_FILES['fichier']['tmp_name']) <= MAX_SIZE)) {
                        // Parcours du tableau d'erreurs
                        if (isset($_FILES['fichier']['error']) && UPLOAD_ERR_OK === $_FILES['fichier']['error']) {
                            // On renomme le fichier
                            $nomImage = md5(uniqid()) . '.' . $extension;

                            // Si c'est OK, on teste l'upload
                            if (move_uploaded_file($_FILES['fichier']['tmp_name'], TARGET . $nomImage)) {
                                $date_ajout = date('Y-m-d H:i:s');
                                $message = 'Upload réussi !';

                                mkdir("../upload/videos/$nom", 0700);

                                $insert = $DB->prepare("INSERT INTO images (img, NameAnime, categorie, date_ajout) VALUES 
                        (?, ?, ?, ?)");
                                $insert->execute(array($nomImage, $nom, $Categorie, $date_ajout));

                                header('Location: ../');
                                exit;
                            } else {
                                // Sinon on affiche une erreur systeme
                                $message = 'Problème lors de l\'upload !';
                            }
                        } else {
                            $message = 'Une erreur interne a empêché l\'uplaod de l\'image';
                        }
                    } else {
                        // Sinon erreur sur les dimensions et taille de l'image
                        $message = 'Erreur dans les dimensions de l\'image !';
                    }
                } else {
                    // Sinon erreur sur le type de l'image
                    $message = 'Le fichier à uploader n\'est pas une image !';
                }
            } else {
                // Sinon on affiche une erreur pour l'extension
                $message = 'L\'extension du fichier est incorrecte !';
            }
        } else {
            $message = 'Veuillez selectionner une Catégorie svp !';
        }
    } else {
        $message = 'Veuillez remplir le formulaire svp !';
    }
}



//   Formulaire ajout des videos
if(isset($_POST['video_upload'])) {
    $maxsize = 524288000; // 5MB
    $AllAnimes = htmlentities(trim($_POST['AllAnimes']));
    $season  = htmlentities(trim($_POST['season']));

    if ($AllAnimes !== 'hide') {

        if ($season !== null) {

            if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
                $name = $_FILES['file']['name'];
                $target_dir = "../upload/videos/$AllAnimes/";
                $target_file = $target_dir . $_FILES["file"]["name"];

                // Select file type
                $extension_video = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Valid file extensions
                $extensions_arr = array("mp4", "avi", "3gp", "mov", "mpeg");

                // Check extension
                if (in_array($extension_video, $extensions_arr)) {

                    // Check file size
                    if (($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
                        $_SESSION['message_upload'] = "File too large. File must be less than 5MB.";
                    } else {
                        // Upload
                        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                            // Insert record
                            $Upload = $DB->prepare("INSERT INTO videos (name, AnimeName, location, season) VALUES 
                            (?, ?, ?, ?)");
                            $Upload->execute(array($name, $AllAnimes, $target_file, $season));

                            $Upload = $Upload->fetch();

                            $_SESSION['message_upload'] = "Upload successfully.";
                            header('Location: ../');
                            exit;
                        }
                    }
                } else {
                    $_SESSION['message_upload'] = "L'extension du fichier est invalide ! ";
                }
            } else {
                $_SESSION['message_upload'] = "Veuillez remplir le formulaire svp !";
            }
        } else {
            $_SESSION['message_upload'] = "Veuillez selectionner la saison de l'episode svp !";
        }
    } else {
        $_SESSION['message_upload'] = "Veuillez selectionner une Catégorie svp !";
    }
 }
