<div style="float: right; margin: 5px">
	<a class="FlattrButton" style="display:none;" rev="flattr;button:compact;" href="http://pourquoijepirate.fr/"></a>
	<noscript><a href="http://flattr.com/thing/295070/Pourquoi-je-pirate" target="_blank">
	<img src="http://api.flattr.com/button/flattr-badge-large.png" alt="Flattr this" title="Flattr this" border="0" /></a></noscript>
<br />
	<a href="http://twitter.com/pqjepirate" class="twitter-follow-button" data-button="grey" data-text-color="#FFFFFF" data-link-color="#00AEFF" data-lang="fr">Follow @pqjepirate</a>
	<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
</div>
<h1>Parce qu'on n'est pas des voleurs !</h1>
	<div id="select_menu" style="float: right">
	<? if (isset($_SESSION["selection"])) {
		$selection = $_SESSION["selection"];
		if (count($selection["liste"]) > 0) {?>
			<a href="selection.php">&#9733;<? echo count($selection["liste"]) ?></a>
		<? }?>
	<? } ?>
	</div>
<ul>
	<li><a href="/">Parole de pirate</a></li>
	<li><a href="avouer.php">Confesser un acte de piraterie</a></li>
	<li><a href="liste.php">Dernières confessions</a></li>
	<li><a href="top.php">Top Pirate !</a></li>
</ul>
