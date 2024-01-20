<?php
	include("mg-head.php");
	pageTitle("MON PROJET");
 	include("mg-header.php");
  	if(!isset($_SESSION['welcomename']))
  	{
  		header('location:mg-signup.php');
  	}
  	else {
		if($_SESSION['pro_post']==false)
    	{
    		header('location:mg-proproject.php');
    	}
	}

  	$m_pro = $DB_con->prepare('select par_pseudo, pro_name, pro_descrip, pro_img, pro_link, pro_postparam FROM mxg_projects WHERE par_pseudo=? limit 1');
  	$m_pro->execute(array($_SESSION['welcomename']));
  	$d_pro = $m_pro->fetch();

  	$c_pro = $DB_con->prepare('select * FROM mxg_particulier WHERE par_pseudo=? limit 1');
  	$c_pro->execute(array($_SESSION['welcomename']));
  	$e_pro = $c_pro->fetch();

  /*  if($d_pro['pro_postparam']==2) {
        header('location:mg-proproject.php');
    }*/

?>


<div class="pro">

<div class="prodesc">
	<div class="desctitle">projet</div>
	<div class="desccontent"><?php echo $d_pro['pro_name']; ?></div>
</div>
<div class="prodesc">
	<div class="desctitle">proprietaire</div>
	<div class="desccontent"><?php echo $d_pro['par_pseudo']; ?></div>
</div>
<div class="prodesc">
	<div class="desctitle">description</div>
	<div class="desccontent"><?php echo $d_pro['pro_descrip']; ?></div>
</div>
<div class="prodesc">
	<div class="desctitle"><?php if($d_pro['pro_link']!=""){echo "<a href='{$d_pro['pro_link']}' target='_blank'>SITE INTERNET</a> / ";}?><a href="mailto:<?php echo $e_pro['par_email'];?>">CONTACT</a></div>
</div>
<div class="proimg">
	<?php echo "<img src='" . $d_pro['pro_img'] . "' alt='" . $d_pro['pro_name'] . "' title='" . "'>";?>
</div>

</div>


<?php include("mg-footer.php"); ?>