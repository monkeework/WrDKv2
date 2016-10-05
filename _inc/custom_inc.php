<?php
function maxDoc_inc_custom_inc(){
	/**
	 * custom_inc.php stores custom functions specific to your application
	 *
	 * Keeping common_inc.php clear of your functions allows you to upgrade without conflict
	 *
	 *
	 * @package ma-v1605-22
	 * @author monkeework <monkeework@gmail.com>
	 * @version 3.02 2011/05/18
	 * @link http://www.monkeework.com/
	 * @license http://www.apche.org/licenses/LICENSE-2.0
	 * @todo add safeEmail to common_inc.php
	 */

	/**
	 * Place your custom functions below so you can upgrade common_inc.php without trashing
	 * your custom functions.
	 *
	 * An example function is commented out below as a documentation example
	 *
	 * View common_inc.php for many more examples of documentation and starting
	 * points for building your own functions!
	 */
}

function chekPrivies($privReq = '0', $privChek = '0'){
/**
	* If User Privilege not equal to minimum require privilege level for access, redirect to main site index page.
	*
	* @param string $str data as entered by user
	* @return boolean returns true if matches pattern.
	*/

	// Get User Privilege from session
	$privChek = (int)$_SESSION['Privilege']; //Cast as int

	//if Priv less then access required redirect to main index.
	if ($privChek < $privReq){
		$myURL = VIRTUAL_PATH;
		myRedirect($myURL);
	}
}

function alphaOnly($str){
/**
 * Checks data for alphanumeric characters using PHP regular expression.
 *
 * Returns true if matches pattern.  Returns false if it doesn't.
 * It's advised not to trust any user data that fails this test.
 *
 * @param string $str data as entered by user
 * @return boolean returns true if matches pattern.
 * @todo none
 */
	if(preg_match("/[^a-zA-Z]/",$str))
	{return false;}else{return true;} //opposite logic from email?
}#end onlyAlpha()

function maxNotes($deets = '', $req='', $str = ''){
/**
 * Displays developer notes.
 *
 * If user ID = privledge rating, displays developer notes on page.
 *
 * @param string $str data as entered by user
 * @return $str if => then Privlede level given by fucntion callOh dear .
 * @todo none
 */
	#get user id to vet access
	if(startSession() && isset($_SESSION['UserID'])){

		#get userID and prevledgies
		$uPriv = $_SESSION['Privilege'];

		#if user is equal to access, show
		if($uPriv >= 7){

			# deets comes form calling file
			$str = '<div class="row""><div class="col-sm-5 maxIt" ><h4><b>MaxDO:</b></h4>
					<small>'. $deets . '</small>
				</div></div>';
		}
		#free stuff once we start using db....
	}

	return $str;

}

function getSidebar($uName = '', $uID = '', $uPriv = '', $str = ''){

	$str .= '<div class="row row-offcanvas row-offcanvas-left">
	 <div class="col-sm-3 col-md-2 sidebar-offcanvas" id="sidebar" role="navigation">

			<ul class="nav nav-sidebar">
				<li class="active"><a href="dashboard.php">My Homepage</a></li>
				<li><a href="' . VIRTUAL_PATH . 'users/userStart.php">My Startpage</a></li>
				<li><a href="' . VIRTUAL_PATH . 'users/userChars.php">My Characters</a></li>
				<li class="text-muted"  target="_ext">&nbsp; &nbsp; &nbsp; My Posts*</li>
				<li class="text-muted">&nbsp; &nbsp; &nbsp; My Tags*</li>
				<li class="text-danger"><a href="' . VIRTUAL_PATH . 'users/userUpdatePassword.php?act=edit&uID=' . $uID . '">My Password*</a></li>
				<li class="text-danger"><a href="' . VIRTUAL_PATH . 'users/userPrefs.php?act=edit&uID=' . $uID . '">My Preferences*</a></li>
				<li class="text-muted"><a href="' . VIRTUAL_PATH . 'users/userProfile.php">My Profile</a></li>
				<li class="text-muted"><a href="' . VIRTUAL_PATH . 'users/userContact.php">Contact Staff</a></li>
			</ul>';


	if($uPriv >= 4){
		$str .= '<h4>Moderator Tools<br />
		<small class="text-muted">for managing threads/characters</small></h4>
		<ul class="nav nav-sidebar">
			<li class="text-muted">&nbsp; &nbsp; &nbsp; Characters*</li>
			<li class="text-muted">&nbsp; &nbsp; &nbsp; Posts*</li>
		</ul>';
	}

	if($uPriv >= 5){
		$str .= '<h4>Admin Tools<br />
		<small class="text-muted">for managing user\'s needs</small></h4>
		<ul class="nav nav-sidebar">
		<li class="text-muted">&nbsp; &nbsp; &nbsp; Pages*</li>
		<li class="text-danger"><a href="' . VIRTUAL_PATH . 'users/adminAddUser.php">Add User</a></li>
		<li class="text-danger"><a href="' . VIRTUAL_PATH . 'users/adminEditUser.php">Edit User</a></li>
		<li class="text-danger"><a href="' . VIRTUAL_PATH . 'users/adminResetPassword.php">Reset User Password</a></li>
		<li class="text-muted">&nbsp; &nbsp; &nbsp; Ban User*</li>
	</ul>';
	}

	if($uPriv == 7){
		$str .=  "<h4>Monkee's Tools</h4>";
		$str .=  '<ul class="nav nav-sidebar">
			<li><a href="' . VIRTUAL_PATH . 'users/maxAdminer.php">Adminer</a></li>
			<li><a href="' . VIRTUAL_PATH . 'users/maxSessions.php">Session Nuke</a></li>
			<li><a href="' . VIRTUAL_PATH . 'users/maxInfo.php">PHP_INFO</a></li>
			<li><a href="' . VIRTUAL_PATH . 'users/maxLogs.php">View Logs</a></li>
		</ul>';
	}

	$str .= '	<!-- BEGIN row --></div><!--/span-->';

	return $str;

}

function getCurrentURL($strip = true) {// filter function - get current page url
	//used in themes/bootstrape/footer_inc.php

	static $filter;
	if ($filter == null) {
		$filter = function($input) use($strip) {
			$input = str_ireplace(array(
					"\0", '%00', "\x0a", '%0a', "\x1a", '%1a'), '', urldecode($input));
			if ($strip) {
					$input = strip_tags($input);
			}

			// or any encoding you use instead of utf-8
			$input = htmlspecialchars($input, ENT_QUOTES, 'utf-8');

			return trim($input);
		};
	}

	return 'http'. (($_SERVER['SERVER_PORT'] == '443') ? 's' : '')
		.'://'. $_SERVER['SERVER_NAME'] . $filter($_SERVER['REQUEST_URI']);
}
