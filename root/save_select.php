<?
require_once '../model/db.php';

session_start();
$selection = isset($_SESSION["selection"]) ? $_SESSION["selection"] : array("nom" => "", "liste" => array());
print_r($_SESSION);
if (count($selection["liste"]) == 0) {
	header("Location: /");
	return;
}

$nom = $_POST["nom"];
$ip_from = $_SERVER['REMOTE_ADDR'];

if (strlen($nom) == 0) {
	header('Location: selection.php');
	return;
}

try {
	$db = new PDO("mysql:host=localhost;dbname=pqjep", $db_username, $db_password);

	$stmt = $db->prepare("INSERT INTO selection (nom, ip_from, password) VALUES (:nom, :ip_from, '')");
	$stmt->bindParam(":nom", $nom);
	$stmt->bindParam(":ip_from", $ip_from);
	$stmt->execute();
	
	$ids = $db->lastInsertId();
	
	$stmt = $db->prepare("INSERT INTO fortune_selection VALUES (:idf, :ids)");
	foreach ($selection["liste"] as $idf) {
		$stmt->bindParam(":idf", $idf);
		$stmt->bindParam(":ids", $ids);
		$stmt->execute();
	}
	
	$selection["nom"] = $nom;
	$selection["id"] = $ids;
	unset($_SESSION["selection"]);
	
	header("Location: view_select.php?ids=$ids");
} catch (PDOException $e) {
	die("Erreur de base de données. D'oh.");
}
