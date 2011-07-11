<?php
	// retreive the start time of our script
	$mtime = microtime();
	$mtime = explode(" ",$mtime);
	$mtime = $mtime[1] + $mtime[0];
	$starttime = $mtime;

	if($_pageTitle == 'db.admin') session_start();
	if(!headers_sent())	header("Content-type: text/html; charset=utf-8");

	include_once('_login.php');

	if($_GET['logout'] == '1')
	{
		logout();
		header("Location: ".$_SERVER['PHP_SELF']);
		exit();
	}

	if ($_GET["repost"] == "1") {
		header("Location: ".$_SERVER['PHP_SELF']);
		exit();
	}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<title><?php echo $_pageTitle ?> {danebertram.com}</title>

	<meta name="description" content="Learn a little more about me: my life, my work, my website." />
	<meta name="keywords" content="Dane Bertram, ContactAlbum, URLinker, switzerland, abb, dabsoft" />
	<meta name="verify-v1" content="NyJ5YHoNGy71FQT7cPYwwh25CI+HUHC6zCym7WXr6cw=" ></meta>

	<!--
		Copyright (c) 2004-<?php echo date("Y") ?> Dane Bertram; All rights reserved.

		NiceTitles (nicetitles.js and some related CSS as well) are
		originally from kryogenix.org/code/browser/nicetitle; however,
		I have added a few minor alterations to deal with a small bug.
	-->
	<script type="text/javascript" src="nicetitles.js"></script>

	<style type="text/css">
		@import url(<?php echo isset($_pageStyle) && $_pageStyle != '' ? $_pageStyle : 'v2' ?>.css);
<?php
	include_once('_randomHeader.php');
?>
	</style>

	<!--[if gte IE 5]>
	<style type="text/css">
		div.nicetitle { filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/ntbg.png', sizingMethod='scale'); }
		#pageHeader li { filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=75); }
	</style>
	<![endif]-->
<?php if(isset($_includeDTree) && $_includeDTree)
{?>

	<!-- [START] URLinker -->
	<link rel="StyleSheet" href="urlinker.css" type="text/css" />
	<link rel="StyleSheet" href="dtree.css" type="text/css" />
	<script type="text/javascript" src="dtree.js"></script>
	<!-- [END] URLinker -->
<?php }
	if(isset($_includeAdmin) && $_includeAdmin)
{?>

	<!-- [START] URLinkerAdmin -->
	<link rel="StyleSheet" href="urlinker.css" type="text/css" />
	<script type="text/javascript" src="_urlinkerAdmin.js"></script>
	<!-- [END] URLinker -->
<?php } ?>
</head>
<body>
<div id="pageBody">
	<div id="pageHeader">
		<ul>
			<li class="<?php if($_selectedLink == 8) echo 'selected'; else echo 'seventh'; ?>"><a href="admin.php" title="[ website admin *snore* ]">admin</a></li>
			<!--<li class="<?php if($_selectedLink == 7) echo 'selected'; else echo 'seventh'; ?>"><a href="/contactalbum/" title="[ my private (and horribly out-of-date) contact book ]" target="_blank">contacts</a></li>-->
			<li class="<?php if($_selectedLink == 6) echo 'selected'; else echo 'sixth'; ?>"><a href="calendar.php" title="[ see what i'm up to ]">calendar</a></li>
			<li class="<?php if($_selectedLink == 5) echo 'selected'; else echo 'fifth'; ?>"><a href="gallery.php" title="[ see what my camera's been pointed at ]">pictures</a></li>
			<li class="<?php if($_selectedLink == 4) echo 'selected'; else echo 'fourth'; ?>"><a href="contact.php" title="[ say hi :) ]">email</a></li>
			<li class="<?php if($_selectedLink == 3) echo 'selected'; else echo 'third'; ?>"><a href="resume.php" title="[ what i claim to bring to the table ]">r&eacute;sum&eacute;</a></li>
			<li class="<?php if($_selectedLink == 2) echo 'selected'; else echo 'second'; ?>"><a href="portfolio.php" title="[ my projects &amp; products ]">portfolio</a></li>
			<li class="<?php if($_selectedLink == 1) echo 'selected'; else echo 'first'; ?>"><a href="/" title="[ there's no place like it ]">home</a></li>
		</ul>
	</div>
	<div id="pageContent">
