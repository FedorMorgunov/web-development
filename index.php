<?php
session_start();
include 'navbar.php';
if(isset($_SESSION['username'])) {
  echo "<h1 class='text-center'>Welcome to Pairs</h1>";
  echo "<div class='text-center'><a href='pairs.php' class='btn btn-primary'>Click here to play</a></div>";
} else {
  echo "<h1 class='text-center'> You're not using a registered session?</h1>";
  echo "<div class='text-center'><a href='registration.php' class='btn btn-primary'>Register now</a></div>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Pairs</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<!-- Meta viewport tag for responsive layout -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		body {
			background-image: url('arcade-unsplash.jpg');
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: 100% 100%;
			color: #fff;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
			</div>
		</div>
	</div>

	<!-- Bootstrap JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>