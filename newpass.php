<?php
ob_start();
include_once("auth_gallery.php");
if (isset($_SESSION['login']))
	header('Location: homepage.php');
if (isset($_GET['hash'])) {
	$match = $_GET['hash'];
	$stmt = $db->prepare('SELECT login FROM `users` WHERE hash = :hash');
	$stmt->bindParam(':hash', $match, PDO::PARAM_STR);
	$stmt->execute();
	$hashid = hash('whirlpool', rand(15000, 200000));
	$res = $stmt->fetchColumn();
	$url = explode('/', $_SERVER['REQUEST_URI'])[2];
	if ($res)
	{
		if (isset($_POST['newpass']))
		{
			if ($_POST['newpass'] != '')
			{
				$login = $_POST['login'];
				$passwd = $_POST['newpass'];
				if (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])#', $passwd) && strlen($passwd) < 8) {
					?>
						<script language="javascript">
						window.alert("Caps, min, alpha, 8 characters");				
						</script>
						<?php
				}
				else
				{
					$hash = hash('whirlpool', $passwd);
					$stmt = $db->prepare('UPDATE users SET passwd = :passwd WHERE (login = :login);');
					$stmt->bindParam(':passwd', $hash, PDO::PARAM_STR);
					$stmt->bindParam(':login', $login, PDO::PARAM_STR);
					$stmt->execute();
					$stmt = $db->prepare('UPDATE users SET hash = :hash WHERE (login = :login);');
					$stmt->bindParam(':hash', $hashid, PDO::PARAM_STR);
					$stmt->bindParam(':login', $res, PDO::PARAM_STR);
					$stmt->execute();
					header('Location: index.php');
					ob_end_flush();
				}
			}
		}

	}
	else
	{	
		?>
			<script language="javascript">
			window.alert("Link is used");				
			</script>
		<?php
	}
}
?>

<div class='connect'>
<form class='formulaire1' action='<?php $url?>' method='post'>
Login : <?php
	echo $res;
?><br><br>
New password : <br>
		<input type="password" name="newpass" value="" ><br><br>
		<input name='login' id='login' type='hidden' value='<?=$res;?>'/>
		<input type="submit" name="submit" value="Set my new password"><br><br><br>
</form>
</div>
</body>
</html>

<?php 

include_once('footer.php');