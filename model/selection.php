<?
require_once "../model/db.php";

$selection = isset($_SESSION["selection"]) ? $_SESSION["selection"] : array("nom" => "", "liste" => array());

try {
	$db = new PDO("mysql:host=localhost;dbname=pqjep", $db_username, $db_password);
	
	$confessions = array();
	$query = "SELECT id, vote_p, vote_m, fortune "
			."FROM fortune "
			."WHERE id = :id ";
	
	$stmt = $db->prepare($query);
	
	foreach ($selection["liste"] as $s) {
		$stmt->bindParam(":id", $s);
		$stmt->execute();
		
		if ($row = $stmt->fetch()) {
			$conf = array();
			$conf['id'] = $row["id"];
			$conf['fortune'] = $row["fortune"];
			$conf["vote_p"] = $row["vote_p"] == null ? 0 : $row["vote_p"];
			$conf["vote_m"] = $row["vote_m"] == null ? 0 : $row["vote_m"];
			array_push($confessions, $conf);
		}
	}
	
	$count = round(count($confessions) / 10);
} catch (PDOException $e) {
	die("Erreur de base de données. D'oh.");
}
