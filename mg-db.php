<?php

$DB_host = "localhost";
$DB_user = "mxg_mstrusr";
$DB_pass = "*-Ddsf56+68VcxdFmLn-6655DSd*sd-ss5898+7771Fd-sS123*-dfddjJL+5683Fcfx25456+5Fsdf-ppOiuYmn-KlKKlkmdoE+ErrE6326-+WqQs9823-785bfs*-+";
$DB_name = "mxgp";


try
{
     $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
     $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
     echo $e->getMessage();
}
?>