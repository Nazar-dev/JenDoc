<?php
session_start();

require '../../connect.php';


$id = $_POST['id'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$login = $_POST['login'];
$password = $_POST['password'];

$insert = mysqli_query($conn, "UPDATE `worker` SET `name` = '$name', `surname` = '$surname', `login` = '$login', `password` = '$password' WHERE `idworker` = '$id'");

if($insert){
    $_SESSION['check'] = 1;
    header('Location: ../../../admin/admin.php');
}else{
    $_SESSION['check'] = 2;
    header('Location: ../../../admin/admin.php');
}

?>