<?php
	include("mg-head.php");
	pageTitle("PROFIL");
 	include("mg-header.php");
   if(!isset($_SESSION["welcomename"])) { 
      header("location:mg-signup.php"); 
      exit();
   } 
   	$welcome="Bonjour ". 
   	$_SESSION["welcomename"] . " ! <br /> Bienvenue sur votre profil.";
?>



<!-- page-head -->
<div class="page-head">
<?php echo $welcome ?>
</div>
<!-- page-head -->


<?php 
	if($_SESSION['pro_post']==false)
	{
	include("mg-db.php");
	$c_pro = $DB_con->prepare('select * FROM mxg_particulier WHERE par_pseudo=? limit 1');
  	$c_pro->execute(array($_SESSION['welcomename']));
  	$e_pro = $c_pro->fetch();
  	$pparam="";
  	if(isset($_GET['pparam']) and $_GET['pparam']==1){
  	include("mg-db.php");
  	$UPD_pro=$DB_con->query("UPDATE mxg_particulier SET par_postparam=0 WHERE par_ID={$e_pro['par_ID']}");
	header('location:mg-proproject.php');
	}

  	if($e_pro["par_postparam"]==1)
  	{
  		echo "<div class='alerted'><a href='?pparam=1'><button>OK</button></a>Votre propostition a été rejetée car elle ne remplissait pas les conditions attendues.</div>";
  	}elseif ($e_pro["par_postparam"]==2) {
  		echo "<div class='alerted'><a href='?pparam=1'><button>OK</button></a>Votre propostition a été transmise aux administrateurs.</div>";
  	}
    echo "<div class='submitted'>
<a href='mg-proproject.php'>PROPOSER UN PROJET</a>
</div>";
    }
    else
    {
    	echo "<div class='submitted'>
<a href='mg-myproject.php'>VOIR MON PROJET</a>
</div>";
    }

   if($_SESSION["welcomename"]=="Guiz" or $_SESSION["welcomename"]=="Mxke")
   {

    echo "<div class='submitted'>
<a href='mg-progestion.php'>GESTION</a>
</div>";

   		include("mg-db.php");
    	$r_par = $DB_con->query('SELECT par_pseudo, par_nom FROM mxg_particulier ORDER BY par_nom');
    	$r_pro = $DB_con->query('SELECT par_pseudo, pro_name FROM mxg_projects ORDER BY pro_name');
    	echo "<div class='infophp'>";
		while ($d_par = $r_par->fetch())
		{
			echo  $d_par['par_pseudo'] . ' - ' . $d_par['par_nom'] . '<br />';
		}

		echo "<br />";
		echo "<br />";
		echo "<br />";

		while ($d_pro = $r_pro->fetch())
		{
			echo  $d_pro['par_pseudo'] . ' - ' . $d_pro['pro_name'] . '<br />';
		}
		echo "<br /><br /><script>document.getElementById('client').innerHTML = 'Largeur : '' + window.innerWidth + '<br />Hauteur : '' + window.innerHeight;</script> <br /><br />";

		echo "GATEWAY_INTERFACE .... : " . $_SERVER['GATEWAY_INTERFACE'] . "<br/>";
		echo "SERVER_NAME .......... : " . $_SERVER['SERVER_NAME'] . "<br/>";
		echo "SERVER_ADDR .......... : " . $_SERVER['SERVER_ADDR'] . "<br/>";
		echo "SERVER_SOFTWARE ...... : " . $_SERVER['SERVER_SOFTWARE'] . "<br/>";
		echo "SERVER_PROTOCOL ...... : " . $_SERVER['SERVER_PROTOCOL'] . "<br/>";
		echo "SERVER_ADMIN ......... : " . $_SERVER['SERVER_ADMIN'] . "<br/>";
		echo "SERVER_SIGNATURE ..... : " . $_SERVER['SERVER_SIGNATURE'] . "<br/>";
		echo "REQUEST_METHOD ....... : " . $_SERVER['REQUEST_METHOD'] . "<br/>";
		echo "REQUEST_TIME ......... : " . $_SERVER['REQUEST_TIME'] . "<br/>";
		echo "QUERY_STRING ......... : " . $_SERVER['QUERY_STRING'] . "<br/>";
		echo "DOCUMENT_ROOT ........ : " . $_SERVER['DOCUMENT_ROOT'] . "<br/>";
		echo "HTTP_ACCEPT .......... : " . $_SERVER['HTTP_ACCEPT'] . "<br/>";
		echo "HTTP_ACCEPT_CHARSET .. : " . $_SERVER['HTTP_ACCEPT_CHARSET'] . "<br/>";
		echo "HTTP_ACCEPT_ENCODING . : " . $_SERVER['HTTP_ACCEPT_ENCODING'] . "<br/>";
		echo "HTTP_ACCEPT_LANGUAGE . : " . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . "<br/>";
		echo "HTTP_CONNECTION ...... : " . $_SERVER['HTTP_CONNECTION'] . "<br/>";
		echo "HTTP_HOST ............ : " . $_SERVER['HTTP_HOST'] . "<br/>";
		echo "HTTP_REFERER ......... : " . $_SERVER['HTTP_REFERER'] . "<br/>";
		echo "HTTP_USER_AGENT ...... : " . $_SERVER['HTTP_USER_AGENT'] . "<br/>";
		echo "HTTPS ................ : " . $_SERVER['HTTPS'] . "<br/>";
		echo "HTTP_HOST ............ : " . $_SERVER['HTTP_CONNECTION'] . "<br/>";
		echo "REMOTE_ADDR .......... : " . $_SERVER['REMOTE_ADDR'] . "<br/>";
		echo "REMOTE_HOST .......... : " . $_SERVER['REMOTE_HOST'] . "<br/>";
		echo "REMOTE_PORT .......... : " . $_SERVER['REMOTE_PORT'] . "<br/>";
		echo "SCRIPT_FILENAME ...... : " . $_SERVER['SCRIPT_FILENAME'] . "<br/>";
		echo "PATH_TRANSLATED ...... : " . $_SERVER['PATH_TRANSLATED'] . "<br/>";
		echo "REQUEST_URI .......... : " . $_SERVER['REQUEST_URI'] . "<br/>";
		echo "PHP_AUTH_DIGEST ...... : " . $_SERVER['PHP_AUTH_DIGEST'] . "<br/>";
		echo "PHP_AUTH_USER ........ : " . $_SERVER['PHP_AUTH_USER'] . "<br/>";
		echo "PHP_AUTH_PW .......... : " . $_SERVER['PHP_AUTH_PW'] . "<br/>";
		echo "AUTH_TYPE ............ : " . $_SERVER['AUTH_TYPE'] . "<br/>";
		echo "PATH_INFO ............ : " . $_SERVER["PATH_INFO"] . "<br/>";
		echo "ORIG_PATH_INFO ....... : " . $_SERVER['ORIG_PATH_INFO'] . "<br/>";

		echo "</div>";
} 

?>



<div class="submitted">
<a href="mg-logout.php" id="logout">DECONNEXION</a>
</div>



<?php include("mg-footer.php"); ?>