<?php
session_start();
require_once "../db.php";
$db = db::get();
$id = $db->escape($_GET["bookid"]);
$selectString = "SELECT * FROM book_edition LEFT JOIN category ON category_id = category.id LEFT JOIN writer ON writer_id = writer.id LEFT JOIN book ON book_id = book.id";
$book_editions = $db->getArray($selectString);

$selectCategoriesQuery = "SELECT * FROM category";
$allCategory = $db->getArray($selectCategoriesQuery);

$selectWritersQuery = "SELECT * FROM writer";
$allWriter = $db->getArray($selectWritersQuery);

$selectBookQuery = "SELECT * FROM book";
$allBook = $db->getArray($selectBookQuery);
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
					<li class="nav-item  active">
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

	<?php if(count($book_editions) == 0):?>
		Jelenleg nincs egy könyv sem!
		<?php else:?>
			<table class="table table-bordered container text-center">
				<thead>
					<tr>
						<th>#</th>
						<th>Cím</th>
						<th>Író</th>
						<th>Megjelenési dátum</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($book_editions as $book_edition):?>
						<tr>
							<td><?php echo $book_edition["id"]; ?></td>
							<td><?php echo $book_edition["book_title"]; ?></td>
							<td><?php echo $book_edition["writer_name"]; ?></td>
							<td><?php echo $book_edition["publishing"]; ?></td>
						</tr>
					<?php endforeach;?>
				<?php endif;?>		

				<div class="container">
					<div class="jumbotron">
						<h3>Tulajdonsagok modositasa erre:</h3>
						<div class="container">
							<form method="post">
								<select name="book" id="book">
									<?php foreach($allBook as $book): ?>
										<option value="<?php echo $book['id']; ?>" title="<?php echo $book['story']; ?>">Cim: <?php echo $book["book_title"]; ?></option>
									<?php endforeach; ?>
								</select>
								<select name="writer" id="writer">
									<?php foreach($allWriter as $writer): ?>
										<option value="<?php echo $writer['id']; ?>" title="<?php echo $writer['writer_birthday']; ?>">Cim: <?php echo $writer["writer_name"]; ?></option>
									<?php endforeach; ?>
								</select>
								<select name="category" id="category">
									<?php foreach($allCategory as $category): ?>
										<option value="<?php echo $category['id']; ?>">Cim: <?php echo $category["genre"]; ?></option>
									<?php endforeach; ?>
								</select>
								<button class="btn btn-primary" name="done">Done!</button>
								<button class="btn btn-danger" onclick="window.location.href='listBook.php'">Cancel</button>
							</form>
						</div>
					</div>
				</div>
			<?php 
				if (isset($_POST["done"])) {
					$newWriter = $db->escape($_POST["writer"]);
					$category = $db->escape($_POST["category"]);
					$book = $db->escape($_POST["book"]);

					$updateQuery = "UPDATE `book_edition` SET `writer_id` = '$writer', `book_id` = '$book', `category_id` = '$category' WHERE `book_edition`.`id` = ".$id;
					$update = $db->query($updateQuery);

					header("location: listBook.php");
				}
			 ?>
			</body>
			</html>
