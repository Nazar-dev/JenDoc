<?php
session_start();
require_once '../connect.php';

$id_check = $_GET['i'];

//count of drugs in one check
$orders_count = mysqli_query(
    $conn,
    "SELECT COUNT(`check_id_check`) AS 'orders_count' FROM `order`
                        WHERE `check_id_check` = '$id_check'"
);
$orders_count = intval(mysqli_fetch_array($orders_count)[0]);

//checking drugs_id in check
$drug_elem_id = mysqli_query(
    $conn,
    "SELECT `order_count`, `drug_sklad_drug_info_id_info` FROM `order` WHERE `check_id_check` = '$id_check';"
);

$elem_ids = array();
while ($row = mysqli_fetch_assoc($drug_elem_id)) {
    $elem_ids[] = $row;
}


for ($j=0; $j < $orders_count; $j++){
    $sklad_id = $elem_ids[$j]['drug_sklad_drug_info_id_info'];
    $drug_count_db = mysqli_query(
        $conn,
        "SELECT `drug_count` FROM `drug_sklad` WHERE `id_drug_sklad` = '$sklad_id'"
    );
    $drug_count_db = mysqli_fetch_assoc($drug_count_db);
    $drug_count_db = $drug_count_db['drug_count'];
    $drug_count_db = $drug_count_db - $elem_ids[$j]['order_count'];

    mysqli_query(
    $conn,
    "UPDATE `drug_sklad` SET `drug_count`='$drug_count_db' WHERE `id_drug_sklad` = '$sklad_id'"
    );
}

mysqli_query(
    $conn,
    "UPDATE `check` SET `status`= 1 WHERE `id_check` = '$id_check'"
);

header('Location: ../seller/select_order.php');
?>