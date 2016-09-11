<?php
function maxDoc_themes_footer_inc(){
	/**
	 * based on add.php is a single page web application that allows us to add a new customer to
	 * an existing table
	 *
	 * BEGIN CONFIG for contact form (Not General Contact Modal)
	 * KEYs for Marvel-Champions
	 * get key from http://www.google.com/recaptcha/whyrecaptcha:
	 * For each customer/domain, get a key from http://recaptcha.net/api/getkey
	 *
	 * EDIT THE FOLLOWING:
	 *  $toAddress = "speedlanerunner@gmail.com, monkeework@gmail.com , chezshire@gmail.com";
	 * - place your/your client's email address here ADDRESSES!
	 * $toName = "Grandmaster, Gardener , Architect"; //place your client's name here
	 * $website = "Marvel Champions";  //place NAME of your client's website/form here,
	 *  - ie: ITC280 Contact, ITC280 Registration, etc.
	 * $sendEmail = TRUE; //if true,sends email, else shows user data.
	 *
	 *
	 * @package ma-v1605-22
	 * @author monkeework <monkeework@gmail.com>
	 * @version 3.02 2011/05/18
	 * @link http://www.monkeework.com/
	 * @license http://www.apche.org/licenses/LICENSE-2.0
	 * @todo add more complicated checkbox & radio button examples
	 */
}
?>


<!-- FOOTER begin -- THEMES / BOOTSTRAP / FOOTER_INC -->
<footer>
	<div class="row">
		<div class="col-lg-12">
			<ul class="list-unstyled">
				<li class="pull-right"><a href="#top">Back to top</a></li>
			</ul>
			<p><?=$config->copyright; ?>.</p>
		</div>
	</div>
</footer>
</div>
<!-- END content / THEMES / Footer_inc -->


<script type="text/javascript" src="<?=VIRTUAL_PATH; ?>_js/util.js"></script>
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

<style>
	p:first-letter{ text-transform: capitalize; }
</style>

<!-- JS for captcha.  Move to your _JS? (or not) -->
<script type="text/javascript">
	 var RecaptchaOptions = {
			theme : "clean"
	 };
 </script>

 <!-- CSS class for captcha.  Move to your CSS? (or not) -->
	<style>
		.g-recaptcha div { margin-left: auto; margin-right: auto;}

		#recaptcha_area { margin: auto;}
	</style>

<!-- begin JOIN/REGISTER MODAL begin -->


<!-- Modal -->
<div class="modal fade" id="joinMC" role="dialog">
	<div class="modal-dialog">

		<!-- begin MODAL CONTENT -->
		<form action="#" method="post">

			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Join Marvel Champions!</h4>
				</div>
				<div class="modal-body">


					<div class="form-group">
						<label for="email">User Name:</label>
						<input type="email" class="form-control" id="userName">
					</div>

					<div class="form-group">
						<label for="email">Email address:</label>
						<input type="email" class="form-control" id="email">
					</div>

					<div class="form-group">
						<label for="emailConfirm">Comfirm Email:</label>
						<input type="email" class="form-control" id="emailConfirm">
					</div>


					<div class="form-group">
						<label for="pwd">Password:</label>
						<input type="password" class="form-control" id="pwd">
					</div>

					<div class="form-group">
						<label for="pwConfirm">Confirm Password:</label>
						<input type="password" class="form-control" id="pwConfirm">
					</div>

<?Php
/*

It wouldn't account for the errors in the log, but it looks like you did forget to echo $str after you concatenated all of the options.  Could the undefined index in the logs be an old error that was corrected but didn't look fixed because the dropdown is still empty?

*/



#vars for join/register modal
$player   = $str  = '';
$trueSite         = 'Marvel Champions';
$trueAbbreviation = 'MC';

# form handler
#$sqlCharacters = 'SELECT Codename FROM ma_Characters WHERE UserID = NULL';
$sqlChar = $resultChar= '';

$sqlChar = "SELECT CodeName FROM ma_Characters WHERE UserID <= 3 ORDER BY CodeName ASC";

$resultChar = mysqli_query(IDB::conn(), $sqlChar) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
if (mysqli_num_rows($resultChar) > 0)//at least one record!
{//show results

	echo '<div class="form-group"><label for="characterRequest" control-label="maxOption2">Request Character</label>
		<div class="col-sm-12"><select id="maxOption1" class="selectpicker show-menu-arrow form-control" >';

	while ($row = mysqli_fetch_assoc($resultChar))
	{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
		echo $str = '<option>' . dbOut($row['CodeName']) . '</option></p>';
	}

	#closing formating here...
	echo '</select></div></div>';

}else{//no records
		echo '<option disabled>There Are Currently No Unclaimed Characters Available</option>';
}

@mysqli_free_result($resultChar); //free resources


?>




					<div class="clearfix"></div>

					<?php


					include INCLUDE_PATH . "aarContent-inc.php";
					echo $aarContent['EvalPost']; #content for RP Response Sample

					?>

					<div class="form-group">
						<label for="rpSample">RP Sample:</label>
						<textarea class="form-control" rows="7" id="rpSample" placeholder="<?=$aarContent['EvalPlaceholder']; #Placeholder copy pulled from array ?>"></textarea>
					</div>


					<?=$aarContent['Terms']; #Terms & Conditions text ?>

					<div class="clearfix"></div>

					<div class="checkbox">
						<label class="pull-right"><input type="checkbox"> I accept Marvel Champions terms and conditions<br />  for membership and agree to abide by them.</label>
					</div>


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-default btn-sm">Submit</button>
				</div>

			</form>
		</div><!-- begin MODAL CONTENT -->
	</div>
</div><!-- END MODAL -->

<!-- end JOIN/REGISTER MODAL end -- THEMES / BOOTSTRAP / FOOTER_INC -->











<!-- begin CONTACT MODAL begin -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Contact Staff...</h4>
			</div>

			<div class="modal-body">';



<form action="<?=THIS_PAGE; ?>" method="post" onsubmit="return checkForm(this);">

<?php
if (isset($_POST["recaptcha_response_field"]))
{# Check for reCAPTCHA response
		$resp = recaptcha_check_answer ($privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
	if ($resp->is_valid)
	{#reCAPTCHA agrees data is valid
				 handle_POST($skipFields,$sendEmail,$toName,$fromAddress,$toAddress,$website,$fromDomain);#process form elements, format and send email.

				 #Here we can enter the data sent into a database in a later version of this file
?>


		<!-- format HTML here to be your 'thank you' message -->
		<div align="center"><h2>Your Comments Have Been Received!</h2></div>
		<div align="center">Thanks for the input!</div>
		<div align="center">We'll respond via email within 48 hours, if you requested information.</div>


<?php
		}else{#reCATPCHA response says data not valid - prepare for feedback
			$error = $resp->error;
			send_POSTtoJS($skipFields); #function for sending POST data to JS array to reload form elements
		}
}

#show form, either for first time, or if data not valid per reCAPTCHA
if(!isset($_POST["recaptcha_response_field"])|| $error != "")
{#separate code block to deal with returning failed data, or no data sent yet

?>


	<!-- below change the HTML to accommodate your form elements - only 'Name' & 'Email' are significant -->
	<div class="text-center"><h3>Contact Us</h3></div>
	<div class="text-center">Your opinion is very important!</div>
	<div class="text-center"><span class="required">(*required)</span></div>

	<style>
		.capatcha {
				text-align: center;
		}

		#recaptcha_widget_div {
				display: inline-block;
		}
</style>

			<p class="text-center"><span class="required">*</span>Name:<br />
				<input type="text" name="Name" required="true" title="Your Name is Required" /><br />
				<span class="required">*</span>Email:<br />
				<input type="email" name="Email" required="true" title="A Valid Email is Required" /><br />
				Comments:<br />
				<textarea name="Comments" cols="35" rows="4"></textarea><br />

				<div class="capatcha ">


				</div>
				<br />

				<input class="center-block" type="submit" value="submit" />

			</p>
		</form>
<?php
}
?>


			</div>
		</div>
	</div>
</div>
<!-- END Modal -->



<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="<?=THEME_PATH;?>js/bootstrap.min.js"></script>
<script src="<?=THEME_PATH;?>js/bootswatch.js"></script>
<!-- FOOTER end -- THEMES / BOOTSTRAP / FOOTER_INC -->
</body>
</html>
