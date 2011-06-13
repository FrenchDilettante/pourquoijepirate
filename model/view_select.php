<?
require_once "../model/db.php";

if (!isset($_GET["ids"])) {
	header("Location: liste.php");
}
$ids = $_GET["ids"];

try {
	$db = new PDO("mysql:host=localhost;dbname=pqjep", $db_username, $db_password);
	
	$selection = array("nom" => "", "liste" => array());
	
	$query = "SELECT nom "
			."FROM selection "
			."WHERE id = :id";
	$stmt = $db->prepare($query);
	$stmt->bindParam(":id", $ids);
	$stmt->execute();
	if ($row = $stmt->fetch()) {
		$selection["nom"] = $row["nom"];
	}
	
	$query = "SELECT f.id id, vote_p, vote_m, fortune "
			."FROM fortune f "
			."INNER JOIN fortune_selection fs ON f.id = fs.id_fortune "
			."WHERE fs.id_selection = :ids "
			."ORDER BY date_ajout DESC ";
	$stmt = $db->prepare($query);
	$stmt->bindParam(":ids", $ids);
	$stmt->execute();
	$liste = array();
	while($row = $stmt->fetch()) {
		$conf = array();
		$conf['id'] = $row["id"];
		$conf['fortune'] = $row["fortune"];
		$conf["vote_p"] = $row["vote_p"] == null ? 0 : $row["vote_p"];
		$conf["vote_m"] = $row["vote_m"] == null ? 0 : $row["vote_m"];
		array_push($liste, $conf);
	}
	
	$selection["liste"] = $liste;
} catch (PDOException $e) {
	die("Erreur de base de données. D'oh.");
}
