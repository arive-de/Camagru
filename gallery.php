<?php
include('auth_gallery.php');
if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] < 2147483648)
	$page = $_GET['page'];
else
	$page = 1;
$_SESSION['page'] = $page;
$stmt = $db->prepare('SELECT count(*) FROM gallery;');
$stmt->execute();
$res = $stmt->fetchAll();
$nb = $res[0][0];
$stmt = $db->prepare('SELECT * FROM gallery ORDER BY id DESC');
$stmt->execute();
$res = $stmt->fetchAll();
?>
<ul id="gallery">
<?php
foreach($res as $row) {
	echo '<div class=\'wrapper-picture-comment\'>';
	echo '<div class=\'wrapper-picture\'>';
	echo '<li><img src="' . $row['img'] . '" alt="' . $row['img'] . '" width=320 height=240></li>';
	
	?>
<form class="delete" action="deletetodb.php" method="post">
	<?php if ($_SESSION['login'] != '') { 
		if ($row[1] == $_SESSION['login']) {
	?>
	<input class='' type='submit' value='X'>
	<input class='' type='hidden' value='<?=$row['img']?>' name='delimg'/>
	<?php } } ?>
</form>
</div>
<form class="delcmt" action="delcomment.php" method="post">
<div class='wrapper-comment-miaou'>
<div class='wrapper-comment-comment'>
<?php
		$stmt = $db->prepare('SELECT * FROM comments WHERE id_image = :id_image;');
		$stmt->bindParam(':id_image', $row['img'], PDO::PARAM_STR);
		$stmt->execute();
		$res = $stmt->fetchAll();
		foreach ($res as $key => $raw) { ?>

		<textarea id='textcom' readonly="readonly" disabled="yes"><?php echo $raw[1]." : ".$raw[3] ?></textarea>
		<?php if ($raw[1] == $_SESSION['login']) { ?>
		<input type="image" src='ressources/cross.png' width='15' height='15'><br>
		<input class='' type='hidden' value='<?=$raw[3]?>' name='delcom'/>
		<?php } else echo '<br>'?>
<?php } ?>
</form>
<form class="cmt" action="comment.php" method="post">
	<?php if ($_SESSION['login'] != '') { ?>
		<input class='comment' type='text' value='' name='com' maxlength="30" onclick="javascript:this.value=''">
		<input type='submit' value='Post' name=''>
		<input class='' type='hidden' value='<?=$row['img']?>' name='img'/>
		<?php } ?>
</form>
</div>
<form class='like' action='miaou.php' method="post">
	<?php if ($_SESSION['login'] != '') { 
		$stmt = $db->prepare('SELECT id_image FROM miaou WHERE login = :login AND id_image = :id_image;');
		$stmt->bindParam(':login', $_SESSION['login'], PDO::PARAM_STR);
		$stmt->bindParam(':id_image', $row['img'], PDO::PARAM_STR);
		$stmt->execute();
		$res = $stmt->fetchcolumn();
		if ($res) {
	?>
	<input id='miaou_act' type="image" src='ressources/chat.png' width='25' height='25'>
	<input class='' type='hidden' value='<?=$row['img']?>' name='miaouimg'/>
	<?php } else { 
	?>
	<input id='miaou' type="image" src='ressources/chat.png' width='25' height='25'>
	<input class='' type='hidden' value='<?=$row['img']?>' name='miaouimg'/>
	<?php } }?>
</form>
</div>
</div>
<?php
}
?>
</ul>


</body>
</html>

<?php 

include_once('footer.php');

?>