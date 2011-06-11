<?
require_once "../model/db.php";

try {
	$db = new PDO("mysql:host=localhost;dbname=pqjep", $db_username, $db_password);

	$c = array();
	
	if (isset($_GET['id'])) {
		$stmt = $db->prepare("SELECT f.id id, SUM(vote_p) vote_p, SUM(vote_m) vote_m, fortune "
							."FROM fortune f "
							."LEFT OUTER JOIN vote v ON v.id_fortune = f.id "
							."WHERE f.id = :id "
							."GROUP BY f.id ");
		$stmt->bindParam(":id", $_GET["id"]);
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$c["id"] = $row["id"];
			$c["fortune"] = $row["fortune"];
			$c["vote_p"] = $row["vote_p"] == null ? 0 : $row["vote_p"];
			$c["vote_m"] = $row["vote_m"] == null ? 0 : $row["vote_m"];
		}
	} else {
		$query = "SELECT f.id id, SUM(vote_p) vote_p, SUM(vote_m) vote_m, fortune "
				."FROM fortune f "
				."LEFT OUTER JOIN vote v ON v.id_fortune = f.id "
				."GROUP BY f.id "
				."ORDER BY RAND() "
				."LIMIT 1";
		foreach ($db->query($query) as $row) {
			$c["id"] = $row["id"];
			$c["fortune"] = $row["fortune"];
			$c["vote_p"] = $row["vote_p"] == null ? 0 : $row["vote_p"];
			$c["vote_m"] = $row["vote_m"] == null ? 0 : $row["vote_m"];
		}
	}
} catch (PDOException $e) {
	die("Erreur de base de données. D'oh.");
}
