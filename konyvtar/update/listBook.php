<?php
	session_start();
	require_once "../db.php";
	
	if ($_SESSION["username"] != "admin") {
		header("location: ../index.php");
	}
	$selectString = "SELECT * FROM book";
	$db = db::get();
	$books = $db->getArray($selectString);
?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once("../head.php"); ?>
	<style>
		.bg
		{
			background-image: url("http://www.budaorsiinfo.hu/wp-content/uploads/2013/12/konyv_illusztr.jpg");
			background-size: cover;
			background-repeat: none;
		}

		.bg img
		{
			height: 100%;
			width: 100%;
		}

	</style>
</head>
<body class="bg">
		
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="#">Adatszerkesztés</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
				<?php if($_SESSION["username"] == "admin"): ?>
					<li class="nav-item">
						<a class="nav-link" href="../list.php">Főoldal</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="listBooks.php">Könyv szerkesztés</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="listBook.php">Könyv kiadás szerkesztés</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="listWriter.php">Író szerkesztés</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="listCategory.php">Műfaj szerkesztés</a>
					</li>
				<?php endif; ?>
				</ul>
			</div>
		</nav>
		
			<?php foreach($books as $book):?>
			<div class="container text-center">
				<div class="card" style="width:800px">
					<div class="card-header text-center">
						<h4>
							<?php echo $book["book_title"]; ?>
						</h4>
					</div>
					<div class="card-body text-center">
						<img src="../image/<?php echo $book["cover_image"];?>" width="600" height="600">
					</div>
					<div class="card-footer">
						<h6>Fedél típus: <?php echo $book["lid"]; ?></h6><hr>
						<h6>Nyelv: <?php echo $book["language"]; ?></h6><hr>
						<h6>Megjelenés: <?php echo $book["publishing"]; ?></h6><hr>
						<h6>Mennyiség: <?php echo $book["quantity"]; ?></h6><hr>
						<h6>Történet: </h6><p><?php echo $book["story"]; ?></p><hr>
						<a href="bookEdit.php?bookid=<?php echo $book["id"];?>">Szerkesztés</a><hr>
						<a href="bookDelete.php?bookid=<?php echo $book["id"];?>">Törlés</a><hr>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
	</body>
</html>
