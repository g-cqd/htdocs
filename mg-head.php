<?php
session_start();
?>
<!-- © Copyright 2016 - Tous droits réservés -  MIKE x GUIZ PROJECT -->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>



	<!-- Ressources Import -->
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<link rel="icon" type="image/ico" href="ressources/IMG/favicon.ico"/>
	<script type="text/javascript" src="ressources/JS/ressources.js"></script>
	<?php
	include("ressources/PHP/ressources.php");
	if(isset($_SESSION['welcomename'])) {
		include("mg-db.php"); 

		$postc=$DB_con->prepare("select * from mxg_projects where par_pseudo=? limit 1"); 
		$postc->execute(array($_SESSION['welcomename']));

		$captpost=$postc->fetchAll();

		if(count($captpost)>0) {
			$_SESSION['pro_post'] = true;
		}
		else {
			$_SESSION['pro_post'] = false;
		}
	}
	?>
	<!-- Ressources Import -->