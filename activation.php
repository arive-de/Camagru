<?php

include('auth.php');

if (isset($_GET['hash'])) {
	$zero = 0;
	$one = 1;
	$match = $_GET['hash'];
	$stmt = $db->prepare('SELECT login FROM `users` WHERE hash = :hash AND active = :active');
	$stmt->bindParam(':hash', $match, PDO::PARAM_STR);
	$stmt->bindParam(':active', $zero, PDO::PARAM_STR);
	$stmt->execute();
	$res = $stmt->fetchColumn();
	$hashid = hash('whirlpool', rand(15000, 200000));
	if ($res)
	{	
		$stmt = $db->prepare('UPDATE users SET active = :active WHERE (hash = :hash)');
		$stmt->bindParam(':active', $one, PDO::PARAM_STR);
		$stmt->bindParam(':hash', $match, PDO::PARAM_STR);
		$stmt->execute();
		$stmt = $db->prepare('UPDATE users SET hash = :hash WHERE (login = :login);');
		$stmt->bindParam(':hash', $hashid, PDO::PARAM_STR);
		$stmt->bindParam(':login', $res, PDO::PARAM_STR);
		$stmt->execute();
		header("Location: index.php?activate=1");
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