<?php 
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
?>
