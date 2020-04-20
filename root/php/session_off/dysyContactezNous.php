<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>DYSY Agenda - Contact</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../../css/contactez_nous.css">
        <link rel="shortcut icon" type="image/x-icon" href="../../assets/agenda2.png">
        <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
        
        <!-- lien d'image -->
        <link rel="shortcut icon" type="image/x-icon" href="template/agenda2.png">
        <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
    </head>
    <body>
        <!-- header -->
        <?php 
			if(isset($_SESSION['user'])){
				include 'template/dysy_nav_bar_basic_session_active.php';
			}
			else {
				include 'template/dysy_nav_bar_basic.php';
			}
		
		?>
        <!-- contenu -->
        <section id="hire">
            <h1>Contactez-nous</h1>
        
            <form action="mailto:test.dysy@gmail.com" >

                <div class="name">
                    <p>Numéro : 01.23.45.67.89</p>
                </div>

                <div class="email">
                    <p>Adresse : 45 rue des saints pères<br>
                    75006,Paris</p>
                </div>

                <div class="msg">
                    <p>E-mail : test.dysy@gmail.com</p>
                </div>

                <!-- <input type="submit" class="button"  value="contactez-nous"> -->
            </form>
        </section>
        <!-- footer -->
        <?php include 'template/dysy_footer.php'?>

        </header>
    </body>
</html>