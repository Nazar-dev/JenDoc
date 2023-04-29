<?php
session_start();

require '../../connect.php';

$login = $_POST['login'];

$checking = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `worker` WHERE `login` = '$login'"));

if($checking != 0){
    $_SESSION['check'] = 2;
    header('Location: add.php');
    die();
}

$name = $_POST['name'];
$surname = $_POST['surname'];

$password = $_POST['password'];

$add = mysqli_query($conn, "INSERT INTO `worker` (`name` , `surname`, `login`, `password`) VALUES('$name', '$surname', '$login', '$password')");

if($add){
    $_SESSION['check'] = 1;
    header('Location: ../../../admin/admin.php');
}else{
    $_SESSION['check'] = 2;
    header('Location: ../../../admin/admin.php');
}

?>