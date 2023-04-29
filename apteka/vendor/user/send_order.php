<?php
session_start();
require_once "../connect.php";

$discount = mysqli_query( //find out the discount
    $conn,
    "SELECT `value` FROM `discount` WHERE `id_discount` = 1"
);
$discount = mysqli_fetch_assoc($discount);
$discount = $discount['value'];

$phone_number = $_POST['phone_number'];
$total_price = 0;

if (count($_POST) > 1) {
    if (strlen($phone_number) == 0){ // without discount
        mysqli_query( // create check
            $conn,
            "INSERT INTO `check` (`order_date`, `status`)
				VALUES (NOW(), 0)"
        );
        $check_id = mysqli_insert_id($conn);

        $drug_order_count = count($_POST) - 1;

        for ($i = 0; $i <= $drug_order_count; $i = $i + 2){
            $id_info = array_values($_POST)[$i];
            if (strlen($id_info) != 0) {
                $id_info = ltrim($id_info, $id_info[0]);
                $concat_id_count = "drug_count_" . $id_info;
                $drug_count = $_POST[$concat_id_count];

                mysqli_query(
                    $conn,
                    "INSERT INTO `order` (`order_count`, `drug_sklad_id_drug_sklad`, `drug_sklad_drug_info_id_info`, check_id_check)
				VALUES ('$drug_count', '$id_info', '$id_info', '$check_id')"
                );

                $price = mysqli_query(
                    $conn,
                    "SELECT `price` FROM `drug_sklad` WHERE `id_drug_sklad` = '$id_info'"
                );
                $price = mysqli_fetch_assoc($price);
                $price = $price['price'];
                $total_price = $total_price + $price * $drug_count;
            }
        }
        mysqli_query(
            $conn,
            "UPDATE `check` SET `order_price`='$total_price' WHERE `id_check` = '$check_id'"
        );

        if (!is_null($_SESSION['user'])) {
            if ($_SESSION['user']['role'] == 0){
                $_SESSION['message'] = "Замовлення cформовано!";
                header('Location: ../seller/select_order.php');
            }
        }
        else {
            $_SESSION['message'] = "Замовлення відправлено!";
            header('Location: ../../user/user.php');
        }
    }
    else{ // with discount
        $check_phone = mysqli_num_rows(mysqli_query(
            $conn,
            "SELECT * FROM `user` WHERE `number` = '$phone_number'"
        ));

        if ($check_phone != 0) {
            mysqli_query( // create check
                $conn,
                "INSERT INTO `check` (`order_date`, `status`)
				VALUES (NOW(), 0)"
            );
            $check_id = mysqli_insert_id($conn);

            $drug_order_count = count($_POST) - 1;

//            echo '<pre>';
//            print_r($_POST);
//            echo '</pre>';

//            die();
//            die();
//            die();

            for ($i = 0; $i < $drug_order_count; $i = $i + 2){
                $id_info = array_values($_POST)[$i];
                if (strlen($id_info) != 0) {
                    $id_info = ltrim($id_info, $id_info[0]);
                    $concat_id_count = "drug_count_" . $id_info;
                    $drug_count = $_POST[$concat_id_count];

                    mysqli_query(
                        $conn,
                        "INSERT INTO `order` (`order_count`, `drug_sklad_id_drug_sklad`, `drug_sklad_drug_info_id_info`, check_id_check)
				                VALUES ('$drug_count', '$id_info', '$id_info', '$check_id')"
                    );
                }
            }

            $price = mysqli_query(
                $conn,
                "SELECT `price` FROM `drug_sklad` WHERE `id_drug_sklad` = '$id_info'"
            );
            $price = mysqli_fetch_assoc($price);
            $price = $price['price'];
            $total_price = $total_price + ($price * $drug_count - ($price * $drug_count) / 100 * $discount);

            $iduser = mysqli_fetch_assoc(mysqli_query(
                $conn,
                "SELECT `iduser` FROM `user` WHERE `number` = '$phone_number'"
            ));
            $iduser = $iduser['iduser'];

            mysqli_query(
                $conn,
                "UPDATE `check` SET `order_price`='$total_price', `user_iduser`='$iduser' WHERE `id_check` = '$check_id'"
            );

            if (!is_null($_SESSION['user'])) {
                if ($_SESSION['user']['role'] == 0){
                    $_SESSION['message'] = "Замовлення cформовано!";
                    header('Location: ../seller/select_order.php');
                }
            }
            else {
                $_SESSION['message'] = "Замовлення відправлено!";
                header('Location: ../../user/user.php');
            }
        }
        else{
            $_SESSION['message'] = "Такого номеру телефону в базі не існує. Спробуйте ще раз!";
            header('Location: ../../user/user.php');
        }
    }
}
else {
    $_SESSION['message'] = "Ви не вибрали жодного елемента";
    header('Location: ../../user/user.php');
}
?>