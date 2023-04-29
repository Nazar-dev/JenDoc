<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../assets/css/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<title>Apteka</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script>
		function clearBox(elementID, element2ID)
		{
			document.getElementById(elementID).innerHTML = "";
            document.getElementById(element2ID).innerHTML = "";
            <?php
            unset($_SESSION['order']);
            ?>
		}
	</script>
</head>
<body>
	<div id="header">
		<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 p-3 border-bottom">
	      <a href="#" id="1" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
	      	<img src="../assets/img/3248924.png" class="bi me-2" width="40" height="40">
	      	<h1 aria-label="Bootstrap">Аптека</h1>
	      </a>
	    </header>
	</div>



    <div class="row m-0" style="height: auto;">
    	<div class="flex-shrink-0 pl-3 pt-3 bg-white col">
		    <a href="#" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
		    	<img src="../assets/img/114903.png" class="bi pe-none me-2" width="30" height="24">
		     	<span class="fs-5 fw-semibold">Асортимет</span>
		    </a>
			<ul class="list-unstyled ps-0">
				<?= $_SESSION['list'] ?>
		    </ul>
  		</div>



		<div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white col-5" id="items">
		    <div id="koz" class="d-flex align-items-center flex-shrink-0 p-3 text-decoration-none border-bottom">
		      <img src="../assets/img/Cart-PNG-HD-Quality.png" class="bi pe-none me-2" width="30" height="24">
		      <span class="fs-5 fw-semibold">Корзина</span>
		    </div>
		    <div class="video list-group list-group-flush border-bottom" id="item" style="overflow: auto;">
                <form action="../vendor/user/send_order.php" method="post">
                    <?= $_SESSION['divs'] ?>
                    <?php
                    if (isset($_SESSION['message'])) {
                        echo '<p class=""> ' . $_SESSION['message'] . ' </p>';
                    }
                    unset($_SESSION['message']);
                    ?>
                    <div id="submit" style="position:fixed;bottom: 65px;">
			            <div style="display: flex;flex-wrap: wrap;">
			                <input type="text" class="form-control" id="number" name="phone_number" placeholder="+380"> 
			                <button id="test"style="margin-left: auto;" class="btn btn-primary mb-0 disabled" type="button">Отримати знижку</button>
			            </div>
			            <button type="submit" class="btn btn-primary mt-3 login_btn">Відправити замовлення</button>
		            </div>
                </form>
		    </div>

	    </div>
    </div>

    <div id="footer" class="footer">
		<footer id="footer" class="d-flex flex-wrap justify-content-between align-items-center py-3 mb-4 border-top">
		    <div class="col-md-4 d-flex align-items-center">
		      <a href="#" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
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
	<script>
		window.onload = function () {
			document.addEventListener("click", function (e) {
				let elem = e.target;
				let ids = elem.id;
                let idsb = elem.getAttribute('name');
				let count = <?= $_SESSION['count'] ?>;

				for(let i = 1; i <= count; i++){
					if(ids == ('el' + i)){
                        $.ajax({
                            url: '../vendor/user/listing.php?id=' + i + '&name=' + idsb,
                            dataType: 'html',
                            data: $(this).serialize(),
                            success: function(data){
                                $('#message' + i).html(data);
                                // $('#msg' + i).html(data);
                            }
                        });
				    }
				}
			});
		}
	</script>
	<script type="text/javascript">
		document.getElementById('submit').style.width = document.getElementById('item').scrollWidth + 'px';
	   	document.getElementById('item').style.height = document.documentElement.scrollHeight - document.getElementById('header').scrollHeight - document.getElementById('footer').scrollHeight - document.getElementById('koz').scrollHeight - document.getElementById('submit').scrollHeight + 'px';
	   	document.getElementById('number').style.width = document.getElementById('item').scrollWidth - document.getElementById('test').scrollWidth - 25 + 'px';
	</script>
	<script src="../assets/js/script.js"></script>
<!--    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>