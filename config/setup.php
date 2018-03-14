<?php

include_once('database.php');
if (isset($_SESSION['id']))
    unset($_SESSION);
try {
    $db = new PDO($DB_DSN_LIGHT, $DB_USER, $DB_PSSWD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE `".$DB_NAME."`";
    $db->exec($sql);
    echo "DB Camagru successfuly created\n";
} catch (PDOException $e) {
    echo $e->getMessage();
    exit(-1);
};
$db->exec("use Camagru");
    $db->exec("CREATE TABLE IF NOT EXISTS users (id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) NOT NULL,
        login VARCHAR(255) NOT NULL,
        passwd VARCHAR(255) NOT NULL,
        hash VARCHAR(255) NOT NULL,
        admin INT(9) DEFAULT 0,
        mail_com INT(9) DEFAULT 1,
        active INT(9) DEFAULT 0)");
    echo "Table 'users' created successfully.\n";
    $db->exec("CREATE TABLE IF NOT EXISTS gallery (id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        login VARCHAR(255) NOT NULL,
        img VARCHAR(255) NOT NULL)");
    echo "Table 'gallery' created successfully.\n";
    $db->exec("CREATE TABLE IF NOT EXISTS masks (id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        img VARCHAR(255) NOT NULL)");
    echo "Table 'masks' created successfully.\n";
	$db->exec("INSERT INTO masks (img) VALUES ('1.jpg')");
	$db->exec("INSERT INTO masks (img) VALUES ('2.jpg')");
	$db->exec("INSERT INTO masks (img) VALUES ('3.jpg')");
	$db->exec("INSERT INTO masks (img) VALUES ('4.jpg')");
    $db->exec("CREATE TABLE IF NOT EXISTS comments (id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        login VARCHAR(255) NOT NULL,
        id_image VARCHAR(255) NOT NULL,
        comment VARCHAR(255) NOT NULL)");
    echo "Table 'comments' created successfully.\n";
    $db->exec("CREATE TABLE IF NOT EXISTS miaou (id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        login VARCHAR(255) NOT NULL,
        id_image VARCHAR(255) NOT NULL)");
    echo "Table 'miaou' created successfully.\n";
    $mail = 'rive.decaillot.a@gmail.com';
    $name = 'alix';
    $pass = hash('whirlpool', 'alix');
    $hash = hash('whirlpool', rand(15000, 200000));
    $one = 1;
    $zero = 0;
    $stmt = $db->prepare('INSERT INTO users (email, login, passwd, hash, admin, active) VALUES (:email, :login, :passwd, :hash, :admin, :active)');
    $stmt->bindParam(':email', $mail, PDO::PARAM_STR);
    $stmt->bindParam(':login', $name, PDO::PARAM_STR);
    $stmt->bindParam(':passwd', $pass, PDO::PARAM_STR);
    $stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
    $stmt->bindParam(':admin', $one, PDO::PARAM_STR);
    $stmt->bindParam(':active', $one, PDO::PARAM_STR);
    $stmt->execute();
    $mail = 'cedr_8@hotmail.com';
    $name = 'cbarbier';
    $pass = hash('whirlpool', 'cbarbier');
    $hash = hash('whirlpool', rand(15000, 200000));
    $stmt = $db->prepare('INSERT INTO users (email, login, passwd, hash, admin, active) VALUES (:email, :login, :passwd, :hash, :admin, :active)');
    $stmt->bindParam(':email', $mail, PDO::PARAM_STR);
    $stmt->bindParam(':login', $name, PDO::PARAM_STR);
    $stmt->bindParam(':passwd', $pass, PDO::PARAM_STR);
    $stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
    $stmt->bindParam(':admin', $one, PDO::PARAM_STR);
    $stmt->bindParam(':active', $one, PDO::PARAM_STR);
    $stmt->execute();
?>
