<?
session_start();
include "../model/top.php";
?><!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Pourquoi je pirate ?</title>
		
		<? include "../fragments/includes.php"; ?>
	</head>
	<body>
		<!--[if lt IE 8]> <div style=' clear: both; height: 59px; padding:0 0 0 15px; position: relative;'> <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode"><img src="http://www.theie6countdown.com/images/banners/warning_bar_0024_french.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." /></a></div> <![endif]-->
		<div id="container">
			<div id="header">
				<? include "fragments/header.php"; ?>
			</div>
			
			<div id="content">
				<a id="aveu" href="avouer.php">Dis-nous pourquoi tu pirates !</a>
				
				<div class="main">
					<h1>Les plus pires fourbonneries (quelque part entre fourbe et forban)</h1>
					<ul class="pagination">
					<? for ($i=0; $i<$count; $i++) { ?>
						<li>
						<? if ($i == ($p / 10)) { ?>
							<? echo $i + 1; ?>
						<? } else { ?>
							<a href="top.php?p=<? echo $i ?>"><? echo $i + 1; ?></a>
						<? } ?>
						</li>
					<? } ?>
					</ul>
					
					<? foreach ($confessions as $c) { ?>
						<? include "../fragments/fortune.php" ?>
					<? } ?>
					
					<ul class="pagination">
					<? for ($i=0; $i<$count; $i++) { ?>
						<li>
						<? if ($i == ($p / 10)) { ?>
							<? echo $i + 1; ?>
						<? } else { ?>
							<a href="top.php?p=<? echo $i ?>"><? echo $i + 1; ?></a>
						<? } ?>
						</li>
					<? } ?>
					</ul>
				</div>
			</div>
			
			<div id="footer">
				<? include "fragments/footer.php" ?>
			</div>
		</div>
	</body>
</html>
