<?php include("mg-head.php"); ?>



	<title><?php echo $site_name?> / PROPOSAL</title>
</head>



<?php include("mg-header.php");
$pro_name=""?>



<!-- page-head -->
<div class="page-head">
PROPOSAL OF PROJECT
</div>
<!-- page-head -->



<div id="postyours">
<form action="" method="post" enctype="multipart/form-data" accept-charset="UTF-8" autocomplete="on">
<?php 
include("mg-db.php");
  $par_pseudo=$_SESSION["welcomename"];
  $r_ID = $DB_con->prepare("select * from mxg_particulier where par_pseudo=?");
  $r_ID->execute(array($par_pseudo));
    while ($d_r_ID = $r_ID->fetch())
    {
      $s_ID = $d_r_ID['par_ID'];
    }
  if(isset($pro_validation)){ 
      $s_pro=$DB_con->prepare("select pro_ID from mxg_project where pro_name=? limit 1"); 
      $s_pro->execute(array($pro_name)); 
      $t_pro=$s_pro->fetchAll(); 
      if(count($t_pro)>0) 
        $error_project="A project is already called like this."; 
      else{
    
   // Constantes
$REP='/img_project/';    // Repertoire cible
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

/*if( !is_dir(REP) ) {
  if( !mkdir(REP, 0755) ) {
    exit('Erreur : le répertoire cible ne peut-être créé ! Vérifiez que vous diposiez des droits suffisants pour le faire ou créez le manuellement !');
  }
}*/

if(!empty($_POST))
{
  if( !empty($_FILES['pro_img']['name']) )
  {
    $extension  = pathinfo($_FILES['pro_img']['name'], PATHINFO_EXTENSION);
    if(in_array(strtolower($extension),$ExtAuth))
    {
      $infosImg = getimagesize($_FILES['pro_img']['tmp_name']);
      if($infosImg[2] >= 1 && $infosImg[2] <= 14)
      {
        if(($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize($_FILES['pro_img']['tmp_name']) <= MAX_SIZE))
        {
          if(isset($_FILES['pro_img']['error']) 
            && UPLOAD_ERR_OK === $_FILES['pro_img']['error'])
          {
            $nomImage = $par_pseudo . '_' . $pro_name .'.'. $extension;
            if(move_uploaded_file($_FILES['pro_img']['tmp_name'], $REP.$nomImage))
            {
              $message = 'Upload worked.';
            }
            else
            {
              $message = 'Upload did not work.';
            }
          }
          else
          {
            $message = 'An internal error prevented the upload.';
          }
        }
        else
        {
          $message = 'Erreur dans les dimensions de l\'image !';
        }
      }
      else
      {
        $message = 'Le fichier à uploader n\'est pas une image !';
      }
    }
    else
    {
      $message = 'L\'extension du fichier est incorrecte !';
    }
  }
  else
  {
    $message = 'YOu ';
  }
} 
  @$par_pseudo = $_POST["par_pseudo"];
  @$pro_name = $_POST["pro_name"];
  @$pro_descrip = $_POST["pro_descrip"];
  @$pro_validation = $_POST["pro_validation"];
  $pro_imgname = $nomImage;

 
        $INS_pro=$DB_con->prepare("insert into mxg_project(par_pseudo,pro_name,pro_descrip,pro_img) values(?,?,?,?)"); 
        if($INS_pro->execute(array($par_pseudo,$pro_name,$pro_descrip,$pro_imgname))) 
        header("");
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
<input type="hidden" name="par_pseudo" value="<?php echo $_SESSION['welcomename'];?>"/>
<br />
<br />
<button type="submit" name="pro_validation" />SEND MY PROPOSAL</button>
</form>
</div>



<?php include("mg-footer.php"); ?>
