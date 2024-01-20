<?php
  include("mg-head.php");
  pageTitle("PROPOSITION");
  include("mg-header.php");
  if(!isset($_SESSION['welcomename']))
  {header('location:mg-signup.php');}
  else
  {
    include("mg-db.php");
    $m_pro = $DB_con->prepare('select par_pseudo, pro_name, pro_descrip, pro_img, pro_link, pro_postparam FROM mxg_projects WHERE par_pseudo=? limit 1');
    $m_pro->execute(array($_SESSION['welcomename']));
    $d_pro = $m_pro->fetch();
    if($_SESSION['pro_post']==true and $d_pro['pro_postparam']!=0)
    {header('location:mg-myproject.php');}
  }
?>



<!-- page-head -->
<div class="page-head">
PROPOSER UN PROJET
</div>
<!-- page-head -->



<div id="postyours">
<form action="" method="post" enctype="multipart/form-data" accept-charset="UTF-8" autocomplete="on">
<?php 
/*if($d_pro['pro_postparam']==2) {
  $par_pseudo = $d_pro["par_pseudo"];
  $pro_name = $d_pro["pro_name"];
  $pro_descrip = $d_pro["pro_descrip"];
  $pro_link = $d_pro["pro_link"];
}*/
include("mg-db.php");
@$par_pseudo = $_POST["par_pseudo"];
@$pro_name = $_POST["pro_name"];
@$pro_descrip = $_POST["pro_descrip"];
@$pro_link = $_POST["pro_link"];
@$pro_validation = $_POST["pro_validation"];
$r = $DB_con->prepare("select * from mxg_particulier where par_pseudo=?");
$r->execute(array($par_pseudo));
while ($d_r = $r->fetch())
  {
  $par_ID = $d_r['par_ID'];
  }

if(isset($pro_validation)) { 
  $s_pro=$DB_con->prepare("select pro_ID from mxg_projects where pro_name=? limit 1");
  $s_pro->execute(array($pro_name)); 
  $t_pro=$s_pro->fetchAll(); 
  if(count($t_pro)>0) {$pro_name="Un projet porte déjà ce nom.";} 
  else
  {


  define('MAX_SIZE', 8388608);
 
  $ExtAuth = array('jpg','gif','png','jpeg', 'JPG', 'GIF', 'PNG', 'JPEG');
  $ImgInf = array();
 
  // Variables
  $ExtFich = '';
  $ImgNom = '';

  if($_POST)
  {
    if( !empty($_FILES['pro_img']['name']) )
    {
      $ExtFich  = pathinfo($_FILES['pro_img']['name'], PATHINFO_EXTENSION);
      if(in_array(strtolower($ExtFich),$ExtAuth))
      {
        if(filesize($_FILES['pro_img']['tmp_name']) <= MAX_SIZE)
        {
          $ImgNom = "medias/img/project/{$par_pseudo}_{$pro_name}.{$ExtFich}";
          move_uploaded_file($_FILES['pro_img']['tmp_name'], $ImgNom);
        }
      }
    }
  }
    $_SESSION['pro_post'] = true;
    $INS_pro=$DB_con->prepare("insert into mxg_projects(par_ID,par_pseudo,pro_name,pro_descrip,pro_img,pro_link) values(?,?,?,?,?,?)"); 
    $INS_pro->execute(array($par_ID,$par_pseudo,$pro_name,$pro_descrip,$ImgNom,$pro_link));
    header('location:mg-myproject.php');
}
}

?>

<p class="error">LES CHAMPS AVEC UNE BORDURE ROUGE SONT REQUIS</p>
<input type="text" name="pro_name" placeholder="NOM DU PROJET" value="<?php echo $pro_name;?>" maxlength="100" required/>
<br />
<br />
<textarea type="text" name="pro_descrip" placeholder="DESCRIPTION DU PROJET - 1000 CAR. MAX" value="<?php echo $pro_descrip;?>" resizable="no" maxlength="1000" required/></textarea>
<br />
<br />
<input type="file" name="pro_img" id="pro_img" required/>
<br />
<br />
<input type="url" name="pro_link" id="pro_link" placeholder="SITE INTERNET DU PROJET"/>
<br />
<br />
<input type="hidden" name="par_pseudo" value="<?php echo $_SESSION['welcomename'];?>"/>
<button type="submit" name="pro_validation"/>PROPOSER MON PROJET</button>
</form>
</div>



<?php include("mg-footer.php"); ?>