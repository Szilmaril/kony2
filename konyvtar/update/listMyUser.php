<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
require_once ("../db.php");
$db = db::get();

$selectUserDataQuery = "SELECT * FROM users WHERE username = '".$_SESSION["username"]."'";
$userData = $db->getArray($selectUserDataQuery);

if (isset($_GET["success"])) {
	$success = $db->escape($_GET["success"]);
}

if (isset($_GET["error"])) {
	$error = $db->escape($_GET["error"]);
}

?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once("../head.php"); ?>
		<link rel="stylesheet" href="../css/sweetalert2.min.css">
		<script src="../js/sweetalert2.all.min.js"></script>
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
		<script>
			function errormsg(errortext)
			{
				Swal.fire({
					type: 'error',
					title: 'Oops...',
					text: errortext + "!",
					footer: "If you need help, contact us <a href='../index.php' style='color:black;text-decoration:none;'> <i class='fas fa-arrow-right'></i></a>."
				})
			}

			function okmsg(oktext)
			{
				Swal.fire(
					'Ok!',
					oktext + '!',
					'success'
					)
			}

		</script>
	</head>
	<body class="bg">
		<?php 
  switch ($error) {

   case 'noMatch':
   echo "<script>errortext = 'Your passwords doesnt match'; errormsg(errortext);</script>";
   break;

   case 'invalidPW':
   echo "<script>errortext = 'Your new passwords doesnt match. They didnt change.'; errormsg(errortext);</script>";
   break;

   case 'empty':
   echo "<script>errortext = 'All data must be given.'; errormsg(errortext);</script>";
   break;

   case 'wrongPW':
   echo "<script>errortext = 'Wrong password entered. No changes made'; errormsg(errortext);</script>";
   break;

   default:
     # code...
   break;
 }

 if ($success == "donePW") {
   echo "<script>oktext = 'It is done. Next time you must use your new password for login'; okmsg(oktext);</script>";
 }

 if ($success == "done") {
   echo "<script>oktext = 'Succesful modifications'; okmsg(oktext);</script>";
 }
 ?>
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
		<div class="container">
			<div class="jumbotron"><h3><?php echo $_SESSION["username"]." "; ?>profiljanak szerkesztese</h3></div>
			<?php foreach($userData as $user): ?>
			<form action="setuserdata.php" method="post" class="form-group">
				<div class="form-row">
					<label for="emailAddress">Email</label>
					<input type="email" id="emailAddress" name="emailAddress" class="form-control" value="<?php if(!empty($user['email'])){echo $user['email'];} ?>" placeholder="Email cim" required="true">

					<label for="newPassword">Uj Jelszo (Opcionalis)</label>
					<input type="password" id="newPassword" name="newPassword" class="form-control" value="" placeholder="Uj Jelszo (Opcionalis)">

					<label for="newPassword2">Uj Jelszo megerositese (Opcionalis)</label>
					<input type="password" id="newPassword2" name="newPassword2" class="form-control" value="" placeholder="Uj Jelszo megerositese (Opcionalis)">

					<label for="birthday">Szuletesnap</label>
					<input type="date" id="birthday" name="birthday" class="form-control" value="<?php if(!empty($user['birthday'])){echo $user['birthday'];} ?>" required="true">

					<label for="currentPassword">Modositashoz add meg jelenlegi jelszavad</label>
					<input type="password" id="currentPassword" name="currentPassword" class="form-control" value="" placeholder="Modositashoz add meg jelenlegi jelszavad" required="true">

					<button class="btn btn-success" name="updateProfile">Mentes</button>
				</div>
			</form>
		<?php endforeach; ?>
		</div>
	</body>
</html>
