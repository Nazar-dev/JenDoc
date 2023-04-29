<?php

session_start();

require '../../connect.php';

$discount = $_POST['discount'];

if($discount > 100){
    $_SESSION['check'] = 3;
    header('Location: ../../../admin/discount.php');
    die();
}

$discount_set = mysqli_query($conn, "UPDATE `discount` SET `value` = '$discount'");

if($discount_set){
    $_SESSION['check'] = 1;
    header('Location: ../../../admin/discount.php');
}else{
    $_SESSION['check'] = 2;
    header('Location: ../../../admin/discount.php');
}
?>