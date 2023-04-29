<?php
session_start();
require_once "../connect.php";

//count of rows
$sql = mysqli_query(
    $conn,
    "SELECT COUNT(1) FROM `drug_sklad`"
);
$rows_count = intval(mysqli_fetch_array($sql)[0]);

//creating list of drugs
$list = '<ul class="list-unstyled ps-0">';

$a = 1;
for ($i=1; $i <= $rows_count; $i++) {
    $sql = mysqli_query(
        $conn,
        "SELECT `name`, `price`, `id_info` FROM `drug_sklad` JOIN `drug_info` ON `drug_info_id_info` = `id_info` WHERE `id_drug_sklad` = '$i' AND `drug_count` > 0"
    );
    $row = mysqli_fetch_assoc($sql);
    if (!is_null($row)) {
        $list .= '<li class="mb-1" style="display: flex;flex-wrap: wrap;margin-bottom: 15px;margin-top: 15px;">
                    <p style="margin-bottom: 0;margin-right: 50px;width: 150px;" class="p-0 d-inline-flex align-items-center">
                    ' . $row['name'] . '
                    </p>
                    <label class="p-0 d-inline-flex align-items-center">
                        ціна - ' . $row['price'] . ' грн. ' . '
                    </label>
                    <p style="margin-left: auto;margin-bottom: 0;">
                        <a class="btn btn-outline-primary d-inline-flex p-1 align-items-center" style="text-align: right;" href="#" id="el' . $a . '" name=" ' . $row['id_info'] . '">Додати</a>
                    </p>
                </li>';
        $a += 1;
    }
}
$list .= '</ul>';

//creating divs
$div = "";
$b = 1;
for ($i=1; $i <= $rows_count; $i++) {
    $sql = mysqli_query(
        $conn,
        "SELECT `id_drug_sklad` FROM `drug_sklad` WHERE `id_drug_sklad` = '$i' AND `drug_count` > 0"
    );
    $row = mysqli_fetch_assoc($sql);
    if (!is_null($row)) {
        $div .= '<div id="message' . $b . '"></div>';
        $b += 1;
    }
}

$_SESSION['list'] = $list;
$_SESSION['divs'] = $div;
//$_SESSION['divs2'] = $div2;
$_SESSION['count'] = $b;

header('Location: ../../user/user.php');

?>

