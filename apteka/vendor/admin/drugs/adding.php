<?php
session_start();

require '../../connect.php';

$drug_info = $_POST['drug_info'];
$price = $_POST['price'];
$amount = $_POST['amount'];
$date = $_POST['date'];

$add = mysqli_query($conn, "INSERT INTO `drug_sklad` (`drug_info_id_info`, `price`, `drug_count`, `in_date`) VALUES ('$drug_info', '$price', '$amount', '$date')");

if($add){
    $_SESSION['check'] = 1;
    header('Location: ../../../admin/drugs.php');
}else{
    $_SESSION['check'] = 2;
    header('Location: ../../../admin/drugs.php');
}

?>