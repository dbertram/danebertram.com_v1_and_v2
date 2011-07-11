	</div>
	<div id="pageFooter">
		<div id="validators">
			<a href="http://validator.w3.org/check/referer"><img src="images/valid_xhtml.gif" alt="W3C Valid XHTML 1.1" /></a>
			<a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="images/valid_css.gif" alt="W3C Valid CSS 2" /></a>
		</div>
		<div id="copyright">&copy; 2004-<?php echo date("Y") ?> <a href="/">db</a></div>
<?php
	// determine the time it took to execute this script
	$mtime = microtime();
	$mtime = explode(" ",$mtime);
	$mtime = $mtime[1] + $mtime[0];
	$endtime = $mtime;
	$totaltime = ($endtime - $starttime);
	echo "		<div id=\"executeTime\"><a href=\"#\" onclick=\"return false;\">This page was created in ".$totaltime." seconds (in case you were wondering).</a></div>\n";

	if(logged_in())
	{
		echo "		<div id=\"logoutLink\"><a href=\"".$_SERVER['PHP_SELF']."?logout=1\">[ logout ]</a></div>\n";
	}
?>
	</div>
</div>
</body>
</html>
