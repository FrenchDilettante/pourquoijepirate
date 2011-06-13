<?
require_once '../../model/db.php';

session_start();

$action = $_GET["action"];
$id = $_GET["id"];

try {
	$selection = isset($_SESSION["selection"]) ? $_SESSION["selection"] : array("nom" => "", "liste" => array());
	
	if ($action == "add") {
		foreach ($selection["liste"] as $s) {
			if ($s == $id) {
				?><a href="selection.php">&#9733;<? echo count($selection["liste"]) ?></a><?
				return;
			}
		}

		$db = new PDO("mysql:host=localhost;dbname=pqjep", $db_username, $db_password);
	
		$query = "SELECT id, fortune "
				."FROM fortune "
				."WHERE id = :id";
		
		$stmt = $db->prepare($query);
		$stmt->bindParam(":id", $id);
		$stmt->execute();
		
		while ($row = $stmt->fetch()) {
			array_push($selection["liste"], $id);
		}
	} else if ($action == "rem") {
		foreach ($selection["liste"] as $i => $s) {
			if ($s == $id) {
				unset($selection["liste"][$i]);
			}
		}
	}

	if (count($selection["liste"]) > 0) {
		$_SESSION["selection"] = $selection;
		?><a href="selection.php">&#9733;<? echo count($selection["liste"]) ?></a><?
	} else {
		unset($_SESSION["selection"]);
	}
} catch (PDOException $e) {
	die("Erreur de base de données. D'oh.");
}

