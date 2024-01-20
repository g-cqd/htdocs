<?php
	include("mg-head.php");

 	include("mg-header.php");


  $emppro = $_GET['emppro'];

  include("mg-db.php");
    $emp_pro = $DB_con->query("SELECT par_pseudo, pro_name, pro_descrip, pro_img, pro_link FROM mxg_projects WHERE pro_emp={$emppro}");
    $d_emp_pro = $emp_pro->fetchAll();
    $par_pseudo=$d_emp_pro[0]['par_pseudo'];
    $c_pro = $DB_con->prepare("select par_email FROM mxg_particulier WHERE par_pseudo=? limit 1");
    $c_pro->execute(array($par_pseudo));
    $e_pro = $c_pro->fetch();

  pageTitle(strtoupper($d_emp_pro[0]['pro_name']));

  if(!isset($d_emp_pro[0]['par_pseudo'])) {header('location:mg-project.php');}

?>



<div class="pro">



<div class="prodesc">
	<div class="desctitle">projet</div>
	<div class="desccontent"><?php echo $d_emp_pro[0]['pro_name']; ?></div>
</div>
<div class="prodesc">
	<div class="desctitle">proprietaire</div>
	<div class="desccontent"><?php echo $d_emp_pro[0]['par_pseudo']; ?></div>
</div>
<div class="prodesc">
	<div class="desctitle">description</div>
	<div class="desccontent"><?php echo $d_emp_pro[0]['pro_descrip']; ?></div>
</div>
<div class="prodesc">
	<div class="desctitle"><?php if($d_emp_pro[0]['pro_link']!=""){echo "<a href='{$d_emp_pro[0]['pro_link']}' target='_blank'>SITE INTERNET</a> / ";}?><a href="mailto:<?php echo $e_pro['par_email'];?>">CONTACT</a></div>
</div>
<div class="proimg">
	<?php echo "<img src='" . $d_emp_pro[0]['pro_img'] . "' alt='" . $d_emp_pro[0]['pro_name'] . "' title='" . "'>";?>
</div>


</div>


<?php include("mg-footer.php"); ?>