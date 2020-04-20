<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <!-- lien fichier css -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">
        
        <!-- lien d'image -->
        <link rel="shortcut icon" type="image/x-icon" href="../../assets/agenda2.png">

        <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">

        <!-- Lien police -->
        <link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah|Hind+Guntur" rel="stylesheet">

         <!-- Custom CSS -->
        <style>
        img {
            height: 50px;
            padding: 0;
            margin: 0;
            display: inline;  
        }

        .navbar-brand {
            font-family: 'Gloria Hallelujah', cursive;
            font-size: 23px !important;
        }

        .scroll {
            font-family: 'Hind Guntur', sans-serif;
            font-size: 20px !important;
        }
        </style>
    </head>

    <header class="header">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">

                    <!-- Toggle : Menu qui apparait quand la taille de l'écran est trop petit pour tout afficher -->
                  

                    <a href="../session_off/dysyPage.php"><img class="nav navbar-nav navbar-left" src="../../assets/agenda2.png" alt="logo"></a>
                    <a class="navbar-brand" href='../session_off/dysyPage.php'>DYSY Agenda</a> 
                </div>

                <!-- Collect the nav lin../../root_v2/php/dysyPage.phpks, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar menu">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a class="scroll" href='index.php'>Mon Agenda</a></li>
                        <li><a class="scroll" href="Tuto.php">Tutoriel</a></li>
                        <li><a class="scroll" href="../session_off/dysyContactezNous.php">Contact</a></li>
                        <li><a class="scroll" href='Profil.php'>Profil</a></li>
                        <li><a class="scroll" href="../session_off/dysyDeconnexion.php">Déconnexion</a></li> 
                        <a href="../session_off/dysyDeconnexion.php"><img class="nav navbar-nav navbar-left" src="../../assets/Logout.png" alt="logo"></a>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
        </nav>
    </header>
</html>