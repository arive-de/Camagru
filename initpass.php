<?php
include_once("auth_gallery.php");

if (isset($_POST['mail']))
{
	if ($_POST['mail'] != '')
	{
		$mail = $_POST['mail'];
		$stmt = $db->prepare("SELECT hash FROM users WHERE email = :email;");
		$stmt->bindParam(':email', $mail, PDO::PARAM_STR);
		$stmt->execute();
		$res = $stmt->fetchColumn();
		if ($res)
		{
			$hashid = $res;
			$message = "Hey ".$login." !\n\nClic on this link to modify your password.\n\n http://localhost:8080/Camagru/newpass.php?hash=".$hashid."\n\n ------------- \n This is an automated email, please do not answer.";
			mail($mail, 'Reset password', $message);
			
			?>
				<script language="javascript">
				window.alert("Please go on your mailbox and set a new password !");
				</script>
			<?php
		}
		else
		{
			?>
			<script language="javascript">
			window.alert("This email isn't valid");
			</script>
			<?php
		}
	}
	else
	{
		?>
			<script language="javascript">
			window.alert("Please write an email");
			</script>
		<?php
	}
}

?>

<div class='connect'>
<form class='formulaire1' action='initpass.php' method='post'>
Email : <br>
		<input type="text" name="mail" value="" ><br><br>
		<input type="submit" name="submit" value="Send mail to reset password"><br><br><br>
</form>
</div>
</body>
</html>

<?php 

include_once('footer.php');

?>