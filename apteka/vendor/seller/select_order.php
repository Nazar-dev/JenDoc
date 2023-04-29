<?php
session_start();
require_once '../connect.php';

$user_surname = $_SESSION['user']['surname'];
$user_name = $_SESSION['user']['name'];

//check for unconfirmed
$check = mysqli_num_rows(mysqli_query(
    $conn,
    "SELECT * FROM `check` WHERE `status` = 0"
));

//creating order blocks
$order_blocks = '';

if ($check == 0){
    $order_blocks .= '<div class="list-group-item"><p style="margin-bottom: 0px;" class="text-center">Немає сформованих замовлень</p></div>';
}
else{
    //count of rows
    $check_rows = mysqli_query(
        $conn,
        "SELECT COUNT(1) FROM `check`"
    );

    $check_rows = intval(mysqli_fetch_array($check_rows)[0]);

    for ($i=1; $i <= $check_rows; $i++){
        $check_info =mysqli_query(
            $conn,
            "SELECT `order_price` FROM `check` WHERE `status` = 0 AND `id_check` = '$i'"
        );
        $check_info = mysqli_fetch_assoc($check_info);

        if (!is_null($check_info)){
            $orders_count = mysqli_query(
                $conn,
                "SELECT COUNT(`check_id_check`) AS 'orders_count' FROM `order`
                        WHERE `check_id_check` = '$i'"
            );
            $orders_count = intval(mysqli_fetch_array($orders_count)[0]);

            $order_elem_info = mysqli_query(
                $conn,
                "SELECT `id_order`, `name`, `order_count` 
                            FROM `order` 
                            JOIN `drug_info` ON `drug_sklad_drug_info_id_info` = `id_info` 
                            WHERE `check_id_check` = '$i'"
            );

            $elem_info = array();

            while ($row = mysqli_fetch_assoc($order_elem_info)) {
                $elem_info[] = $row;
            }

            $list = '<ul class="list-unstyled ps-0 mt-2 mb-0">';
            for ($j=0; $j < $orders_count; $j++){
                $list .= '<li class="mb-1">' . $elem_info[$j]['name'] . ' кількість - ' . $elem_info[$j]['order_count'] . ' шт. ' . '</li>';
            }
            $list .= '<li class="mb-1">Загальна ціна - ' . $check_info['order_price'] . '</li>';
            $list .= '</ul>';

            $order_blocks .= '<div class="list-group-item" style="display: flex;flex-wrap: wrap;">
	    				<p style="margin-right: 45px; margin-bottom: 0px;" class="btn btn-toggle collapsed p-0 d-inline-flex align-items-center" data-bs-target="#description' . $i . '" data-bs-toggle="collapse" aria-expanded="false">Замовлення №' . $i . '</p>
                        <div style="margin-left: auto;margin-bottom: 0;">
	    				<a class="btn btn-success" href="../vendor/seller/confirm_order.php?i=' . $i . '">Підтвердити</a></div>
	    				<div class="collapse" id="description' . $i . '">
				          ' . $list . '
				        </div>
	    			</div>';
        }
    }
}

$_SESSION['orders'] = $order_blocks;
header('Location: ../../seller/seller.php');

?>