<?php  include("mg-head.php");
   pageTitle("CONNEXION");
   include("mg-header.php");
   if(isset($_SESSION["welcomename"])) { 
      header("location:mg-session.php"); 
      exit();
   }
  ?>



<!-- page-head -->
<div class="page-head">
CONNEXION
</div>
<!-- page-head -->



<?php
   $par_pseudo="";
   @$par_pseudo=$_POST["par_pseudo"]; 
   @$par_password=md5($_POST["par_password"]); 
   @$par_validation=$_POST["par_validation"]; 
   $erreur=""; 
   if(isset($par_validation)){ 
      include("mg-db.php"); 
      $sel=$DB_con->prepare("select * from mxg_particulier where par_pseudo=? and par_password=? limit 1"); 
      $sel->execute(array($par_pseudo,$par_password)); 
      $e_pseudo=$sel->fetchAll(); 
      if(count($e_pseudo)>0){ 
         $_SESSION["welcomename"]=$e_pseudo[0]["par_pseudo"];
         if(!isset($_SESSION['pro_post'])) {$_SESSION['pro_post']=false;}
         $_SESSION["autoriser"]="oui"; 
         header("location:mg-session.php"); 
      } 
      else 
         $par_pseudo="Nom d'utilisateur ou mot de passe incorrect"; 
   } 
?>
<div id="postyours">
<form action="" method="post" accept-charset="UTF-8" enctype="application/x-www-form-urlencoded" autocomplete="on">
<p class="error">LES CHAMPS AVEC UNE BORDURE ROUGE SONT REQUIS</p>
<br />
<input type="text" name="par_pseudo" placeholder="PSEUDO" value="<?php echo $par_pseudo?>" maxlength="100" required/><br />
<br />
<input type="password" name="par_password" placeholder="MOT DE PASSE" value="" maxlength="128" required/><br />
<br />
<button type="submit" name="par_validation" />ME CONNECTER</button>
</form>
</div>
<div class="submitted">
<a href="/mg-signin.php">S'INSCRIRE</a>
</div>

<!-- fill yours -->



<?php include("mg-footer.php"); ?>