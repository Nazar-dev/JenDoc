<?php
session_start();
require_once "../connect.php";

$id_div = $_GET['id'];
$id_info = $_GET['name'];

$sql = mysqli_query(
    $conn,
    "SELECT `name`, `price`, `drug_count` FROM `drug_sklad` JOIN `drug_info` ON `drug_info_id_info` = `id_info` WHERE `id_drug_sklad` = '$id_info' AND `drug_count` > 0"
);
$row = mysqli_fetch_assoc($sql);

$js_concat = ltrim($id_info, $id_info[0]);

if(!empty($id_div)){ ?>
    <input type="hidden" name="id_info<?=$id_info?>" value="<?=$id_info?>">

    <ul>
        <label><?= $row['name'] ?></label>
        <div style="display: flex;flex-wrap: wrap;">
            <p style="width: 100px;margin-bottom: 0px;" id="price_<?=$js_concat?>" class="p-0 d-inline-flex align-items-center">Ціна - <?= $row['price'] ?>
            </p>
            <p style="display: flex;flex-wrap: wrap;margin-left: auto;margin-bottom: 0;" >
                <label class="p-0 d-inline-flex align-items-center">К-сть </label>
                <input style="width: 200px;margin-left: 5px" type="number" class="form-control" name="drug_count<?=$id_info?>" id="count_<?=$js_concat?>" value="1" min="1" max="<?= $row['drug_count'] ?>">
                <button style="margin-left: 10px"class="btn btn-danger" onclick="clearBox('message<?=$id_div?>', 'msg<?=$id_div?>');" id="<?=$id_div?>">Delete</button>
            </p>
        </div>
    </ul>
    <script>
        function change_price_<?=$js_concat?>() {
            let input = document.getElementById('count_<?=$js_concat?>');
            price_<?=$js_concat?>.textContent = "Ціна - " + <?=$row['price']?> * input.value;

        }
        count_<?=$js_concat?>.addEventListener('change', change_price_<?=$js_concat?>);
    </script>
    <?php
}else{ ?>
    <script>
        alert('Error adding drug!');
    </script>
    <?php
} ?>