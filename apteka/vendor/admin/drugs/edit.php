<?php
require '../../connect.php';

error_reporting(0);

$id = $_GET['id'];

$drug = mysqli_query($conn, "SELECT `price`, `drug_count` FROM `drug_sklad` WHERE `id_drug_sklad`='$id'");

$drug = mysqli_fetch_assoc($drug);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>

  <div id="header">
		<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 p-3 border-bottom">
	      <a href="../../../admin/drugs.php" id="1" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
	      	<img src="../../../assets/img/3248924.png" class="bi me-2" width="40" height="40">
	      	<h1 aria-label="Bootstrap">Редагування</h1>
	      </a>
	    </header>
	</div>
  <form style="width: 700px; margin: 0 auto;" action="editing.php" method="POST">
    <input type="hidden" name="id" value="<?=$id?>">
    <div class="form-group">
      <label for="exampleInputEmail1">Ціна</label>
      <input type="number" class="form-control" id="exampleInputEmail1" value="<?=$drug['price']?>" name="price" required>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">К-сть на складі</label>
      <input type="number" class="form-control" id="exampleInputPassword1" value="<?=$drug['drug_count']?>" name="drug_count" required>
    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 16px; width: 700px;">Submit</button>
    <?php
      if($_GET['check'] == 1){
        ?>  
          <p>Редагування успішне!</p>
        <?php
      }elseif($_GET['check'] == 2){
        ?>  
          <p>Редагування не вдалось!</p>
        <?php
      }
    ?>
  </form>
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
</body>
</html>

