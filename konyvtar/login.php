<?php session_start();

if(isset($_POST["login"])){
	require_once "db.php";
	$db = db::get();
	$username = $db->escape($_POST["username"]);
	$password = $db->escape($_POST["password"]);
	$passwordhashed = md5($password);

	if(empty($username) || empty($password)){
		$errorMsg = "Minden mező kitöltése kötelező!";
	}
	else
	{
		$selectString = "SELECT * FROM users where `username`='$username' && `password` = '$passwordhashed' LIMIT 1";
		$userCheck = $db->getArray($selectString);
		if(count($userCheck) == 0){
			$errorMsg = "Hibás email vagy jelszó!";
		}else{

			$_SESSION["username"] = $username;
			header("Location: list.php");
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/login.css">
	<style>
		html, body {
			overflow: hidden;
		}

	</style>
</head>
<body background="image/login.jpg">
	<div class="container" style="margin-top: 5%;">
		<div class="text-center">
			<form action="" method="POST">
				<div class='box2'>
					<img src='image/login.jpg' style="opacity: 0;">
					<div class='box-content'>
						<div class='inner-content'>
							<h3 class='title text-center'>Bejelentkezes</h3>
							<span class='post'>
								<div class='container text-center'>
									<div class='form-roup'>
										<form method='POST'>
											<div class='form-row'>
												<div class='col'>
													<input type='text' name='username' id="username" class='registry' placeholder='username' required="true">
													<input class='registry' type='password' id="password" name='password' placeholder='jelszo' required="true">
												</div>		
											</div>
											<div class='form-row'>
												<div class='col'>
													<br>
													<button class='btn btn-primary' name='login' >Belepes</button>
													<button class='btn btn-danger' name='login' onclick="window.location.href='index.php'">Vissza</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</span>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>