<?
require_once "../model/db.php";

$plage = isset($_COOKIE["top-plage"]) ? $_COOKIE["top-plage"] : "24h";
$plage = isset($_GET["from"]) ? $_GET["from"] : $plage;
$_COOKIE["top-plage"] = $plage;

try {
	$db = new PDO("mysql:host=localhost;dbname=pqjep", $db_username, $db_password);
	
	$where_clause = "";
	
	switch ($plage) {
		case "3j":
			$where_clause = "WHERE date_vote >= DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 4 DAY) ";
			break;
		case "1s":
			$where_clause = "WHERE date_vote >= DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 1 WEEK) ";
			break;
		case "all":
			break;
			
		default:
			$where_clause = "WHERE date_vote >= DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 1 DAY) ";
			break;
	}
	
	$count = 0;
	foreach ($db->query("SELECT COUNT(*) nb FROM fortune $where_clause") as $row) {
		$count = round($row["nb"] / 10, 0);
	}

	$p = isset($_GET['p']) ? mysql_escape_string($_GET['p']) : 0;
	$p *= 10;
	if ($p < 0) {
		$p = 0;
	}
	
	$confessions = array();
	$query = "SELECT f.id id, SUM(vote_p) vote_p, SUM(vote_m) vote_m, fortune "
			."FROM fortune f "
			."LEFT OUTER JOIN vote v ON v.id_fortune = f.id "
			.$where_clause
			."GROUP BY f.id "
			."ORDER BY SUM(vote_p) DESC, date_ajout DESC "
			."LIMIT $p, 10";

	echo $query;
	
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
