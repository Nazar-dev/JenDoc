<?php
session_start();
require_once '../../connect.php';

mysqli_query( // create check
    $conn,
    "TRUNCATE TABLE `order`"
);

mysqli_query( // create check
    $conn,
    "SET FOREIGN_KEY_CHECKS = 0"
);

mysqli_query( // create check
    $conn,
    "TRUNCATE TABLE `check`"
);

mysqli_query( // create check
    $conn,
    "SET FOREIGN_KEY_CHECKS = 1"
);

header('Location: ../../../admin/statistic.php');

?>
