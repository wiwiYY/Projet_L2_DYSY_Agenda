<?php
session_start();
// Connexion à la base de données
require_once('bdd.php');

// Condition de champs obligatoire, avoir l'id, la date de début et de fin
if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2])){
	
	
	$id = $_POST['Event'][0];
	$start = $_POST['Event'][1];
	$end = $_POST['Event'][2];

	// Modification des attributs sur la bdd
	$sql = "UPDATE events SET  begining = '$start', ending = '$end' WHERE id_events = $id";

	$query = $bdd->prepare( $sql );
	// Message d'erreur
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}else{
		die ('OK');
	}

}
header('Location: '.$_SERVER['HTTP_REFERER']);

?>
