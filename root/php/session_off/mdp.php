<?php 

//require 'C:\wamp64\www\package\root\assets\PHPMailer\PHPMailerAutoload.php';

session_start();
$bdd=new PDO("mysql:host=localhost;dbname=dysy_db;charset=utf8","root","");

  if (isset($_GET['section'])){
    $section = htmlspecialchars($_GET['section']);
  }
  else {
    $section ="";
  }

  if(isset($_POST['recup_submit'], $_POST['recup_mail'])){
      if(!empty($_POST['recup_mail'])) {
        $recup_mail = htmlspecialchars($_POST['recup_mail']);
        if(filter_var($recup_mail, FILTER_VALIDATE_EMAIL)) {
          $mailexist = $bdd ->prepare('SELECT id_user, name FROM users WHERE email = ?');
          $mailexist -> execute(array($recup_mail)); 
          $mailexist_count = $mailexist->rowCount();
          if($mailexist_count == 1) {
            //On récupère les données sur l'utilisateur (son nom)
            $name = $mailexist->fetch();
            $name = $name['name'];
            var_dump($name);
            $_SESSION['recup_mail'] = $recup_mail;
            //Génère le code qu'on va envoyer par mail
            $recup_code = "";
            for ($i=0; $i < 8; $i++) { 
              $recup_code.= mt_rand(0,9);
            }

            $mail_recup_exist = $bdd->prepare('SELECT id FROM recuperation WHERE mail = ?');
            $mail_recup_exist->execute(array($recup_mail));
            $mail_recup_exist = $mail_recup_exist->rowCount();
            //Si la personne à déjà
            if($mail_recup_exist == 1) {
               $recup_insert = $bdd->prepare('UPDATE recuperation SET code = ? WHERE mail = ?');
               $recup_insert->execute(array($recup_code,$recup_mail));
            } 
            else{
              $recup_insert = $bdd->prepare('INSERT INTO recuperation(mail, code) VALUES (?, ?)');
              $recup_insert -> execute(array($recup_mail,$recup_code));
            }

            /*
            $mail = new PHPmailer();
            // Paramètres SMTP
           $mail->IsSMTP(); // activation des fonctions SMTP
           $mail->SMTPAuth = true; // on l’informe que ce SMTP nécessite une autentification
           //$mail->SMTPSecure = 'ssl'; // protocole utilisé pour sécuriser les mails 'ssl' ou 'tls'
           $mail->Host = "stmp.elasticemail.com"; // définition de l’adresse du serveur SMTP : 25 en local, 465 pour ssl et 587 pour tls
           //$mail->SMTPSecure = 'ssl';
           $mail->Port = 2525; // définition du port du serveur SMTP
           $mail->Username = "test.dysy@gmail.com"; // le nom d’utilisateur SMTP
           $mail->Password = "test2019"; // son mot de passe SMTP

          // Paramètres du mail
           $mail->AddAddress("welkiv.shaker@gmail.com",'Nom'); // ajout du destinataire
           $mail->FromName = "Expediteur"; // nom de l’expéditeur
           $mail->AddReplyTo("test.dysy@gamil.com","Expediteur"); // adresse mail et nom du contact de retour
           $mail->IsHTML(true); // envoi du mail au format HTML
           $mail->Subject = "Sujet"; // sujet du mail
           $mail->Body = "<html>Bonjour</html>"; // le corps de texte du mail en HTML
           $mail->AltBody = "Bonjour"; // le corps de texte du mail en texte brut si le HTML n'est pas supporté
           if(!$mail->Send()) { // envoi du mail
           echo "Mailer Error: " . $mail->ErrorInfo; // affichage des erreurs, s’il y en a
           } 
           else {
           echo  "Le message a bien été envoyé !";
           }
           $mail->SMTPDebug = 2;
          */
           $header="MIME-Version: 1.0\r\n";
           $header.='From:"DYSY"<test.dysy@gmail.com>'."\n";
           $header.='Content-Type:text/html; charset="utf-8"'."\n";
           $header.='Content-Transfer-Encoding: 8bit';
           $message = '
           <html>
           <head>
             <title>Récupération de mot de passe - DYSY</title>
             <meta charset="utf-8" />
           </head>
           <body>
             <font color="#303030";>
               <div align="center">
                 <table width="600px">
                   <tr>
                     <td>
                       
                       <div align="center">Bonjour <b>'.$name.'</b>,</div>
                       Voici votre code de récupération: <b>'.$recup_code.'</b>
                       A bientôt sur <a href="http://http://localhost/package/root/php/session_off/dysy_LogIn.php/">DYSY Agenda</a> !</div>
                       
                     </td>
                   </tr>
                   <tr>
                     <td align="center">
                       <font size="2">
                         Ceci est un email automatique, merci de ne pas y répondre
                       </font>
                     </td>
                   </tr>
                 </table>
               </div>
             </font>
           </body>
           </html>
           ';
           mail($recup_mail, "Récupération de mot de passe - DYSY", $message, $header);
           header("Location:http://localhost/package/root/php/session_off/mdp.php?section=code");
          }
          else {
            $error = "Cette adresse mail n'est pas enregistrée";
          }
        }
        else {
          $error = "Adresse mail invalide";
        }
      }
      else{
        $error = "Veuillez entrer votre adresse mail";
      }
  }

  if(isset($_POST['verif_submit'], $_POST['verif_code'])){
    if(!empty($_POST['verif_code'])){
      $verif_code = htmlspecialchars($_POST['verif_code']);
      $verif_req = $bdd->prepare("SELECT id FROM recuperation WHERE mail = ? AND code = ?");
      $verif_req->execute(array($_SESSION['recup_mail'], $verif_code));
      $verif_req = $verif_req ->rowCount();
      
      if($verif_req == 1){
        $verif_confirm = $bdd->prepare("UPDATE recuperation SET confirm = ? WHERE mail = ?");
        $verif_confirm->execute(array($verif_code, $_SESSION['recup_mail']));
        header('Location:http://localhost/package/root/php/session_off/mdp.php?section=changemdp');
      }
      else{
        $error = "Code incorrect";
      }
    }
    else{
      $error = "Veuillez entrez votre code de confirmation";
    }
  }

  if(isset($_POST['change_submit'])){
    $verif_confirm = $bdd->prepare('SELECT confirm FROM recuperation WHERE mail = ?');
    $verif_confirm->execute(array($_SESSION['recup_mail']));
    $verif_confirm = $verif_confirm->fetch();
    $verif_confirm = $verif_confirm['confirm'];
    
    $verif_code = $bdd->prepare('SELECT code FROM recuperation WHERE mail = ?');
    $verif_code->execute(array($_SESSION['recup_mail']));
    $verif_code = $verif_code->fetch();
    $verif_code = $verif_code['code'];
    
    if(($verif_confirm)==($verif_code)){
      if(isset($_POST['change_mdp'],$_POST['change_confirm'])){
          $mdp=htmlspecialchars($_POST['change_mdp']);
          $confirm=htmlspecialchars($_POST['change_confirm']);
          if(!empty($mdp) AND !empty($confirm)) {
              if($mdp == $confirm){
                if(strlen($mdp)>=8 AND strlen($mdp)<= 20){
                  $mdp = sha1($mdp);
                  $ins_mdp = $bdd->prepare('UPDATE users SET password = ? WHERE email = ?');
                  $ins_mdp->execute(array($mdp,$_SESSION['recup_mail']));
                  $del_req = $bdd->prepare("DELETE FROM recuperation WHERE mail = ?");
                  $del_req->execute(array($_SESSION['recup_mail']));
                  header("Location:dysy_LogIn.php");
                }
                else{
                  $error="Votre mot de passe doit être compris entre 8 et 20 caractères";
                }
              }
              else{
                $error="Vos mots de passe ne correspondent pas";
              }
            
          }
          else{
            $error ="Veuillez remplir tous les champs";
          }
      }
      else {
        $error ="Veuillez remplir tous les champs";
      }
    }
    else {
      $error = "Veuillez entrer le code de confirmation SVP";
    }
  }


?>

<?php if (isset($error)){echo $error;}                
?> 


<!DOCTYPE html>
<html lang="en">
    <head>
      <title>DYSY Agenda - Mot de passe oublié</title>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="../../css/dysy_connexion_inscription.css">
      <link rel="shortcut icon" type="image/x-icon" href="../../assets/agenda2.png" />
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>

      <!-- Inutile 
        <script src="JS/dysyConnexion2JS.js"></script> -->

      <style>
        .btn-signin {
          background-color: #2573D3 !important;
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
          <div>
            
              <form class="form-signin" action="mdp.php" method="POST" name="form">
            <?php if($section =='code') { ?>
              <label for="email">Un code de récupération vous a été envoyé par mail à l'adresse :
                <br />
                <?= $_SESSION['recup_mail']?>
              </label>
              <input class="form-styling" type="text" name="verif_code" placeholder="">

              <div class="btn-animate">
                <button type="submit" class="btn-signin"  name="verif_submit">Valider</button>
              </div>

              <div class="forgot">
              </div>
            <?php } elseif($section == 'changemdp') { ?>
              <label for="email">Nouveau mot de passe pour
              <br />
                <?= $_SESSION['recup_mail']?>
              </label>
              <input class="form-styling" type="password" name="change_mdp" placeholder="">
              <label for="email">Confirmation mot de passe</label>
              <input class="form-styling" type="password" name="change_confirm" placeholder="">
              <div class="btn-animate">
                <button type="submit" class="btn-signin"  name="change_submit">Valider</button>
              </div>

              <div class="forgot">
              </div>
            <?php }   else { ?>
              <label for="email">Votre adresse mail</label>
              <input class="form-styling" type="email" name="recup_mail" placeholder="">

              <div class="btn-animate">
                <button type="submit" class="btn-signin"  name="recup_submit">Valider</button>
              </div>

              <div class="forgot">
              </div>
            <?php } ?>
              </form>

           
          </div>
        </div>
      </div>

<!-- footer -->
<?php include 'template/dysy_footer.php'?>
    
    </body>

</html>