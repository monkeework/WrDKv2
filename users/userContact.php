<?php


function maxDoc_users_userContact(){
/**
 * Based on contact.php, userConact.php is a model for creating contact pages
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

require '../_inc/config_inc.php'; //provides configuration, et al.

#declaried in users/validateUser.php
(int)$uID 		= $_SESSION['UserID']; #cast it as int
$uName 				= $_SESSION['UserName'];
$uEmail 			= $_SESSION['Email'];
(int)$uPriv 	= $_SESSION['Privilege'];
$uStart 			= $_SESSION['uStart']; #startpage

//set access priv needed for this page by member
chekPrivies(1); //known guest (1+)

//to switch theme from Yeti to testBoard
$config->theme = 'testBoard'; //default theme (header/footer combo) see 'Themes' folder for others and info
$config->style = 'testBoard.css'; //currently only Bootswatch Theme uses style to switch look & feel



//END CONFIG AREA ----------------------------------------------------------

$feedback = ""; //initialize feedback
if(isset($_GET['msg'])){
	switch($_GET['msg'])
	{
			case 1:
				 $feedback = "Your permissions don't allow access to that page.";
				 break;
		default:
				 $feedback = "";
	}
}

if($feedback != ""){$feedback = '<div align="center"><h4><font color="red">' . $feedback . '</font></h4></div>';} //Fill out feedback HTML

get_header('testBoard'); //defaults to theme header or header_inc.php

//BEGIN CONTENT AREA
?>

<div class="container-fluid">

<?php
	echo bootswatchFeedback();  //feedback on form operations - see bootswatch_functions.php
	echo getSidebar($uName, $uID, $uPriv);// see custom-inc.php to edit
?>

<div class="col-sm-9 col-md-10 main">
	<!--toggle sidebar button-->
	<p class="visible-xs">
		<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
	</p>


<!-- BEGIN CONTENT AREA here -->
<form action="<?php echo THIS_PAGE; ?>" method="post" onsubmit="return checkForm(this);">

<?php // IF Data is valid/good, lets forward it on...
if (isset($_POST["submit"])){#data is valid
	$name = $message = $email = $body = '';

/*
POST data:
	array (size=8)
	//'name' => string 'The Gardener' (length=12)
	//'email' => string 'developer@example.com' (length=21)
	//'message' => string '' (length=0)
	//'loa' => string 'y' (length=1)
	//'rDate' => string 'tomorrow' (length=8)
	//'charReq' => string ' ' (length=1)
	'charRes' => string '13' (length=2)
	//'submit' => string 'Send Message' (length=12)
Session data:
	array (size=8)
	//'feedback' => string '' (length=0)
	//'feedback-level' => string '' (length=0)
	//'admin-red' => string 'logout.php' (length=10)
	//'UserID' => int 1
	//'UserName' => string 'The Gardener' (length=12)
	//'Email' => string 'developer@example.com' (length=21)
	//'Privilege' => int 7
	//'uStart' => string 'dashboard.php' (length=13)

*/


	//get data
	$loa = $rDate = $ocfc = $charReq = $charRes = '';
	if(isset($_POST['loa'])){ $loa = $_POST['loa']; }
	if(isset($_POST['rDate'])){ $rDate = $_POST['rDate']; }

	if(isset($_POST['ocfc'])){ $ocfc = $_POST['ocfc']; }
	if(isset($_POST['charReq'])){ $charReq = $_POST['charReq']; }

	if(isset($_POST['charRes'])){ $charRes = $_POST['charRes']; }




	//build email
	$to = 'speedlanerunner@yahoo.com, monkeework@gmail.com, chezshire@gmail.com ';

	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";

	$from = 'Marvel Champions';
	$subject = 'Marvel Champions  (' . 	$uName . ')';
	//build body of email
	$message = $_POST['message'] . '

--------------------------------------------------------------------------
Sent By: ' . $uName . '
';

if(isset($charRes)){ $message .= $uName . ' has placed a new character request: ' . $charRes . ' (' . $ocfc . ')
';}

if(isset($charReq)){ $message .= $uName . ' is resigning ' . $charReq . '
';}

if(isset($rDate)){ $message .= $uName . ' has placed an LOA notice until ' . $rDate . '
';}



	//bring message together
	$body ="From: $name\n E-Mail: $email\n Message:\n $message";

	//Check if message has been entered
	if (!$_POST['message']) {
		$errMessage = 'Please enter your message';
	}
	//Check if simple anti-bot test is correct

	//if logged in....
	if (!$errMessage) {
		if (mail ($to, $subject, $body, $from)) {
			$result='<div class="alert alert-success">Thank You! I will be in touch</div>';

				feedback("Thank You! We will be in touch soon-ish ;)", "success");

				#header( "Location: $myURL "); //Send me back to where i belong
				header( "Location: " . VIRTUAL_PATH . "users/" ); //Send me back to where i belong

	// If there are no errors, send the email
	}else if (!$errName && !$errEmail && !$errMessage && !$errAnswer) {
		if (mail ($to, $subject, $body, $from)) {
			$result='<div class="alert alert-success">Thank You! I will be in touch</div>';

				feedback("Thank You! We will be in touch soon-ish ;)", "success");

				#header( "Location: $myURL "); //Send me back to where i belong
				header( "Location: " . VIRTUAL_PATH . "users/" ); //Send me back to where i belong
			}
		} else {
			$result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later.</div>';
		}

		echo '<div align="center"><h2>Your Comments Have Been Received!</h2></div>
<div align="center">We\'ll respond via email within 48 hours, if you requested information.</div>';

	echo $body;

	}
}


#show form, either for first time, or if data not valid or empty
if(!isset($_POST["message"]) || $error != "" || (empty($_POST["message"]))) {#separate code block to deal with returning failed data, or no data sent yet

	//echo 'POST data:';
	//var_dump($_POST);
	//echo 'Session data:';
	//var_dump($_SESSION);

?>

<!-- below change the HTML to accommodate your form elements - only 'Name' & 'Email' are significant -->
	<input type="hidden" name="name" title="Your Name is Required" value="<?=$uName;?>" />
	<input type="hidden" name="email" title="Your Name is Required" value="<?=$uEmail;?>" />

	<div class="form-group">
		<label for="message">Comments, questions, or concerns</label>
		<textarea class="form-control" id="message" name="message" rows="3" placeholder="We want to hear from you..."></textarea>
	</div>



<!-- my extraas -->
	<!-- leave of absence request-->
	<div class="form-group">
		Request LOA &nbsp; <input type="checkbox" name="loa" value="y" <?php if (isset($loa) && $loa=="y") echo "checked";?> />
		 &nbsp;
		Return Date: <input type="text" name="rDate" value="<?php if(isset($_POST['rDate'])){  echo $_POST['rDate'];};?>" placeholder=" MM/DD/YY" />
	</div>


<?php
	$sql = "SELECT CharID, UserID FROM ma_Characters WHERE UserID = $uID";

	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0){ // //at least one record! - show results

		#External formatting here...
		$x = 0;

		while ($row = mysqli_fetch_assoc($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db

			$charCount   = (int)$row['CharID'];

			if((int)$row['CharID']){ $x++; }//for each counted increment

		}

		//notify handler is eligible for another character at this time
		if($x <= 1){
			echo '<!-- character request -->
			<div class="form-group">
				<div class="form-group">
					Request Character: <input type="text" name="charReq" value=" <?php if (isset($charReq) && $charReq=="") echo $charReq;?>" placeholder="Character Requested?" />
					&nbsp;
					<input type="radio" name="ocfc" <?php if (isset($ocfc) && $ocfc=="oc") echo "checked";?> value="oc" /> OC
					&nbsp;
					<input type="radio" name="ocfc" <?php if (isset($ocfc) && $ocfc=="fc") echo "checked";?> value="fc" /> FC
				</div>
			</div>';
		}
		//out html

	}

	@mysqli_free_result($result); //free resources
?>


	<!-- resign character IF user has at least one approved character -->

		<?php
			$sql = "SELECT CharID, UserID, CodeName, StatusID FROM ma_Characters WHERE UserID = $uID";

			$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
			if (mysqli_num_rows($result) > 0){ // //at least one record! - show results
				#External formatting here...
				echo '<div class="form-group">
					<select class="form-control" id="charRes" name="charRes">
						<option> Resign Character</option>';

				while ($row = mysqli_fetch_assoc($result))
				{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db

					$charName = dbOut($row['CodeName']);
					$charID   = (int)$row['CharID'];

					echo '<option value="' . $charName . ' - ' . $charID . '">' . $charName . '</option>';
				}
				//out html
			 echo '</select>
				</div>';
			}

			@mysqli_free_result($result); //free resources
		?>


	<div class="form-group">
		<input class="btn btn-primary btn-sm" id="submit" name="submit" type="submit" value="Send Message" />
	</div>
</form>
<?php
}
?>
<!-- END CONTENT AREA here -->

<div class="clearfix"></div></div></div></div><!--/row-->
<div class="push"></div></div><!--/.container-->

<?php
//END CONTENT AREA
get_footer(); //defaults to theme footer or footer_inc.php


function handle_userEmail($skipFields,$sendEmail,$toName,$fromAddress,$toAddress,$website,$fromDomain){















}#end handle_userEmail()

function testInput($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
