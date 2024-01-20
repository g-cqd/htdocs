<body>
<!-- Top Target -->
<div  class= divhaut id="haut"> </div>
<!-- Top Target -->
         <?php
         $postparam=0;
         include("mg-db.php"); 
         $sel=$DB_con->prepare("select pro_ID from mxg_projects where pro_postparam=? limit 1"); 
         $sel->execute(array($postparam)); 
         $p_npost=$sel->fetchAll(); 
         $np_npost=count($p_npost);
?>

<!-- Nav -->
<nav>
	<ul>
		<li><a href="mg-project.php" <?php actuelle($page="/mg-project.php")?> >projets</a></li>
		<li><a href="mg-about.php" <?php actuelle($page="/mg-about.php")?> >a propos</a></li>
		<li class="logon" id="logon"><a onmouseover="LogO()" onmouseleave="LogC()"
		<?php 
		$log="";
		if(empty($_SESSION["welcomename"])) echo $log="href='mg-signup.php'>CONNEXION";
		else {echo $log="href='/mg-session.php'>".$_SESSION["welcomename"];}
		?> <img src="ressources/IMG/logon.svg"></a></li>
		<div id="log-content" onmouseover="LogO()" onmouseleave="LogC()">
		<?php 
			$logcontent="";
			if(empty($_SESSION["welcomename"])) echo $logcontent="<li><a href='mg-signup.php'>SE CONNECTER</a></li><li><a href='mg-signin.php'>S'INSCRIRE</a></li>";
			else{
				if($_SESSION['pro_post'] == false) {
				echo $logcontent="<li><a href='mg-proproject.php'>PROPOSER UN PROJET</a></li><li><a href='mg-logout.php' id='logout'>DECONNEXION</a></li>";
			} else {
				echo $logcontent="<li><a href='mg-myproject.php'>MON PROJET</a></li><li><a href='mg-logout.php' id='logout'>DECONNEXION</a></li>";
			}
			if($np_npost>0 and ($_SESSION["welcomename"]=='Guiz' or $_SESSION["welcomename"]=='Mxke'))  {
				echo $logcontent="<li><a id='loading' href='mg-progestion.php'>PAMOD : {$np_npost}</a></li>";
			}
		}
			?>

		</div>
	</ul>
</nav>
<!-- Nav -->



<?php
$url=$_SERVER['REQUEST_URI'];
if ($url=="/index.php" or $url=="/" or $url=="/www/index.php" or $url=="/www/")
	echo
	"<!-- Header -->
	<header>
		<a href='index.php'><span style='font-family:Quicksand'>M K G Z</span></a>
	</header>
<!-- Header -->";
if ($url!="/index.php" and $url!="/" and $url!="/www/index.php" and $url!="/www/")
	echo
	"<!-- Header -->
		<div class='header-second' id='header'>
			<a href='index.php'><span style='font-family:Quicksand;letter-spacing:3px'>MKGZ</span></a>
		</div><!-- Header -->";
?>



<!-- Content -->
<div class="content">