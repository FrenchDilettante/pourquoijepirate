<?
require_once "../model/db.php";

try {
	$db = new PDO("mysql:host=localhost;dbname=pqjep", $db_username, $db_password);
	
	foreach ($db->query("SELECT COUNT(*) nb FROM fortune") as $row) {
		$count = round($row["nb"] / 10, 0);
	}

	$p = isset($_GET['p']) ? mysql_escape_string($_GET['p']) : 0;
	$p -= isset($_GET['offset']) ? mysql_escape_string($_GET['offset']) : 0;
	$p *= 10;
	if ($p < 0) {
		$p = 0;
	}
	
	$confessions = array();
	$query = "SELECT id, vote_p, vote_m, fortune "
			."FROM fortune "
			."ORDER BY date_ajout DESC "
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
