<?php
session_start();
//connexion à la bdd
require_once('bdd.php');

//condition si les champs sont bien remplis
if (isset($_POST['delete']) && isset($_POST['id'])){
		
	$id = $_POST['id'];
	
	//suppression du contenu dans la table events
	$sql = "DELETE FROM events WHERE id_events = $id";

	$query = $bdd->prepare( $sql );
	//message d'erreur
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$res = $query->execute();
	if ($res == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}

	
}elseif (isset($_POST['title']) && isset($_POST['color']) && isset($_POST['id']) && isset($_POST['comment'])){
	
	$id = $_POST['id'];
	$title = $_POST['title'];
	$color = $_POST['color'];
	$comment = $_POST['comment'];

	//mise à jour sur la bdd de la table events
	$sql = "UPDATE events SET  name = '$title', color = '$color', comment = '$comment' WHERE id_events = $id ";

	
	$query = $bdd->prepare( $sql );
	//message d'erreur
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}

}
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
