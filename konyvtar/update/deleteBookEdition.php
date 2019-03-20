
<html>
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="jumbotron">
			<h2>Biztos?</h2>
			<small>A konyv orokre letorlodik. (Ez eleg hosszu ido..)</small>
		</div>
		<form method="post">
			<button name="delete" class="btn btn-danger">PUSZTULJON!!</button>
			<a href="listBook.php" class="btn btn-primary">NEEEEEEEEEEEEEEE.....</a>
		</form>
	</div>
</body>
</html>
<?php 
if (isset($_POST["delete"])) {
	if(isset($_GET["booksid"])){
		require_once "../db.php";
		$db = db::get();
		$id = $db->escape($_GET["booksid"]);
		$deleteString = "DELETE FROM book_edition WHERE id=".$id;
		$db->query($deleteString);
		header("Location: listBooks.php?done");
	}else{
		header("listBooks.php");
	}
}
?>
