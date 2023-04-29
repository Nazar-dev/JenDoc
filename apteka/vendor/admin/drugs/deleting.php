<?php

require '../../connect.php';

$id = $_GET['id'];

$delete = mysqli_query($conn, "DELETE FROM `drug_sklad` WHERE `id_drug_sklad` = '$id'");

if($delete){
    header('Location: ../../../admin/drugs.php');
   
}else{
    header('Location: ../../../admin/drugs.php');
}


?>