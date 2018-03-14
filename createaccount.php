<?php
include_once("auth.php");

if (isset($_POST['login2'], $_POST['passwd2'], $_POST['mail']))
{
	if ($_POST['login2'] != '' && $_POST['passwd2'] != '' && $_POST['mail'] != '')
	{
			$login = $_POST['login2'];
			$passwd = $_POST['passwd2'];
			if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])#', $passwd))
			{
				if (strlen($passwd) < 8) {
					?>
					<script language="javascript">
					window.alert("Caps, min, alpha, 8 characters");				
					</script>
					<?php

				}
				else
				{
					$mail = $_POST['mail'];
					if (!preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $mail)) {
					?>
						<script language="javascript">
						window.alert("This email isn't valid");				
						</script>
					<?php
					}
					else
					{
						$hash = hash('whirlpool', $passwd);
						$hashid = hash('whirlpool', rand(15000, 200000));
						$stmt = $db->prepare('SELECT COUNT(*) FROM `users` WHERE login = :login');
			   			$stmt->bindParam(':login', $login, PDO::PARAM_STR);
						$stmt->execute();
			   			$res = $stmt->fetchColumn();
			   			$stmt = $db->prepare('SELECT COUNT(*) FROM `users` WHERE email = :email');
			   			$stmt->bindParam(':email', $mail, PDO::PARAM_STR);
						$stmt->execute();
			   			$res2 = $stmt->fetchColumn();
			   			if (!$res && !$res2)
			   			{
							$stmt = $db->prepare('INSERT INTO users (login, passwd, email, hash) VALUES (:login, :passwd, :email, :hash)');
				   			$stmt->bindParam(':login', filter_var($login, FILTER_SANITIZE_STRING), PDO::PARAM_STR);
				   			$stmt->bindParam(':passwd', $hash, PDO::PARAM_STR);
				   			$stmt->bindParam(':email', filter_var($mail, FILTER_SANITIZE_STRING), PDO::PARAM_STR);
				   			$stmt->bindParam(':hash', $hashid, PDO::PARAM_STR);
				   			$stmt->execute();
				   			include_once('sendmail.php');
				   			?>
							<script language="javascript">
							window.alert("Please go on your mailbox and validate your account !");
							</script>
							<?php
				   		}
						else {
						?>
							<script language="javascript">
							window.alert("This login is taken already");
							</script>
						<?php
						}
					}
				}
			}
			else
			{
				?>
				<script language="javascript">
				window.alert("Please letters AND alpha");
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