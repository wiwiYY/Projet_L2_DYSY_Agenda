<!-- si i ly a erreur afficher sans la partie php -->
<?php

session_start();
if(isset($_SESSION['user'])){
  header("Location: ../session_on/index.php");
}else {
  //a remplir selon le BDD
  $bdd=new PDO("mysql:host=localhost;dbname=dysy_db;charset=utf8","root","");

  if(isset($_POST['Connecter'])){
    if(isset($_POST['email']) && isset($_POST['password'])){
      if(!empty($_POST['email']) && !empty($_POST['password'])){

        $email=htmlspecialchars($_POST['email']);
        $password=htmlspecialchars($_POST['password']);  

        $req=$bdd -> prepare("SELECT * FROM users WHERE email=? AND password=? ");
        $req -> execute(array($email,sha1($password)));


        if($req->rowCount() == 1){

          $user =$req -> fetch();
          $_SESSION['user']= $user;             //création de variable de session 
        
          header("Location: ../session_on/index.php");

        }else{
          $error = "Email ou mot de passe incorrect !";
        }
      }
    }else{
      $error = "Veuillez remplir tous les champs !";
    }
  }
}
?>

    <?php if (isset($error)){echo $error;}                //affiche le smessage d'error dans le cas correspondant aux "else ou on est entré" ?> 


<!DOCTYPE html>
<html lang="en">
    <head>
      <title>DYSY Agenda - Se Connecter</title>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="../../css/dysy_connexion_inscription.css">
      <link rel="shortcut icon" type="image/x-icon" href="../../assets/agenda2.png" />
      <!-- Lien police -->
      <link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah|Hind+Guntur" rel="stylesheet">

      <!-- Inutile 
        <script src="JS/dysyConnexion2JS.js"></script> -->

      <style>
        .btn-signin {
          background-color: #2573D3 !important;
        }
        .logo {
          font-family: 'Gloria Hallelujah', cursive;
          font-size: 20px;
        }
        .menu {
          font-family: 'Hind Guntur', sans-serif;
          font-size: 20px;
        }
      </style>

    </head>

    <body>
        <!-- navigation bar -->
        <header class="containerfluid header">
            <div class="container">
              <a href="dysyPage.php" class="logo">DYSY Agenda</a>
    
              <nav class="menu">
                <a href="dysyContactezNous.php">Contact</a>
              </nav>
          </div>
        </header>

        <!-- formulaire de connection -->
      <div class="container">
        <div class="frame">
          <div class="nav">
            <ul class="links">
              <li class="signin-active"><a class="btn">Se Connecter</a></li>
              <li class="signup-inactive"><a href="dysy_SignIn.php" class="btn">S'Inscrire</a></li>
            </ul>
          </div>
          <div>
            <form class="form-signin" action="dysy_Login.php" method="POST" name="form">
              <label for="email">Adresse mail</label>
              <input class="form-styling" type="text" name="email" placeholder="">
              <label for="password">Mot de passe</label>
              <input class="form-styling" type="password" name="password" placeholder="">

            <div class="btn-animate">
              <button type="submit" class="btn-signin"  name="Connecter">Se Connecter</button>
            </div>

            <div class="forgot">
            <label><a href="mdp.php">J'ai oublié mon mot de passe</a></label>
            </div>
            </form>
          </div>
        </div>
      </div>

<!-- footer -->
<?php include 'template/dysy_footer.php'?>
    
    </body>

</html>

   
