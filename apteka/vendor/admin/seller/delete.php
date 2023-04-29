<?php

require '../../connect.php';

$id = $_GET['id'];

$delete = mysqli_query($conn, "DELETE FROM `worker` WHERE `idworker` = '$id'");

if($delete){
    header('Location: ../../../admin/admin.php');
}

?>