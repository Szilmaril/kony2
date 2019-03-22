<?php
session_start();
require_once ("../db.php");
$db = db::get();

	if(isset($_GET["usersid"])){
		$id = $db->escape($_GET["usersid"]);
		if(isset($_POST["submitForm"])){
			$username = $db->escape($_POST["username"]);
			$email = $db->escape($_POST["email"]);
			if(empty($username) ||empty($email)){
				$errorMsg  = "Minden mező kitöltése kötelező";
			}else{
				$updateString = "UPDATE users SET
					`username`='".$username."',
					`email`='".$email."'
					WHERE id=".$id;
				$db->query($updateString);
				header("Location: listUser.php");
			}
		}
		$selectString = "SELECT * FROM users WHERE id=".$id;
		$users = $db->getRow($selectString);
	}else{
		header("Location: listUser.php");
		exit();
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
			<a class="navbar-brand" href="#">Beállítások</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="../list.php">Főoldal</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="listMyUser.php">Beállítások</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../logout.php">Kilépés</a>
					</li>
				</ul>
			</div>
		</nav>
		<form action="" method="POST">
			<label>Felhasználónév: </label>
			<input type="text" name="username" id="username" value="<?php echo (isset($users)) ? $users["username"] : "" ; ?>"><br>
			<label>Jelszó: </label>
			<input type="password" name="password" id="password" value="<?php echo (isset($users)) ? $users["password"] : "" ; ?>"><br>
			<label>Jelszó megerősítés: </label>
			<input type="password" class="input form-control" name="password_confirmation" id="passwordConfirmation" value="<?php echo (isset($users)) ? $users["password"] :"";?>">
			<label>Email cím: </label>
			<input type="email" name="email" id="email" value="<?php echo (isset($users)) ? $users["email"] : "" ; ?>"><br>
			<label>Születésnap: </label>
			<input type="date" name="birthday" id="birthday" value="<?php echo (isset($users)) ? $users["birthday"] : "" ; ?>"><br>
			<button type="submit" name="submitForm">Mentés</button>
		</form>
	</body>
</html>
