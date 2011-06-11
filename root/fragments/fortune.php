<div class="fortune" data-id="<? echo $c['id'] ?>" id="fortune-<? echo $c["id"] ?>">
	<span class="texte"><? echo $c['fortune'] ?></span>
	<div class="actions">
		<span class="votes">
			<a href="#fortune-<? echo $c["id"] ?>" onclick="voter(<? echo $c["id"] ?>, 1); return false;">+<? echo $c["vote_p"] ?></a>/
			<a href="#fortune-<? echo $c["id"] ?>" onclick="voter(<? echo $c["id"] ?>, -1); return false;">-<? echo $c["vote_m"] ?></a></span>
		<span class="signaler"><a href="#fortune-<? echo $c["id"] ?>" onclick="signaler(<? echo $c['id'] ?>); return false;">Signaler</a></span>
		<a href="index.php?id=<? echo $c['id'] ?>">Raison #<? echo $c['id'] ?></a>
	</div>
</div>
