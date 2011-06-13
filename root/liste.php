<?
session_start();
include "../model/liste.php";
$page_url = "liste.php";
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
					<h1>Les dernières confessions</h1>
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
