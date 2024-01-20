<?php include("mg-head.php"); ?>



	<title><?php echo $site_name?> / PROPOSAL</title>
</head>



<?php include("mg-header.php"); ?>



<!-- page-head -->
<div class="page-head">
PROPOSAL OF PROJECT
</div>
<!-- page-head -->



<div id="postyours">
<form action="" method="post" enctype="multipart/form-data" accept-charset="UTF-8" enctype="application/x-www-form-urlencoded" autocomplete="on">
<?php 
include("mg-db.php");
  $par_pseudo=$_SESSION["welcomename"];
  $r_ID = $DB_con->query("select * from mxg_particulier where par_pseudo ?");
      echo "<div class='infophp'>";
    while ($d_r_ID = $r_ID->fetch())
    {
      $s_ID = $d_r_ID['par_ID'];
    }


  @$pro_name=$_POST["pro_name"];
  @$pro_descrip=$_POST["pro_descrip"];
  @$pro_img=$_POST["pro_img"];
  @$pro_validation=$_POST["pro_validation"];



  $erreur=""; 
  if(isset($pro_validation)){ 
    if(empty($pro_name)) $erreur="You must to give us a name for your project."; 
    elseif(empty($pro_descrip)) $erreur="You must to give us a little description of your project."; 
    else{ 
      $s_pro=$DB_con->prepare("select pro_ID from mxg_project where pro_name=? limit 1"); 
      $s_pro->execute(array($pro_name)); 
      $t_pro=$s_pro->fetchAll(); 
      if(count($t_pro)>0) 
        $error_project="A project is already called like this."; 
      else{ 
        $INS_pro=$DB_con->prepare("insert into mxg_project(par_ID,pro_name,pro_descrip,pro_img) values(?,?,?,?)"); 
        if($INS_pro->execute(array($par_ID,$pro_name,$pro_descrip,$pro_img))) 
        header("location:mg-project-sbmted.php"); 
        }    
    } 
  }
   // Constantes
define('REP', '/img_project/');    // Repertoire cible
define('MAX_SIZE', 8388608);    // Taille max en octets du fichier
define('WIDTH_MAX', 3840);    // Largeur max de l'image en pixels
define('HEIGHT_MAX', 2160);    // Hauteur max de l'image en pixels
 
// Tableaux de donnees
$ExtAuth = array('jpg','gif','png','jpeg');    // Extensions autorisees
$infosImg = array();
 
// Variables
$extension = '';
$message = '';
$nomImage = '';

if( !is_dir(REP) ) {
  if( !mkdir(REP, 0755) ) {
    exit('Erreur : le répertoire cible ne peut-être créé ! Vérifiez que vous diposiez des droits suffisants pour le faire ou créez le manuellement !');
  }
}

if(!empty($_POST))
{
  // On verifie si le champ est rempli
  if( !empty($_FILES['pro_img']['name']) )
  {
    // Recuperation de l'extension du fichier
    $extension  = pathinfo($_FILES['pro_img']['name'], PATHINFO_EXTENSION);
 
    // On verifie l'extension du fichier
    if(in_array(strtolower($extension),$ExtAuth))
    {
      // On recupere les dimensions du fichier
      $infosImg = getimagesize($_FILES['pro_img']['tmp_name']);
 
      // On verifie le type de l'image
      if($infosImg[2] >= 1 && $infosImg[2] <= 14)
      {
        // On verifie les dimensions et taille de l'image
        if(($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize($_FILES['pro_img']['tmp_name']) <= MAX_SIZE))
        {
          // Parcours du tableau d'erreurs
          if(isset($_FILES['pro_img']['error']) 
            && UPLOAD_ERR_OK === $_FILES['pro_img']['error'])
          {
            // On renomme le fichier
            $nomImage = $par_pseudo . $pro_name .'.'. $extension;
 
            // Si c'est OK, on teste l'upload
            if(move_uploaded_file($_FILES['pro_img']['tmp_name'], REP.$nomImage))
            {
              $message = 'Upload réussi !';
            }
            else
            {
              // Sinon on affiche une erreur systeme
              $message = 'Problème lors de l\'upload !';
            }
          }
          else
          {
            $message = 'Une erreur interne a empêché l\'uplaod de l\'image';
          }
        }
        else
        {
          // Sinon erreur sur les dimensions et taille de l'image
          $message = 'Erreur dans les dimensions de l\'image !';
        }
      }
      else
      {
        // Sinon erreur sur le type de l'image
        $message = 'Le fichier à uploader n\'est pas une image !';
      }
    }
    else
    {
      // Sinon on affiche une erreur pour l'extension
      $message = 'L\'extension du fichier est incorrecte !';
    }
  }
  else
  {
    // Sinon on affiche une erreur pour le champ vide
    $message = 'YOu ';
  }
} 
?>

<p class="error">FIELDS WITH RED BORDER ARE REQUIRED</p>
<input type="text" name="pro_name" placeholder="PROJECT NAME" value="<?php echo $pro_name;?>" maxlength="100" required/><br />
<br />
<br />
<textarea type="text" name="pro_descrip" placeholder="DESCRIBE YOUR PROJECT IN A FEW WORDS... " value="<?php echo $pro_descrip;?>" resizable="no" maxlength="1000" required/></textarea><br />
<br />
<br />
<input type="file" name="pro_img" id="pro_img" required/>
<br />
<br />
<button type="submit" name="pro_validation" />SEND MY PROPOSAL</button>
</form>
</div>



<?php include("mg-footer.php"); ?>