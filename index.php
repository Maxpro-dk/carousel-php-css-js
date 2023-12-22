<?php 

$images = [];
$dossierImages = 'images';

// Liste des extensions d'images autorisées
$extensionsAutorisees = ['jpg', 'jpeg', 'png', 'gif'];

// Ouvrir le dossier
if ($handle = opendir($dossierImages)) {

    while (false !== ($fichier = readdir($handle))) {

        // Ignorer les fichiers spéciaux
        if ($fichier != '.' && $fichier != '..') {

            // Récupérer l'extension du fichier
            $infoFichier = pathinfo($fichier);
            $extension = strtolower($infoFichier['extension']);

            // Vérifier si l'extension est autorisée
            if (in_array($extension, $extensionsAutorisees)) {
          


                // Construire le chemin relatif
                $cheminRelatif = $dossierImages . '/' . $fichier;
                // Ajouter le chemin relatif au tableau
                $images[] = $cheminRelatif;
            }
        }
    }

    // Fermer le dossier
    closedir($handle);
}





$uploadDirectory = 'images/';

// Messages d'erreur
$errors = [];

// Validation du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si le fichier a été téléchargé sans erreur
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Vérifier la taille du fichier
        if ($_FILES['image']['size'] <= 200000) { // 200 kilooctets
            // Vérifier le type de fichier (vous pouvez ajouter d'autres types si nécessaire)
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($_FILES['image']['type'], $allowedTypes)) {
                // Déplacer le fichier vers le dossier d'upload
                $uploadFilePath = $uploadDirectory . time(). basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], $uploadFilePath);
                // Fichier enregistré avec succès
                $successMessage = 'Fichier enregistré avec succès.';
            } else {
                $errors[] = 'Seuls les fichiers JPEG, PNG et GIF sont autorisés.';
            }
        } else {
            $errors[] = 'La taille du fichier ne doit pas dépasser 200 kilooctets.';
        }
    } else {
        $errors[] = 'Erreur lors de l\'enregistrement du fichier. Veuillez réessayer.';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Ajouter la feuille de style Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


    <style>
        .carousel-indicators li {
            background-color: #bbb;
            border: 1px solid #ccc;
            border-radius: 50%;
            width: 10px;
            height: 10px;
            margin: 0 4px;
            cursor: pointer;
        }
    
        .carousel-indicators .active {
            background-color: #040000;
        }
        @media only screen and (min-width: 768px) {
             body{
                padding-right: 20% !important;
    padding-left: 20% !important;
    padding-right: 20%;
    background: linear-gradient(99.6deg, rgb(112, 128, 152) 10.6%, rgb(242, 227, 234) 32.9%, rgb(234, 202, 213) 52.7%, rgb(220, 227, 239) 72.8%, rgb(185, 205, 227) 81.1%, rgb(154, 180, 212) 102.4%);
             }
            }

            body{
    
                    background: linear-gradient(99.6deg, rgb(112, 128, 152) 10.6%, rgb(242, 227, 234) 32.9%, rgb(234, 202, 213) 52.7%, rgb(220, 227, 239) 72.8%, rgb(185, 205, 227) 81.1%, rgb(154, 180, 212) 102.4%);
             }

            .btn{

                margin-bottom: 40px;
                background: linear-gradient(99.6deg, rgb(112, 128, 152) 10.6%, rgb(242, 227, 234) 32.9%, rgb(234, 202, 213) 52.7%, rgb(220, 227, 239) 72.8%, rgb(185, 205, 227) 81.1%, rgb(154, 180, 212) 102.4%) !important;
            }

    </style>
    
</head>

<body class="container-fluid">

    <div id="carousel-container" class="container   pt-4">
        <div id="carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
            
                <?php if(is_array($images)): ?>
                    <?php foreach ($images as $key => $img): ?>
                        <div class="carousel-item  <?= $key == 0 ? "active" :"";  ?> ">
                        
                            <div class="">
                                <img class="d-block w-100 rounded" src="<?= $img ?>" alt="art de la programmation <?= $key ?> ">
                                <div class="text-center mt-3">
                                    <a href="" class="text-decoration-none">
                                        <h6 class="" style="font-size: 20px; color: black; font-weight: bolder;">L'ART DE LA  PROGRAMMATION <?= $key ?></h6>
                                        <p style="font-size: 14px; color: black;">
                                            Un codeur, C'est un artiste du nouveau monde
                                        </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php  endforeach; ?>
                <?php  endif; ?>
             
            </div>
            <!-- Carousel Indicators -->
            <div class="pt-4">
                <ol class="carousel-indicators">
                    <li data-target="#carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel" data-slide-to="1"></li>
                </ol>
            </div>            
        </div>
    </div>
    <?php shuffle($images); ?>
    <?php if( is_array($images) && count($images)>6): ?>
    <div class="container ">
        <div class="row pb-4">
            <div class="col-6">
                <img class="d-block w-100 rounded " src="<?= $images[rand(0,10)]; ?>" alt="Image 1">
            </div>
            <div class="col-6">
                <img class="d-block w-100 rounded" src="<?= $images[rand(0,10)]; ?>" alt="Image 1">
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-12">
                <img class="d-block w-100 rounded" src="<?= $images[rand(0,10)]; ?>" alt="Image 1">
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-6">
                <img class="d-block w-100 rounded" src="<?= $images[rand(0,10)]; ?>" alt="Image 1">
            </div>
            <div class="col-6">
                <img class="d-block w-100 rounded" src="<?= $images[rand(0,10)]; ?>" alt="Image 1">
            </div>
        </div>
    </div>
    <?php endif ?>


    <div class="container mt-5">
        <div class="row justify-content-center text-center">
            <div class="col-md-6">
                <h6>Formulaire d'enregistrement d'image</h6>
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?= $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if (isset($successMessage)): ?>
                    <div class="alert alert-success"><?= $successMessage; ?></div>
                <?php endif; ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary mx-auto">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>







    <!-- Ajouter le script Bootstrap JavaScript et jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>

    </script>
</body>

</html>