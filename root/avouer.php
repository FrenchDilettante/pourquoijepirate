<?
session_start();
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
				<h1>J'avoue, je suis un pirate...</h1>
				<strong>... mais j'ai mes raisons !</strong>
				<form action="post.php" method="post">
					<textarea name="fortune" cols="50" rows="10" onkeyup="update()"><? $_POST['fortune'] ?></textarea>
					<br />
					<small><em>Attention, 500 caractères max. <span id="carmax"></span></em></small>
					<br />
					<input type="submit" />
					<p><strong>Important !</strong> Consultez la <a href="http://manudwarf.wordpress.com/2011/06/02/pourquoi-je-pirate-faq/">FAQ</a>.
				</form>
			</div>
			
			<div id="footer">
				<? include "fragments/footer.php" ?>
			</div>
		</div>
	</body>
</html>
