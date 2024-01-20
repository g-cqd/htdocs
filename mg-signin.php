<?php
include("mg-head.php");
pageTitle("INSCRIPTION");
include("mg-header.php");?>



<!-- page-head -->
<div class="page-head">
INSCRIPTION
</div>
<!-- page-head -->


<!-- fill yours -->
<div id="postyours">
<form action="" method="post" accept-charset="UTF-8" enctype="application/x-www-form-urlencoded" autocomplete="on">
<?php 
   $setpro_postparam=false;
   $par_nom="";
   $par_prenom="";
   $par_pseudo="";
   $par_email="";
   $par_password="";
   $par_repassword="";
   @$par_nom=$_POST["par_nom"]; 
   @$par_prenom=$_POST["par_prenom"]; 
   @$par_pseudo=$_POST["par_pseudo"]; 
   @$par_email=$_POST["par_email"];
   @$par_password=$_POST["par_password"]; 
   @$par_repassword=$_POST["par_repassword"]; 
   @$par_validation=$_POST["par_validation"]; 
   if(isset($par_validation)){ 
      if(empty($par_nom)) $par_nom="Vous devez renseigner votre nom."; 
      elseif(empty($par_prenom)) $par_prenom="Vous devez renseigner votre prénom."; 
      elseif(empty($par_pseudo)) $par_pseudo="Vous devez un renseigner pseudo."; 
      elseif(empty($par_email)) $par_email="Vous devez renseigner votre adresse email."; 
      elseif(empty($par_password)) $par_password="Vous devez choisir un mot de passe."; 
      elseif($par_password!=$par_repassword) $par_password="Vous devez ressaisir votre mot de passe."; 
      else{ 
         include("mg-db.php"); 
         $sel=$DB_con->prepare("select par_ID from mxg_particulier where par_pseudo=? limit 1"); 
         $sel->execute(array($par_pseudo)); 
         $e_pseudo=$sel->fetchAll(); 
         if(count($e_pseudo)>0) 
            {$par_pseudo="Ce pseudo existe déjà, choisissez-en un autre.";} 
         else{ 
            $ins=$DB_con->prepare("insert into mxg_particulier(par_nom,par_prenom,par_pseudo,par_email,par_password) values(?,?,?,?,?)");
            if($ins->execute(array($par_nom,$par_prenom,$par_pseudo,$par_email,md5($par_password)))) 
               header("location:mg-signup.php"); 
         }    
      } 
   } 
?>

<p class="error">LES CHAMPS AVEC UNE BORDURE ROUGE SONT REQUIS</p>
<input type="text" name="par_nom" placeholder="NOM" value="<?php echo $par_nom;?>" maxlength="100" required/><br />
<br />
<input type="text" name="par_prenom" placeholder="PRENOM" value="<?php echo $par_prenom;?>" maxlength="100" required/><br />
<br />
<input type="text" name="par_pseudo" placeholder="PSEUDO" value="<?php echo $par_pseudo;?>" maxlength="100" required/><br />
<br />
<input type="email" name="par_email" placeholder="ADRESSE EMAIL" value="<?php echo $par_email;?>" maxlength="100" required/><br />
<br />
<input type="password" name="par_password" placeholder="CREER UN MOT DE PASSE" value="<?php echo $par_password;?>" maxlength="128" required/><br />
<br />
<input type="password" name="par_repassword" placeholder="RESSAISIR LE MOT DE PASSE" value="<?php echo $par_repassword;?>" maxlength="128" required/><br />
<br />
<br />
<button type="submit" name="par_validation" />M'INSCRIRE</button>
</form>
</div>



<?php include("mg-footer.php"); ?>
