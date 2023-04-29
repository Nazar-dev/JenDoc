<?php

session_start();

require '../../connect.php';

$id = $_POST['id'];
$price = $_POST['price'];
$drug_count = $_POST['drug_count'];

$edit = mysqli_query($conn, "UPDATE `drug_sklad` SET `price` = '$price', `drug_count` = '$drug_count' WHERE `id_drug_sklad` = '$id'");

if($edit){
    $_SESSION['check'] = 1;
    header('Location: ../../../admin/drugs.php');
}else{
    $_SESSION['check'] = 2;
    header('Location: ../../../admin/drugs.php');
}
?>