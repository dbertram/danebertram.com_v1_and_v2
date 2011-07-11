<?php

	$_pageTitle = 'db.email';
	$_includeDTree = false;
	$_selectedLink = 4;
	include_once('_header.php');

?>
		<div class="welcomeMsg">
			<p>Hey! Are you looking for my email address? Due to the plague that is
				 anonymous spam, I'm afraid I don't display it on my website directly. Sorry!</p>
			<p>If you'd like to get in touch though, please feel free to use the form below.
				 Or, if you <i>really</i> need to contact me directly, my email address
				 is: &lt;the first initial of my first name&gt;&lt;my full last name&gt;@gmail.com.</p>
			<div id="sig">db</div>
		</div>
		<?php
			include_once('_contactForm.php');
			do_contact_form();
		?>
<?php include_once('_footer.php') ?>
