<?php

	function do_contact_form()
	{
		$fields = array('name','email','subject','message');
		$limits = array('name' => 50, 'email' => 100, 'subject' => 100, 'message' => 5000);
		$required = array('name','email','message');
		$err_string = '';
		$form_state = 0; // 0 => No Errors, 1 => Missing Fields, 2 => Data Checks Failed, 3 => Sending Failed, 4 => Message Sent

		// if they're submitting the form, ensure they've completed the required fields properly
		if(isset($_POST['submit']))
		{
			foreach($_POST as $key=>$val)
			{
				if(in_array($key, $required) && empty($val))
				{
					$form_state = 1;
					$err_string .= '<li>'.$key.'</li>'."\n";
				}
			}

			// check if we can try sending the message
			if($form_state == 0)
			{
				// ensure none of the fields exceed our limits
				foreach($fields as $field)
				{
					if(strlen($_POST[$field]) > $limits[$field])
					{
						$form_state = 2;
						$err_string .= '<li>'.$field.': Value too large ('.$field.' cannot be longer than '.$limits[$field].' characters)</li>'."\n";
					}
				}

				// ensure the email address is valid
				if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $_POST['email']))
				{
					$form_state = 2;
					$err_string .= '<li>email: Invalid email address (should be something like user@host.com)</li>'."\n";
				}

				// ensure we didn't come across any validation errors
				if($form_state == 0)
				{
					$fromName = $_POST['name'];
					$fromEmail =  $_POST['email'];

					$toName = "Dane Bertram";
					$toEmail = "dbertram@gmail.com";

					$subject = 'BertraWebform: '.stripslashes($_POST['subject']);
					$message = nl2br(stripslashes($_POST['message']));

					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
					$headers .= "From: ".$fromName." <".$fromEmail.">\r\n";
					$headers .= "To: ".$toName." <".$toEmail.">\r\n";
					$headers .= "Reply-To: ".$fromName." <".$fromEmail.">\r\n";
					$headers .= "X-Priority: 1\r\n";
					$headers .= "X-MSMail-Priority: High\r\n";
					$headers .= "X-Mailer: Bertraweb Mailer";

					if(mail($toEmail, $subject, $message, $headers))
						$form_state = 4; // indicate success
					else
						$form_state = 3; // indicate failure
				}
			}
		}
		else // otherwise this is the first time we're displaying the form, so initialize the form's contents
		{
			foreach($fields as $field)
			{
				if(!isset($_POST[$field])) $_POST[$field] = '';
			}
		}

		echo "<div id=\"contactForm\">\n";

		// check if there's a message to display to the user
		switch($form_state)
		{
			case 0: // No errors
				break;
			case 1: // Missing Fields
				echo "			<p class=\"warning\"><strong>Your email was not sent!</strong></p>\n<p>The following fields are required:\n<ul>\n".$err_string."</ul>\n</p>\n";
				break;
			case 2: // Data Checks Failed
				echo "			<p class=\"warning\"><strong>Your email was not sent!</strong></p><p>Some of the information you submitted could not be accepted:\n<ul>\n".$err_string."</ul>\n</p>\n";
				break;
			case 3: // Sending Failed
				echo "			<p class=\"warning\"><strong>An error occurred while attempting to send your email.  Sorry!</strong></p>\n";
				if(!empty($err_string))
				{
					echo "			<p class=\"warning\">The following error message was provided: ".$err_string."</p>";
				}
				break;
			case 4: // Message Sent
				echo "			<p class=\"warning\"><strong>Your email was successfully sent!</p><p class=\"warning\">Thank you, ".htmlspecialchars($_POST['name'])."!</strong></p>\n";
				break;
			default:
				echo "			<p class=\"warning\"><strong>An unexpected error was encountered!</strong></p>\n";
				if(!empty($err_string))
				{
					echo "			<p class=\"warning\">The following error message was provided: ".$err_string."</p>";
				}
				break;
		}

		// now output the form's HTML if we haven't come across a reason not to
		if($form_state < 3)
		{
			echo '			<form action="'.htmlspecialchars($_SERVER['PHP_SELF']).'" method="post">'."\n";
			echo '				<label for="name">Name:</label>'."\n";
			echo '				<input name="name" type="text" id="name" value="'.htmlspecialchars($_POST['name']).'" size="60" maxlength="'.$limits['name'].'" />'."\n\n";
			echo '				<label for="email">Email:</label>'."\n";
			echo '				<input name="email" type="text" id="email" value="'.htmlspecialchars($_POST['email']).'" size="60" maxlength="'.$limits['email'].'" />'."\n\n";
			echo '				<label for="subject">Subject:</label>'."\n";
			echo '				<input name="subject" type="text" id="subject" value="'.htmlspecialchars($_POST['subject']).'" size="60" maxlength="'.$limits['subject'].'" />'."\n\n";
			echo '				<label for="message">Message:</label>'."\n";
			echo '				<textarea name="message" id="message" cols="60" rows="6">'.htmlspecialchars($_POST['message']).'</textarea>'."\n\n";
			echo '				<label for="submit">&nbsp;</label>'."\n\n";
			echo '				<p>'."\n";
			echo '					<input name="submit" type="submit" value="Send Email" id="submit" />'."\n";
			//echo '					<script type="text/javascript">'."\n";
			//echo '					<!--'."\n";
			//echo '					// only display the "Clear Form" button if javascript is supported (clear method makes use of a javascript function)'."\n";
			//echo '					document.write(\'<input name="clear" type="button" value="Clear Form" id="clear" />\');'."\n";
			//echo '					//-->'."\n";
			//echo '					</script>'."\n";
			echo '				</p>'."\n";
			echo '			</form>'."\n";
		}

		echo "		</div>\n";

	}
?>