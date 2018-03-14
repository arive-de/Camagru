<?php
ob_start();
include_once('auth.php');

if (isset($_POST['img'], $_POST['com']))
{
	if ($_POST['com'] != '')
	{
		$img = $_POST['img'];
		$com = $_POST['com'];
		$login = $_SESSION['login'];
		$stmt = $db->prepare('INSERT INTO comments (login, id_image, comment) VALUES (:login, :id_image, :com);');
		$stmt->bindParam(':login', $login, PDO::PARAM_STR);
		$stmt->bindParam(':id_image', $img, PDO::PARAM_STR);
		$stmt->bindParam(':com', filter_var($com, FILTER_SANITIZE_STRING), PDO::PARAM_STR);
		$stmt->execute();
		$stmt = $db->prepare('SELECT login FROM gallery WHERE img = :id_image;');
		$stmt->bindParam(':id_image', $img, PDO::PARAM_STR);
		$stmt->execute();
		$login = $stmt->fetchColumn();
		$stmt = $db->prepare('SELECT mail_com FROM users WHERE login = :login;');
		$stmt->bindParam(':login', $login, PDO::PARAM_STR);
		$stmt->execute();
		$act = $stmt->fetchColumn();
		if ($act) {
			$stmt = $db->prepare('SELECT email FROM users WHERE login = :login;');
			$stmt->bindParam(':login', $login, PDO::PARAM_STR);
			$stmt->execute();
			$mail = $stmt->fetchColumn();
			$message = "Your picture received a comment";
			mail($mail, 'Comment', $message);
		}
		header('Location: gallery.php?page='.$_SESSION['page']);
	}
	else
	{
		?>
				<script language="javascript">
					window.alert("Empty comment");
				</script>
		<?php
		header('Location: gallery.php?page='.$_SESSION['page']);
		ob_end_flush();
	}
}
?>