
<?php

session_start();                    //pour accédé au variable de session il faut obligatoirement faire un session start, pour pouvoir par la suite arreter la session en cours.

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
    <title>DYSY Agenda - Déconnexion</title>
	<meta charset="utf-8">
	<!-- lien fichier css -->
	<link rel="stylesheet" type="text/css" href="../../css/deconnexion.css">
	
	<!-- lien d'image -->
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/agenda2.png">
    <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
    </head>

    <body>
        <!-- header -->
        <?php include 'template/dysy_nav_bar_basic.php'?>

    <div>
        <div class="mainContain">
            <div class="texte">
                <h2>Vous avez bien été déconnecté.</h2>
                <h3>A bientôt !</h3>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php

    include 'template/dysy_footer.php';

    session_destroy();

    // faire une redirection vers la page de connection 
    ?>

        </header>

        <footer class="containerfluid contact">
            
        </footer>
</body>
