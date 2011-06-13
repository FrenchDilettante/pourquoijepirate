<?
require_once "../model/db.php";

$plage = isset($_COOKIE["top-plage"]) ? $_COOKIE["top-plage"] : "24h";
$plage = isset($_GET["from"]) ? $_GET["from"] : $plage;
setcookie("top-plage", $plage);

try {
	$db = new PDO("mysql:host=localhost;dbname=pqjep", $db_username, $db_password);
	
	$where_clause = "";
	
	switch ($plage) {
		case "3j":
			$where_clause = "WHERE date_ajout >= DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 3 DAY) ";
			break;
		case "1s":
			$where_clause = "WHERE date_ajout >= DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 1 WEEK) ";
			break;
		case "all":
			$where_clause = "";
			break;
			
		default:
			$where_clause = "WHERE date_ajout >= DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 1 DAY) ";
			break;
	}
	
	$count = 0;
	foreach ($db->query("SELECT COUNT(DISTINCT f.id) nb FROM fortune f LEFT OUTER JOIN vote v ON f.id = v.id_fortune $where_clause") as $row) {
		$count = round($row["nb"] / 10, 0);
	}

	$p = isset($_GET['p']) ? mysql_escape_string($_GET['p']) : 0;
	$p *= 10;
	if ($p < 0) {
		$p = 0;
	}
	
	$confessions = array();
	$query = "SELECT f.id id, f.vote_p, f.vote_m, fortune "
			."FROM fortune f "
			.$where_clause
			."ORDER BY vote_p DESC, date_ajout DESC "
			."LIMIT $p, 10";

	foreach ($db->query($query) as $row) {
		$conf = array();
		$conf['id'] = $row["id"];
		$conf['fortune'] = $row["fortune"];
		$conf["vote_p"] = $row["vote_p"] == null ? 0 : $row["vote_p"];
		$conf["vote_m"] = $row["vote_m"] == null ? 0 : $row["vote_m"];
		array_push($confessions, $conf);
	}
} catch (PDOException $e) {
	die("Erreur de base de données. D'oh.");
}
