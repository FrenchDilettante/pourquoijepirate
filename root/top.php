<?
session_start();
include "../model/top.php";
$page_url = "top.php";
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
				<div class="top-plages">
					<ul>
						<li><a href="top.php?from=24h">24h</a></li>
						<li><a href="top.php?from=3j">3j</a></li>
						<li><a href="top.php?from=1s">1s</a></li>
					</ul>
				</div>
				
				<a id="aveu" style="margin: 0" href="avouer.php">Dis-nous pourquoi tu pirates !</a>
				
				<div class="main">
					<h1>Les plus pires fourbonneries (quelque part entre fourbe et forban)</h1>
					<? include "fragments/pages.php" ?>
					
					<? foreach ($confessions as $c) { ?>
						<? include "../fragments/fortune.php" ?>
					<? } ?>
					
					<? include "fragments/pages.php" ?>
				</div>
			</div>
			
			<div id="footer">
				<? include "fragments/footer.php" ?>
			</div>
		</div>
	</body>
</html>
