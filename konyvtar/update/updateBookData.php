<?php 
	if (isset($_GET["bookid"])) {
		require_once "../db.php";
		$db = db::get();
		$id = $db->escape($_GET["bookid"]);
		$story = $db->escape($_POST["story"]);
		$book_title = $db->escape($_POST["book_title"]);
		$lid = $db->escape($_POST["lid"]);
		$quantity = $db->escape($_POST["quantity"]);
		$language = $db->escape($_POST["language"]);

		$updateQuery = "UPDATE `book` SET `story` = '$story', `book_title` = '$book_title', `lid` = '$lid ', `quantity` = '$quantity', `language` = '$language' WHERE `book`.`id` = ".$id;
		$update = $db->query($updateQuery);
		echo "<script>window.location.href='listBook.php?success=done';</script>";
	}
	else
	{
		echo "<script>window.location.href='listBook.php?error=unknown';</script>";
	}
 ?>