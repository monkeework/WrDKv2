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
		if($uPriv >= 17){

			# deets comes form calling file
			$str = '<div class="row"><div class="col-sm-5 maxIt" ><h4><b>MaxDO:</b></h4>
					<small>'. $deets . '</small>
				</div></div>';
		}
		#free stuff once we start using db....
	}

	return $str;

}
