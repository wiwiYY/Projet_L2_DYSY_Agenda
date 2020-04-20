<?php
session_start();
$bdd = new PDO("mysql:host=localhost;dbname=dysy_db;charset=utf8","root","");

if(isset($_SESSION['user'])){
  header("Location: ../session_on/index.php");
}else {
    if(isset($_POST['inscrit'])){

      if (isset($_POST['name']) AND isset($_POST['firstname']) AND isset($_POST['email']) AND isset($_POST['password']) AND isset($_POST['confirmpassword'])){

        if(!empty($_POST['name']) AND !empty($_POST['firstname']) AND !empty($_POST['email']) AND !empty($_POST['password']) AND !empty($_POST['confirmpassword'])){

          $name=htmlentities(trim($_POST['name'])); 
          //trim permet de l'enlevais les caractère speciaux comme les balise ou autre qui pourrai bloqué 
          $firstname=htmlentities(trim($_POST['firstname']));
          // le bon fonctionnement de l'inscription, "htmlentities" permet entre autre l'enlevé les espace en 
          $email=htmlentities(trim($_POST['email']));                                             //  trop et de bien sécurisé les information entre par l'utilisatur 
          $password=htmlentities(trim($_POST['password']));                                      // les ligne de 13 à 17 serve a créé variable avec ds nom plus court pour la suite 
          $confirmpassword=htmlentities(trim($_POST['confirmpassword']));
          
          if(strlen($name) >= 2 AND strlen($name)<=30 AND strlen($firstname) >= 2 AND strlen($firstname)<=30 ){  
          //conditionne le formulaire 
            if(strlen($email)<= 255){

              if(filter_var($email,FILTER_VALIDATE_EMAIL)){
              //test si le email est valide avec une fonction PHP DEJA existante

                if(strlen($password)>=8 AND strlen($password)<= 20 ){

                  if($password==$confirmpassword){
                  //test que se soit bien le meme MDP

                    $password_crypted = sha1($password);
                    $req = $bdd -> prepare("INSERT INTO users (name, firstname, email,password) VALUES (?,?,?,?)");        
                    // lien de code 32 en SQL pour pouvouir preparé l'inserion des info dans la BDD

                    $req->execute(array($name,$firstname,$email,$password_crypted)); 

                    $error="Votre compte a été créé avec succès !";

                  }else{
                    $error="Vos mots de passe ne correspondent pas !";
                  }
                }else{
                  $error = "Votre mot de passe doit etre compris entre 8 et 20 caractères !";
              }
            }else{
              $error = "Votre email n'est pas valide !";
            }
          }else {
            $error = "Votre email doit faire moins de 255 caractères !";
          }
        }else{
          $error = "Nom et Prénom doivent comporter entre 2 et 30 caractères !";
        }
      }else{
        $error = "Veuillez remplir tous les champs !";
      }
    }
  }
}
?>

<?php 
if (isset($error)){echo $error;}                
//affiche le smessage d'error dans le cas correspondant aux "else ou on est entré" 
?>              

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>DYSY Agenda - S'Inscrire</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../../css/dysy_connexion_inscription.css">
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/agenda2.png" />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <script src="JS/dysyConnexion2JS.js"></script>
    <style>
      .signin {
        background-color: #2573D3 !important;
        position: relative !important;
        padding-left: 150px !important;
      }
      button {
        margin-left: 40px !important;
        padding-right: 200px !important;
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
      <!-- formulaire d'inscription -->
    <div class="container">
      <div class="frame">
        <div class="nav">
          <ul class="links">
            <li class="signin-inactive"><a href="dysy_LogIn.php" class="btn">Se Connecter</a></li>
            <li class="signup-active"><a class="btn">S'Inscrire</a></li>
          </ul>
        </div>

        <div>
        
          <form class="form-styling" action="dysy_SignIn.php" method="POST" name="form">
            <label for="fullname">Nom</label>
              <input class="form-styling" type="text" name="name" placeholder="">
            <label for="fullname">Prénom</label>
              <input class="form-styling" type="text" name="firstname" placeholder="">
            <label for="email">Adresse mail</label>
              <input class="form-styling" type="text" name="email" placeholder="">
            <label for="password">Mot de passe</label>
              <input class="form-styling" type="password" name="password" placeholder="">
            <label for="confirmpassword">Confirmation Mot de passe</label>
              <input class="form-styling" type="password" name="confirmpassword" placeholder="">

            <button type="submit" class="signin" name="inscrit">S'inscrire</button> <!--class="btn-signup">S'Inscrire</a>-->

          </form>
        </div>
      </div>
    </div>

<!-- footer -->
<?php include 'template/dysy_footer.php'?>
    
  </body>
</html>

