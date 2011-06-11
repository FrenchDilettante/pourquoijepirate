<?
$selection = isset($_SESSION["selection"]) ? $_SESSION["selection"] : array("nom" => "", "liste" => array());
$select = false;
foreach ($selection["liste"] as $s) {
	$select = $s == $c["id"];
	if ($select) break;
}
?>

<div class="fortune" data-id="<? echo $c['id'] ?>" id="fortune-<? echo $c["id"] ?>">
	<span class="texte"><? echo $c['fortune'] ?></span>
	<div class="actions">
		<span class="select">
		<? if ($select) {?>
			&#9733;Sélectionné <a href="" onclick="deselect(<? echo $c["id"] ?>); return false;">(Retirer)</a>
		<? } else {?>
			<a href="" onclick="select(<? echo $c["id"] ?>); return false;">&#9734;Sélectionner</a>
		<? }?>
		</span>
		<span class="votes">
			<a href="" onclick="voter(<? echo $c["id"] ?>, 1); return false;">+<? echo $c["vote_p"] ?></a>/
			<a href="" onclick="voter(<? echo $c["id"] ?>, -1); return false;">-<? echo $c["vote_m"] ?></a>
		</span>
		<span class="signaler"><a href="" onclick="signaler(<? echo $c['id'] ?>); return false;">Signaler</a></span>
		<a href="index.php?id=<? echo $c['id'] ?>">Raison #<? echo $c['id'] ?></a>
	</div>
</div>
