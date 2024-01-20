<?php
	include("mg-head.php");
	pageTitle("GESTION");
	include("mg-header.php");
 //  if(!isset($_SESSION["welcomename"]) or $_SESSION["welcomename"]!='Guiz' or $_SESSION["welcomename"]!='Mxke') { 
   // 	header("location:mg-session.php");
//    	exit();
  //  }
?>
<!-- page-head -->
<div class="page-head">
GESTION
</div>
<!-- page-head -->

<?php
    include("mg-db.php");
    $valpro=$DB_con->query("SELECT * FROM mxg_projects WHERE pro_postparam!=1 limit 1"); 
	while ($affval=$valpro->fetch())
		{
			$validationpro="validation".$affval['pro_emp'];
			$supprpro="suppr".$affval['pro_emp'];
			$modpro="mod".$affval['pro_emp'];

			echo "<div class='submitted'>PROPRIETAIRE : <br />" . $affval['par_pseudo'] . "<br /><br />PROJET : <br />" . $affval['pro_name'] . "<br /><br />DESCRIPTION : <br />" . $affval['pro_descrip'] . "<br / ><br />SITE INTERNET : <br />" . $affval['pro_link'] . "<br /></div>
			<form action='' method='post'>";

			@$pro_emp = $_POST["pro_emp"];
			@$validation_pro = $_POST[$validationpro];
			@$mod_pro = $_POST[$modpro];
			@$del_pro = $_POST[$supprpro];

			include("mg-db.php");
			
			if(isset($validation_pro)) {
			$VAL_pro=$DB_con->prepare("UPDATE mxg_projects SET pro_emp={$pro_emp}, pro_postparam=1 WHERE pro_ID={$affval['pro_ID']}");
			$VAL_pro->execute();
    		header('location:#');}

    		/*elseif(isset($mod_pro)) {
			$MODI_pro=$DB_con->prepare("UPDATE mxg_projects SET pro_postparam=2 WHERE pro_ID={$affval['pro_ID']}");
			$MODI_pro->execute();
    		header('location:#');}*/
    		
    		elseif(isset($del_pro)) {
    		unlink($affval['pro_img']);
    		$DELE_pro=$DB_con->prepare("DELETE FROM mxg_projects WHERE pro_ID={$affval['pro_ID']}");
			$DELE_pro->execute();
			$SETPAR_pro=$DB_con->prepare("UPDATE mxg_particulier SET par_postparam=1 WHERE par_ID={$affval['par_ID']}");
			$SETPAR_pro->execute();
    		header('location:#');}


			echo "EMPLACEMENT<br /><select name='pro_emp'>
			<option value='" . $affval['pro_emp'] . "'>" . $affval['pro_emp'] . "</option>
			<option value='0'> </option>
			<option value='1'>1</option>
			<option value='2'>2</option>
			<option value='3'>3</option>
			<option value='4'>4</option>
			<option value='5'>5</option>
			<option value='6'>6</option>
			</select><br /><br /><br />
			<button id='check' type='submit' name='" . $validationpro . "'>VALIDER</button>". /*"<button id='mod' type='submit' name='" . $modpro . "'>A MODIFIER</button>"*/"<button id='suppr' type='submit' name='" . $supprpro . "'>SUPPRIMER</button>
			</form>";
		}
?>

<?php include("mg-footer.php"); ?>