<?php
session_start();

if (!$_SESSION) {
    header('Location: ../login/log.php');
}
elseif ($_SESSION['user']['role'] != 1) {
    header('Location: ../login/log.php');
}
error_reporting(0);

require '../vendor/connect.php';

$sellers = mysqli_query($conn, "SELECT * FROM `worker` WHERE `role` = '0'");

$sellers = mysqli_fetch_all($sellers);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<title>Admin</title>
</head>
<body>
    <div id="header">
		<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 p-3 border-bottom">
	      <a href="admin.php" id="1" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
	      	<img src="../assets/img/3248924.png" class="bi me-2" width="40" height="40">
	      	<h1 aria-label="Bootstrap">Адмін Панель</h1>
	      </a>
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="admin.php" class="nav-link active" aria-current="page">Касири</a></li>
            <li class="nav-item"><a href="drugs.php" class="nav-link">Ліки</a></li>
            <li class="nav-item"><a href="discount.php" class="nav-link">Система знижок</a></li>
            <li class="nav-item"><a href="statistic.php" class="nav-link">Статистика</a></li>
        </ul>
	    </header>
	</div>
    <main style="max-width: 1000px; margin: 0 auto;">
        <table class="table table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Ім'я</th>
            <th scope="col">Прізвище</th>
            <th scope="col">Логін</th>
            <th scope="col">Пароль</th>
            <th scope="col">Редагування</th>
            <th scope="col">Видалення</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($sellers as $seller){
                    ?>
                    <tr>
                        <th scope="row"><?=$seller[0]?></th>
                        <td><?=$seller[4]?></td>
                        <td><?=$seller[3]?></td>
                        <td><?=$seller[1]?></td>
                        <td><?=$seller[2]?></td>
                        <td><a href="../vendor/admin/seller/edit.php?id=<?=$seller[0]?>">Редагувати</a></td>
                        <td><a href="../vendor/admin/seller/delete.php?id=<?=$seller[0]?>">Видалити</a></td>
                    </tr>
                    <?php
                }
            ?>
        </tbody>
        </table>

        <a type="button" class="btn btn-success" style="width: 100%; border-radius: 0;" href="../vendor/admin/seller/add.php">Створити касира</a>
    </main> 
    <?php
        if($_SESSION['check'] == 1){
            ?>
            <script>alert("Успішно")</script>
            <?php
            unset($_SESSION['check']);
        }elseif($_SESSION['check'] == 2){
            ?>
            <script>alert("Помилка")</script>
            <?php
            unset($_SESSION['check']);
        }
    ?>
    <div id="footer" class="footer">
        <footer id="footer" class="d-flex flex-wrap justify-content-between align-items-center py-3 mb-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
              <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
              </a>
              <span class="mb-3 mb-md-0 text-muted">© 2022 Company, Inc</span>
            </div>

            <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
              <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"></use></svg></a></li>
              <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"></use></svg></a></li>
              <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"></use></svg></a></li>
            </ul>
        </footer>
    </div>
<script src="../assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>   
</body>
</html>