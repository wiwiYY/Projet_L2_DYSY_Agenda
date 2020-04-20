<?php 
session_start();
//condition si la session est ouvert
if(!isset($_SESSION['user'])){
  die("Vous n'etes pas connecté !!!");
}else {
  
  $bdd=new PDO("mysql:host=localhost;dbname=dysy_db;charset=utf8","root","");
  // 3 conditions si les champs sont remplis
    if(isset($_POST['modifmdp'])){
      if (isset($_POST['password']) AND isset($_POST['confirmpassword'])){
        if(!empty($_POST['password']) AND !empty($_POST['confirmpassword'])){

          $password=htmlentities(trim($_POST['password']));                      
          $confirmpassword=htmlentities(trim($_POST['confirmpassword']));

          //condition si les mdp on la bonne longueur
          if(strlen($password)>=8 AND strlen($password)<= 20 ){
            //condition si les 2 mdp sont identique
            if($password==$confirmpassword){

              $password_crypted = sha1($password);
              $user=$_SESSION['user']['id_user'];

              $req = $bdd -> prepare(" UPDATE users SET password='$password_crypted' WHERE id_user='$user' ");
              $req-> execute(array($password_crypted));

              $error="Votre mot de passe a été modifié avec succès !";

            }else{
              $error="La confirmation de mot de passe ne correspond pas !";
            }
          }else{
            $error = "Votre mot de passe doit être compris entre 8 et 20 caractères !";
          }
        }else{
          $error = "Veuillez remplir tous les champs !";
        }
      }
    }
}

?>

<?php if (isset($error)){echo $error;}  ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    
        <title>DYSY Agenda - Profil</title>

         <!-- lien d'image -->
        <link rel="shortcut icon" type="image/x-icon" href="../../assets/agenda2.png">

        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"> 

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Police d'écriture -->
        <link href="https://fonts.googleapis.com/css?family=Hind+Guntur|Julius+Sans+One|Kanit|Press+Start+2P" rel="stylesheet">

        <style>
/*Hauteur du container*/
            #mainContainer{
                margin-top:150px;
            }
/*Container bordure*/
            .header-nav-wrap {
                border-style: solid;
                border-width: 3px;
                border-top-color: transparent !important;
                border-radius:20px;
            }
/*Couleur des icones réseaux sociaux*/
            .find-me-on li a {
             color:#39bbdb !important;    
            }
            a:hover{
                text-decoration:none;
            }
/* Espace entre chaque partie */
            .header-module {
              margin: 30px auto;
            }
            .header-module:first-child {
              margin-top: 60px;
            }
            .header-module:last-child {
              margin-bottom: 60px;
            }
            .header-module.header-image-wrapper {
              margin: -1px auto 0 auto;
            }
            .header-module.find-me-on-header {
              margin: 40px auto;
            }
            .has-banner.has-avatar .header-module.blogger-avatar {
              margin-top: 15px;
             /* margin-top: -120px;*/
            }
            .has-nav .header-module:last-child {
              margin-bottom: -20px;
            }
            .has-nav .header-module.find-me-on-header {
              margin-bottom: -24px;
            }
            .minimal-header .header-module.header-logo {
              margin: 80px auto;
            }
            .has-nav .minimal-header .header-module.header-logo {
              margin-top: 80px;
              margin-bottom: 60px;
            }

            .header-image-wrapper {
              position: relative;
              overflow: hidden;
            }

            .header-image {
              display: block;
              width: 100%;
              height: 100%;
              position: relative;
              opacity: 0;
              -webkit-transition: opacity 150ms cubic-bezier(0.455, 0.03, 0.515, 0.955);
              transition: opacity 150ms cubic-bezier(0.455, 0.03, 0.515, 0.955);
            }
            .header-image.loaded {
              opacity: 1;
            }
            .header-image.cover {
              -webkit-background-size: cover;
              background-size: cover;
            }
            .header-image img {
              display: block;
              width: 100%;
              height: auto;
            }

            .blog-header .blogger-avatar {
              display: block;
              width: 120px;
              height: 120px;
              border: none;
              border-radius: 3px;
              overflow: hidden;
              opacity: 1;
              -webkit-transform: translate3d(0, 0, 0);
              transform: translate3d(0, 0, 0);
            }
            .avatar-style-circle .blog-header .blogger-avatar {
              border-radius: 50%;
            }
            .blog-header .blogger-avatar:active {
              -webkit-transform: translate3d(0, 2px, 0);
              transform: translate3d(0, 2px, 0);
            }

            .header-logo {
              font-size: 72px;
              font-weight: 600;
              line-height: 1;
              text-align: center;
            }

            .header-logo-anchor {
              display: inline-block;
              max-width: 70%;
              margin: 0 auto;
              line-height: inherit;
              vertical-align: top;
            }

            .logo-anchor-text,
            .logo-anchor-image-wrapper,
            .logo-anchor-img {
              display: block;
            }

            .logo-anchor-image-wrapper {
              padding-top: 10px;
            }

            .header-description {
              width: 70%;
              max-width: 640px;
              font-size: 16px;
              line-height: 1.4;
              text-align: center;
              color: #666;
            }

            .find-me-on-header {
              width: 50%;
              max-width: 640px;
            }
            .find-me-on-header .find-me-on {
              margin-left: 0;
              text-align: center;
            }

            body,
            .container {
               
            }

            .page,
            .page-wrapper,
            .container::after {
              background-color: #39bbdb;
            }

            .show-aside-overlay .page::after {
              background-color: rgba(56, 57, 77, 0.5);
            }

            /* -- Header -- */
            .header-nav-wrap {
              background-color: #d6d9e1;
              border-color: #dddfe6;
            }

            /* -- Avatar -- */
            .blog-header .blogger-avatar {
              -webkit-box-shadow: 0 0 0 6px #d6d9e1;
              box-shadow: 0 0 0 6px #d6d9e1;
            }

            /* -- Logo -- */
            .header-logo-anchor:link, .header-logo-anchor:visited {
              color: #39bbdb;
            }
            .header-logo-anchor:hover, .header-logo-anchor:focus {
              color: #39bbdb;
            }

            /* -- Description -- */
            .header-description {
              color: rgba(102, 102, 112, 0.7);
            }

            .blog-header {
                height: 800px;
            }
            
            #logo {
              font-family: 'Kanit', sans-serif;
            }
        </style>
    </head>
    
    <body>
      <?php require 'NavBar.php'; ?>
        <div class="container" id="mainContainer">
            <section class="header-nav-wrap content has-banner has-avatar avatar-style-circle has-title has-description has-nav">
                <!-- HEADER begins -->
                <header id="header" class="blog-header" role="banner">
                    <figure id="header-banner" class="header-image-wrapper header-module">
                        <a href="#" class="header-image cover loaded imgLiquid_bgSize imgLiquid_ready">

                          <!-- Image Profil background -->
                            <img src="http://lorempixel.com/800/200/city/9/" alt="banner">
                        </a><!-- /.header-image -->
                    </figure><!-- /.header-image-wrapper -->
                    
                    <a href="#" id="header-avatar" class="blogger-avatar header-module ease">
                        <img src="../../assets/user.png" class="img-responsive" alt="avatar">
                    </a><!-- /.blogger-avatar -->
                    
                    <h1 id="logo" class="logo header-logo header-title header-module ease" style="font-size: 80px;">
                        <p><?php echo ($_SESSION['user']['name'])." ".($_SESSION['user']['firstname']);?></p><!-- /.header-logo-anchor -->
                    </h1><!-- /.header-logo -->
                    
                    <div class="header-description header-module typography">
                         <?php echo ($_SESSION['user']['email']);?><br><br>

                       <form class="" action="Profil.php" method="POST">

                        <label for="password">Modifier le mot de passe :</label>
                        <input class="form-styling" type="password" name="password" placeholder=""><br><br>
                        <label for="confirmpassword">Confirmation du mot de passe :</label>
                        <input class="form-styling" type="password" name="confirmpassword" placeholder=""><br><br>

                        <button type="submit" class="signin btn btn-primary" name="modifmdp">Modifier le mot de passe</button><br><br>

                        <p><?php if (isset($error)){echo $error;}  ?></p>

                       </form>
                    </div><!-- /.header-description -->
                </header><!-- /.blog-header -->
                <!-- HEADER ends -->
            </section>
        </div> 
    </body>
</html>

<?php
require 'Footer.php';
?>
