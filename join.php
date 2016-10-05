<!--text and stuff for join modal if we ever get it working-->

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
