<?php
	include("mg-head.php");
	pageTitle("ACCUEIL");
 	include("mg-header.php");
  	include("mg-db.php");
    $emp_pro = $DB_con->query('SELECT pro_name, pro_img, pro_emp FROM mxg_projects WHERE pro_postparam=1 ORDER BY pro_emp');
  	$d_emp_pro = $emp_pro->fetchAll();
 ?>



<!-- Col -->
<div id="project-col-3">
	<ul>
		<li><a href="<?php if(isset($d_emp_pro[0]['pro_name'])){echo 'mg-pubproject.php?emppro=1';}?>" style="background-image: url('<?php if(isset($d_emp_pro[0]['pro_img'])){echo $d_emp_pro[0]['pro_img'];}else{echo "ressources/IMG/defaut.png";}?>')"><?php if(isset($d_emp_pro[0]['pro_name'])){echo "<span style='background:rgba(20,20,20,0.9);padding:2.5% 7.5%;'>".$d_emp_pro[0]['pro_name']."</span>";}else{echo "&nbsp";}?></a></li>
		<li><a href="<?php if(isset($d_emp_pro[1]['pro_name'])){echo 'mg-pubproject.php?emppro=2';}?>" style="background-image:url('<?php if(isset($d_emp_pro[1]['pro_img'])){echo $d_emp_pro[1]['pro_img'];}else{echo "ressources/IMG/defaut.png";}?>')"><?php if(isset($d_emp_pro[1]['pro_name'])){ echo "<span style='background:rgba(20,20,20,0.9);padding:2.5% 7.5%;'>".$d_emp_pro[1]['pro_name']."</span>";}else{echo "&nbsp";}?></a></li>
		<li><a href="<?php if(isset($d_emp_pro[2]['pro_name'])){echo 'mg-pubproject.php?emppro=3';}?>" style="background-image:url('<?php if(isset($d_emp_pro[2]['pro_img'])){echo $d_emp_pro[2]['pro_img'];}else{echo "ressources/IMG/defaut.png";}?>')"><?php if(isset($d_emp_pro[2]['pro_name'])){ echo "<span style='background:rgba(20,20,20,0.9);padding:2.5% 7.5%;'>".$d_emp_pro[2]['pro_name']."</span>";}else{echo "&nbsp";}?></a></li>
		<li><a href="<?php if(isset($d_emp_pro[3]['pro_name'])){echo 'mg-pubproject.php?emppro=4';}?>" style="background-image:url('<?php if(isset($d_emp_pro[3]['pro_img'])){echo $d_emp_pro[3]['pro_img'];}else{echo "ressources/IMG/defaut.png";}?>')"><?php if(isset($d_emp_pro[3]['pro_name'])){ echo "<span style='background:rgba(20,20,20,0.9);padding:2.5% 7.5%;'>".$d_emp_pro[3]['pro_name']."</span>";}else{echo "&nbsp";}?></a></li>
		<li><a href="<?php if(isset($d_emp_pro[4]['pro_name'])){echo 'mg-pubproject.php?emppro=5';}?>" style="background-image:url('<?php if(isset($d_emp_pro[4]['pro_img'])){echo $d_emp_pro[4]['pro_img'];}else{echo "ressources/IMG/defaut.png";}?>')"><?php if(isset($d_emp_pro[4]['pro_name'])){ echo "<span style='background:rgba(20,20,20,0.9);padding:2.5% 7.5%;'>".$d_emp_pro[4]['pro_name']."</span>";}else{echo "&nbsp";}?></a></li>
		<li><a href="<?php if(isset($d_emp_pro[5]['pro_name'])){echo 'mg-pubproject.php?emppro=6';}?>" style="background-image:url('<?php if(isset($d_emp_pro[5]['pro_img'])){echo $d_emp_pro[5]['pro_img'];}else{echo "ressources/IMG/defaut.png";}?>')"><?php if(isset($d_emp_pro[5]['pro_name'])){ echo "<span style='background:rgba(20,20,20,0.9);padding:2.5% 7.5%;'>".$d_emp_pro[5]['pro_name']."</span>";}else{echo "&nbsp";}?></a></li>
	</ul>
</div>
<!-- Col -->



<?php include("mg-footer.php"); ?>