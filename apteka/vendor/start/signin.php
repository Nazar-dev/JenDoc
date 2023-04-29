<?php
session_start();
require_once "../connect.php";

$login = $_POST['login'];
$password = $_POST['password'];

$password2 = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT `password` FROM `worker` WHERE `login` = '$login'"
));
$password2 = $password2['password'];

if ($password == $password2) {
    $worker = mysqli_fetch_assoc(mysqli_query(
        $conn,
        "SELECT surname, name, role FROM `worker` WHERE `login` = '$login'"
    ));

    if ($worker['role'] == 0) {
        $_SESSION['user'] = [
            "surname" => $worker['surname'],
            "name" => $worker['name'],
            "role" => $worker['role']
        ];
        header('Location: ../seller/select_order.php');
    }
    elseif ($worker['role'] == 1) {
        $_SESSION['user'] = [
            "surname" => $worker['surname'],
            "name" => $worker['name'],
            "role" => $worker['role']
        ];
        header('Location: ../../admin/admin.php');
    }
}
else {
    $_SESSION['message'] = "Неправильний логін або пароль!";
    header('Location: ../../login/log.php');
}
?>