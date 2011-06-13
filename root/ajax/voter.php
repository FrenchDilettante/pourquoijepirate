<?
require_once '../../model/db.php';

$id_fortune = $_POST["id"];
$vote_p = $_POST["vote"] == 1;
$vote_m = $_POST["vote"] == -1;
$ip_from = $_SERVER["REMOTE_ADDR"];

try {
	$db = new PDO("mysql:host=localhost;dbname=pqjep", $db_username, $db_password);
	
	$check = $db->prepare("SELECT * "
						 ."FROM vote "
						 ."WHERE id_fortune = :id_fortune "
						 ."  AND ip_from = :ip_from"
						 ."  AND HOUR(date_vote) + 1 > HOUR(CURRENT_TIMESTAMP)");
	$check->bindParam(":id_fortune", $id_fortune);
	$check->bindParam(":ip_from", $ip_from);
	$check->execute();
	if ($row = $check->fetch()) {
		$stmt = $db->prepare("SELECT SUM(vote_p) vote_p, SUM(vote_m) vote_m "
							."FROM vote "
							."WHERE id_fortune = :id_fortune");
		$stmt->bindParam(":id_fortune", $id_fortune);
		$stmt->execute();
		$row = $stmt->fetch(); ?>
<em>Vous avez déjà voté</em> +<? echo $row["vote_p"] ?>/-<? echo $row["vote_m"] ?>
<?		return;
	}

	$stmt = $db->prepare("INSERT INTO vote (id_fortune, vote_p, vote_m, ip_from) "
						."VALUES (:id_fortune, :vote_p, :vote_m, :ip_from)");
	$stmt->bindParam(":id_fortune", $id_fortune);
	$stmt->bindParam(":vote_p", $vote_p);
	$stmt->bindParam(":vote_m", $vote_m);
	$stmt->bindParam(":ip_from", $ip_from);
	$stmt->execute();
	
	$stmt = $db->prepare("SELECT SUM(vote_p) vote_p, SUM(vote_m) vote_m "
						."FROM vote "
						."WHERE id_fortune = :id_fortune");
	$stmt->bindParam(":id_fortune", $id_fortune);
	$stmt->execute();
	$row = $stmt->fetch();
	
	?>Merci ! +<? echo $row["vote_p"] ?>/-<? echo $row["vote_m"] ?><?
} catch (PDOException $e) {
	die("Erreur de base de données. D'oh.");
}
