<?php
session_start();
// Connexion à la base de données
require_once('bdd.php');
//echo $_POST['title'];
if(isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end'])){
	
	$title = $_POST['title'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$comment = $_POST['comment'];
	$color = $_POST['color'];
	$id_user = $_SESSION['user']['id_user'];

	//ajout sur la bdd
	$sql = "INSERT INTO events(name, begining, ending, comment, color, id_user) values ('$title', '$start', '$end', '$comment', '$color', '$id_user')";
	//$req = $bdd->prepare($sql);
	//$req->execute();
	
	echo $sql;
	
	// message d'erreur si l'evenement n'est pas ajouté
	$query = $bdd->prepare( $sql );
	if ($query == false) {
		$error = "Un problème est survenu";
	}
	$sth = $query->execute();
	if ($sth == false) {
		$error = "Un problème est survenu";
	}
}
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
