<?php 
	session_start();
	if(isset($_GET["writerid"])){
		require_once "../db.php";
		$db = db::get();
		$id = $db->escape($_GET["writerid"]);

		$selectWriterDataQuery = "SELECT * FROM writer WHERE id=".$id;
		$allwriter = $db->getArray($selectWriterDataQuery);
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
					<li class="nav-item">
						<a class="nav-link" href="listBooks.php">Könyv szerkesztés</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="listBook.php">Könyv kiadás szerkesztés</a>
					</li>
					<li class="nav-item  active">
						<a class="nav-link" href="listWriter.php">Író szerkesztés</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="listCategory.php">Műfaj szerkesztés</a>
					</li>
				<?php endif; ?>
				</ul>
			</div>
		</nav>
		<?php if(count($allwriter) < 1): ?>
			<div class="container">
				<div class="btn btn-danger">Ez az író letezik.</div>
			</div>
		<?php endif; ?>
		<?php if(count($allwriter) > 0): ?>
			<?php foreach($allwriter as $writer): ?>
				<div class="container">
					<img src="../image/<?php echo $writer['writer_picture']; ?>" class="text-center" alt="Borito kepe" style="border-radius: 50%; height: 25vh; width: 25vw;">
				<form class="form-group" action="updateWriterData.php?writerid=<?php echo $writer['id']; ?>" method="post" enctype="multipart/form-data">
					<div class="form-row">
						<label for="writer_name">Név:</label>
						<input type="text" name="writer_name" id="writer_name" value="<?php echo $writer['writer_name']; ?>">
					</div>
					<div class="form-row">
						<label for="writer_birthday">Születésnap:</label>
						<input type="date" name="writer_birthday" id="writer_birthday" value="<?php echo $writer['writer_birthday']; ?>">
					</div>
					<div class="form-row">
						<label for="life_story">Történet:</label>
						<input type="text" name="life_story" id="life_story" value="<?php echo $writer['life_story']; ?>">
					</div>
					<button name="updateWriter" class="btn btn-success">Adatok szerkeztese</button>
				</form>
				<form method="post" action="updateWriter.php?writerid=<?php echo $writer['id']; ?>" enctype="multipart/form-data">
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