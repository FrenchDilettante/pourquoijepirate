<?php
require_once '../model/db.php';

$fortune = strip_tags(substr(trim($_POST["fortune"]), 0, 500));
$ip_from = $_SERVER["REMOTE_ADDR"];

if (strlen($fortune) == 0) {
	include 'avouer.php';
	return;
}

try {
	$db = new PDO("mysql:host=localhost;dbname=pqjep", $db_username, $db_password);

	$stmt = $db->prepare("INSERT INTO fortune (fortune, ip_from) VALUES (:fortune, :ip_from)");
	$stmt->bindParam(":fortune", $fortune);
	$stmt->bindParam(":ip_from", $ip_from);
	$stmt->execute();
	
	header('Location: http://pourquoijepirate.fr');
} catch (PDOException $e) {
	die("Erreur de base de données. D'oh.");
}
