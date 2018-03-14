<?php
include_once("auth.php");

if (isset($_POST['login'], $_POST['passwd']))
{
	if ($_POST['login'] != '' && $_POST['passwd'] != '')
		{
			$login = $_POST['login'];
			$passwd = $_POST['passwd'];
			$hash = hash('whirlpool', $passwd);
			$stmt = $db->prepare('SELECT * FROM `users` WHERE login = :login AND passwd = :passwd;');
   			$stmt->bindParam(':login', $login, PDO::PARAM_STR);
   			$stmt->bindParam(':passwd', $hash, PDO::PARAM_STR);
   			$stmt->execute();
   			$res = $stmt->fetchColumn(7);
   			$stmt2 = $db->prepare('SELECT * FROM `users` WHERE login = :login');
   			$stmt2->bindParam(':login', $login, PDO::PARAM_STR);
   			$stmt2->execute();
   			$mail = $stmt2->fetchcolumn(1);
			if ($res)
			{
				$_SESSION['login'] = $login;
				$_SESSION['mail'] = $mail;
				header("Location: homepage.php");
			}
			else
			{
				?>
					<script language="javascript">
					window.alert("Invalid account");
					</script>
				<?php
			}
		}
		else
		{
			?>
				<script language="javascript">
				window.alert("Please fill the gaps");
				</script>
			<?php
		}
}
?>
