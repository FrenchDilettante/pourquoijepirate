<?
require_once "../model/db.php";

$selection = isset($_SESSION["selection"]) ? $_SESSION["selection"] : array("nom" => "", "liste" => array());

try {
	$db = new PDO("mysql:host=localhost;dbname=pqjep", $db_username, $db_password);
	
	$confessions = array();
	$query = "SELECT f.id id, SUM(vote_p) vote_p, SUM(vote_m) vote_m, fortune "
			."FROM fortune f "
			."LEFT OUTER JOIN vote v ON v.id_fortune = f.id "
			."WHERE f.id = :id "
			."GROUP BY f.id ";
	
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
