<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <title>DYSY Agenda - Accueil</title>
	<meta charset="utf-8">
	<!-- lien fichier css -->
	<link rel="stylesheet" type="text/css" href="../../css/dysyPageCSS.css">
	
	<!-- lien d'image -->
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/agenda2.png">

    <!-- Lien police -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Ubuntu" rel="stylesheet">

    <style>
	    .text1 {
	    	font-family: 'Montserrat', sans-serif;
	    	font-size: 55px;
	    }

    	.text2, .text3, .text4 {
    		font-family: 'Ubuntu', sans-serif;
    	}
    </style>

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
		<div>
			<div class="mainContain">
				<div class="firstContain">
					<div class="text1">
						<h3>DYSY Agenda</h3>
					</div>
				</div>
	
				<div class="secondContain">
					<div class="text2">
						<h3>Optimisez chacune de vos journées</h3>
						<p>DYSY Agenda, <br> facilite la gestion de votre agenda <br> et vous fait gagner du temps</p>
					</div>						
				</div>

				<div class="thirdContain">
					<div class="text3">
					
					<!-- <div id="maVideo">
						<video autoplay loop muted id="firstContainVideo">
							<source src="../video/firstContainVideo.mp4"></source>
						</video>
					</div> -->
						<h3>Vue sur votre planning</h3>
						<p>L'Interface Planning Interactive<br>
							de votre agenda vous aide à y voir plus clair</p>
					</div>
				</div>

				<div class="fourthContain">
					<div class="text4">
						<h3>Action facile</h3>
						<p">Ajouter - Modifier - Supprimer,<br>
							Un évènement en toute simplicité</p>
					</div>
				</div>
			</div>
		</div>
				
			
		
		<!-- footer -->
        <?php include 'template/dysy_footer.php'?>

    </body>
</html>