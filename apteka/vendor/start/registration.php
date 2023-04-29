<?php
session_start();
require_once "../connect.php";

$surname = $_POST['surname'];
$name = $_POST['name'];
$number = $_POST['number'];

$check = mysqli_num_rows(mysqli_query(
    $conn,
    "SELECT * FROM `user` WHERE `number` = '$number'"
));

if ($check == 0) {
    mysqli_query(
        $conn,
        "INSERT INTO `user` (`surname`, `name`, `number`)
				VALUES ('$surname', '$name', '$number')"
    );

    header('Location: ../../index.php');
}
else{
    $_SESSION['message'] = "Цей номер телефону вже є в базі!";
    header('Location: ../../login/user_registration.php');
}

?>