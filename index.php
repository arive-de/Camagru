<?php
include_once("auth.php");

if (isset($_SESSION['login']))
	header('Location: homepage.php');

include_once('login.php');
include_once('createaccount.php');
?>

<html>
	<head>
			<title>Camagru</title>
			<link rel="stylesheet" href="front.css">
			<meta charset="utf-8">
	</head>

	<body>
		<p class="prg">Camagru<p>
			<div class="index_header">
				<div><a class="index_tab" href="gallery.php">Gallery</a></div>
			</div>		
		<hr><br>
		<?php
				if (isset($_GET['activate']))
					echo '<div>Your account has been activated, you may now connect !!</div>';
		?>
		<div class="connect">
		<form class="formulaire1" action="index.php" method="post">
			<h3>ALREADY HAVE AN ACCOUNT ?</h3>
			<br><br>
			Login :<br>
			<input type="text" name="login" value="" ><br>
			Password :<br/>
			<input type="password" name="passwd" value=""><br>
			<a href='initpass.php'>forgot your password ?</a><br><br>
			<input type="submit" name="submit" value="Login"><br><br><br>
		</form>
		<form class="formulaire2" action="index.php" method="post">
			<h3>CREATE YOUR ACCOUNT</h3><br><br>
			Login :<br />
			<input type="text" name="login2" value="" ><br />
			Password : (Caps, min, alpha, 8 chars) <br/>
			<input type="password" name="passwd2" value="" /><br />
			Email adress :<br/>
			<input type="mail" name="mail" value="" /><br /><br><br>
			<input type="submit" name="submit" value="Subscribe" />
		</form>
		</div>
	</body>
</html>

<?php 

include_once('footer.php');

?>