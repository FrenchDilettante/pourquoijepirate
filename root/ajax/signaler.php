<?
require_once '../model/db.php';

$id_fortune = $_POST["id"];
$ip_from = $_SERVER["REMOTE_ADDR"];

try {
	$db = new PDO("mysql:host=localhost;dbname=pqjep", $db_username, $db_password);
	
	$check = $db->prepare("SELECT * "
						 ."FROM signalement "
						 ."WHERE id_fortune = :id_fortune "
						 ."  AND ip_from = :ip_from"
						 ."  AND HOUR(date_signalement) + 1 > HOUR(CURRENT_TIMESTAMP)");
	$check->bindParam(":id_fortune", $id_fortune);
	$check->bindParam(":ip_from", $ip_from);
	$check->execute();
	if ($row = $check->fetch()) {
		echo "KO";
		return;
	}

	$stmt = $db->prepare("INSERT INTO signalement (id_fortune, ip_from) VALUES (:id_fortune, :ip_from)");
	$stmt->bindParam(":id_fortune", $id_fortune);
	$stmt->bindParam(":ip_from", $ip_from);
	$stmt->execute();
	
	echo "OK";
} catch (PDOException $e) {
	die("Erreur de base de données. D'oh.");
}
