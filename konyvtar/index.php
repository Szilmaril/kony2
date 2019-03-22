<?php 
	session_start();
	if (isset($_SESSION["username"])) {
		header("location: list.php");
	}
	require_once "db.php";
	$db = db::get();
 ?>

<!DOCTYPE html>
<html>
	<head>
		<?php require_once("head.php"); ?>
		<style>
			body
			{
				background-image: url("image/bg.jpg");
				background-repeat: no-repeat;
				background-size: cover;
			}

			.jumbotrontext
			{
				background-color: rgba(255,255,255,.3);
			}

			.input
			{
				-webkit-box-shadow: inset 13px 6px 26px -2px rgba(0,0,0,0.75);
				-moz-box-shadow: inset 13px 6px 26px -2px rgba(0,0,0,0.75);
				box-shadow: inset 13px 6px 26px -2px rgba(0,0,0,0.75);
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="jumbotron jumbotrontext text-center"><h2>Üdvözöllek!</h2></div>
			<form class="container form-group" action="" method="POST" style="color: white;">
				<div class="form-row">
					<label for="username">Felhasználónév: </label>
					<input type="text" id="username" name="username" class="input form-control" id="username" value="<?php echo (isset($users)) ? $users["username"] : "" ; ?>">
				</div>
				<div class="form-row">
					<label>Jelszó: </label>
					<input type="password" class="input form-control" name="password" id="password" value="<?php echo (isset($users)) ? $users["password"] :"";?>">
				</div>
				<div class="form-row">
					<label>Jelszó ellenörzés: </label>
					<input type="password" class="input form-control" name="password_confirmation" id="passwordConfirmation" value="<?php echo (isset($users)) ? $users["password"] :"";?>">
				</div>
				<div class="form-row">
					<label>Email: </label>
					<input type="email" class="input form-control" name="email" id="email" value="<?php echo (isset($users)) ? $users["email"] :"";?>"><br>
				</div>

				<div class="form-row">
					<label>Születésnap: </label>
					<input type="date" class="input form-control" name="birthday" id="birthday" value="<?php echo (isset($users)) ? $users["birthday"] :""; ?>">
				</div>
				<hr>
				<div class="form-row">
					<button class="btn btn-success" type="submit" name="submitForm">Mentés</button>
					<a class="btn btn-info" href="login.php" class="btn btn-primary">Bejelentkezés</a>
				</div>
			</form>
		</div>
		
	</body>
</html>
<?php 
	if(true){
		if(isset($_POST["submitForm"])){
			$username = $db->escape($_POST["username"]);
			$password = $db->escape($_POST["password"]);
			$email = $db->escape($_POST["email"]);
			$birthday = $db->escape($_POST["birthday"]);
			$password_confirmation = $db->escape($_POST["password_confirmation"]);
			if(empty($username) || empty($password) || empty($email) || empty($birthday)){
				$errorMsg = "Minden mező kitöltése kötelező";
		}else{
			if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				$errorMsg = "Az emailcím nem megfelelő formátumú";
			}else if(strlen(trim($password)) < 8){
				$errorMsg = "A jelszónak legalább 8 karakternek kell lennie";
			}else if($password != $password_confirmation){
					$errorMsg = "A jelszó és a jelszó megerősítésnek egyeznie kell!";
				}else{
					$insertString = "INSERT INTO users(
				`username`,
				`password`,
				`email`,
				`birthday`
				) VALUE(
				'".$username."',
				'".md5($password)."',
				'".$email."',
				'".$birthday."'
				);";
				$db->query($insertString);
				$_SESSION["username"] = $username;
				header("location: list.php");
				}
			}
		}
	}
?>
