<?php
include('auth.php');
session_destroy();
$db = null;
header("Location: index.php");
?>
