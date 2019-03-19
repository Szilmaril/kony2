<?php 
	session_start();
	if(isset($_GET["bookid"])){
		require_once "../db.php";
		$db = db::get();
		$id = $db->escape($_GET["bookid"]);

		$selectBookDataQuery = "SELECT * FROM book WHERE id=".$id;
		$allData = $db->getArray($selectBookDataQuery);
	}
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
					<li class="nav-item active">
						<a class="nav-link" href="listBooks.php">Könyv szerkesztés</a>
					</li>
					<li class="nav-item">
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
		<?php if(count($allData) < 1): ?>
			<div class="container">
				<div class="btn btn-danger">Ez a konyv nem letezik.</div>
			</div>
		<?php endif; ?>
		<?php if(count($allData) > 0): ?>
			<?php foreach($allData as $data): ?>
				<div class="container">
					<img src="../image/<?php echo $data['cover_image']; ?>" class="text-center" alt="Borito kepe" style="border-radius: 50%; height: 25vh; width: 25vw;">
				<form class="form-group" action="updateBookData.php?bookid=<?php echo $data['id']; ?>" method="post" enctype="multipart/form-data">
					<div class="form-row">
						<label for="story">Sztori</label>
						<input type="text" name="story" id="story" value="<?php echo $data['story']; ?>">
					</div>
					<div class="form-row">
						<label for="book_title">Cim</label>
						<input type="text" name="book_title" id="book_title" value="<?php echo $data['book_title']; ?>">
					</div>
					<div class="form-row">
						<label for="lid">Kivitelezes</label>
						<input type="text" name="lid" id="lid" value="<?php echo $data['lid']; ?>">
					</div>
					<div class="form-row">
						<label for="quantity">Mennyiseg</label>
						<input type="number" min="0" name="quantity" id="quantity" value="<?php echo $data['quantity']; ?>">
					</div>
					<div class="form-row">
						<label for="language">Nyelv</label>
						<input type="text" name="language" id="language" value="<?php echo $data['language']; ?>">
					</div>
					<button name="updateBook" class="btn btn-success">Adatok szerkeztese</button>
				</form>
				<form method="post" action="updateBook.php?bookid=<?php echo $data['id']; ?>" enctype="multipart/form-data">
							<div class="form-group">
								<label for="exampleFormControlFile1">Uj kep feltoltese</label>
								<input type="file" class="form-control-file" name="fileToUpload2" id="exampleFormControlFile1">
								<button class="btn btn-success" name="uploadPicture">Kep frissitese</button>
							</div>
						</form>
				</div>
				
			<?php endforeach; ?>
		<?php endif; ?>
	</body>
	</html>
