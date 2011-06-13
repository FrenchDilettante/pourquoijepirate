<?
require_once '../model/db.php';

$id = $_GET["id"];

try {
	$db = new PDO("mysql:host=localhost;dbname=pqjep", $db_username, $db_password);

	$c = array();
	
	$query = "SELECT id, vote_p, vote_m, fortune "
			."FROM fortune "
			."WHERE id = :id ";
	$stmt = $db->prepare($query);
	$stmt->bindParam(":id", $id);
	$stmt->execute();
	while ($row = $stmt->fetch()) {
		$c["id"] = $row["id"];
		$c["fortune"] = $row["fortune"];
		$c["vote_p"] = $row["vote_p"] == null ? 0 : $row["vote_p"];
		$c["vote_m"] = $row["vote_m"] == null ? 0 : $row["vote_m"];
	}
	
	include "../../fragments/fortune.php";
} catch (PDOException $e) {
	die("Erreur de base de données. D'oh.");
}
?>
