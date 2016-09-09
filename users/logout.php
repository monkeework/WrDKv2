<?php
function maxDoc_users_logout_inc(){
/**
 * logout.php destroys session so administrators can logout
 *
 * Clears session data, forwards user to admin login page upon successful logout
 *
 *
 * @package ma-v1605-22
 * @author monkeework <monkeework@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.monkeework.com/
 * @license http://www.apche.org/licenses/LICENSE-2.0
 * @see admin_login.php
 * @todo none
 */

}


require '../_inc/config_inc.php'; #provides configuration, et al.

startSession(); //wrapper for session_start()
$_SESSION = array();# Setting a session to an empty array safely clears all data

//session_destroy();# can't destroy session as will disable feedback - instead do it on login form!
feedback("Logout Successful!", "notice");
$_SESSION['admin-red'] = THIS_PAGE;
#myRedirect($config->userLogin); # redirect for successful logout

#redirect back to page where we logged out from.
if(isset($_SERVER['HTTP_REFERER'])) {
	header('Location: '.$_SERVER['HTTP_REFERER']);
} else {
	header('Location: index.php');
}
