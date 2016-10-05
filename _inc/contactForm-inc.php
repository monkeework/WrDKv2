<?php

function maxDoc_contactForm_inc(){
/**
 * Based on contact.php, myMail.php is a model for creating contact pages
 *
 * UPDATED 2/2/2013 - This version includes an important fix having to do with servers blocking sent mail
 * with the user's email being placed into the "from" field via PHP's mail() function.
 *
 * Servers such as Dreamhost have a policy of blocking any emails with a "from" field that is not associated
 * with the current domain.  This version alleviates this issue by creating a "from" field derived from the original
 * domain name (no-reply@examplecom, for example) and uses the Reply-To header field to allow our client to click
 * Reply To and be able to email back to the person who filled out the form.
 *
 * contact.php is a postback application designed to provide a
 * contact form for users to email our clients.  contact.php references
 * recaptchalib.php as an include file which provides all the web service plumbing
 * to connect and serve up the CAPTCHA image and verify we have a human entering data.
 *
 * Only the form elements 'Email' and 'Name' are significant.  Any other form
 * elements added, with any name or type (radio, checkbox, select, etc.) will be delivered via
 * email with user entered data.  Form elements named with underscores like: "How_We_Heard"
 * will be replaced with spaces to allow for a better formatted email:
 *
 * <code>
 * How We Heard: Internet
 * </code>
 *
 * If checkboxes are used, place "[]" at the end of each checkbox name, or PHP will not deliver
 * multiple items, only the last item checked:
 *
 * <code>
 * <input type="checkbox" name="Interested_In[]" value="New Website" /> New Website <br />
 * <input type="checkbox" name="Interested_In[]" value="Website Redesign" /> Website Redesign <br />
 * <input type="checkbox" name="Interested_In[]" value="Lollipops" /> Complimentary Lollipops <br />
 * </code>
 *
 * The CAPTCHA is handled by reCAPTCHA requiring an API key for each separate domain.
 * Get your reCAPTCHA private/public keys from: http://recaptcha.net/api/getkey
 *
 * Place your target email in the $toAddress variable.  Place a default 'noreply' email address
 * for your domain in the $fromAddress variable.
 *
 * After testing, change the variable $sendEmail to TRUE to send email.
 *
 * Tech Stuff: To retain data entered during an incorrect CAPTCHA, POST data is embedded in JS array via a
 * PHP function sendPOSTtoJS().  On page load a JS function named loadElements() matches the
 * embedded JS array to the form elements on the page, and reloads all user data into the
 * form elements.
 *
 *
 * @package ma-v1605-22
 * @author monkeework <monkeework@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.monkeework.com/
 * @license http://www.apche.org/licenses/LICENSE-2.0
 * @see util.js
 * @see recaptchalib.php
 * @todo none
 */

# '../' works for a sub-folder.  use './' for the root

}


# The config property named 'loadHead' places JS, CSS, etc. inside the <head> tag - only use double quotes, or escape them!
$config->loadhead = '
<script type="text/javascript" src="' . VIRTUAL_PATH . '_js/util.js"></script>
<!-- Edit Required Form Elements via JavaScript Here -->
<script type="text/javascript">
	//here we make sure the user has entered valid data
	function checkForm(thisForm)
	{//check form data for valid info
		if(empty(thisForm.Name,"Please Enter Your Name")){return false;}
		if(!isEmail(thisForm.Email,"Please enter a valid Email Address")){return false;}
		return true;//if all is passed, submit!
	}
</script>

<!-- CSS class for required field elements.  Move to your CSS? (or not) -->
<style type="text/css">.required {font-style:italic;color:#FF0000;font-weight:bold;}</style>

<script type="text/javascript">
		 var RecaptchaOptions = {
				theme : "clean"
		 };
	 </script>
'; #load page specific JS

#--------------END CONFIG AREA ------------------------#


?>



<form action="<?php echo THIS_PAGE; ?>" method="post" onsubmit="return checkForm(this);">

	sample inclusion text


<?php
}

?>
