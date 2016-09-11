<?php

function maxDoc_inc_admin_only_inc(){
/**
 * admin_only_inc.php session protection include for restricting access to administrative areas
 *
 * Checks for UserID session variable, and forcibly redirects users not logged in
 *
 *
 * @package ma-v1605-22
 * @author monkeework <monkeework@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.monkeework.com/
 * @license http://www.apche.org/licenses/LICENSE-2.0
 * @see admin_login.php
 * @see admin.php
 * @todo none
 */

 # '../' works for a sub-folder.  use './' for the root
}


startSession(); # wrapper for session_start()

if(!isset($_SESSION['UserID'])) { //no session var
	$myProtocol = strtolower($_SERVER["SERVER_PROTOCOL"]); # Cascade the http or https of current address
	if(strrpos($myProtocol,"https")>-1){$myProtocol = "https://";}else{$myProtocol = "http://";}
	$myURL = $_SERVER['REQUEST_URI'];  #Path derives properly on Windows & UNIX. alternatives: SCRIPT_URL, PHP_SELF
	$_SESSION['red'] = $myProtocol . $_SERVER['HTTP_HOST'] . $myURL;
		feedback("Your session has timed out.  Please login.");
	myRedirect($config->userLogin);
}else{

	//if(!isset($access)|| $access == ""){$access = "admin";}//empty becomes admin

	if(!isset($access)|| $access == ""){$access = 4;}//empty becomes admin
	$access = strtolower($access); //in case of typo

	//dumpDie($access);

	switch($access)
	{

		# random visitor in aisle four, public pages only!
		case 0: //"visitor"
			break;

		# not developer/owner/superadmin/admin/mod/handler/member/user/guest, back to admin page
		case 1: //"guest"
		case 2: //"member"
			# not developer/owner/superadmin, back to admin page
			if($_SESSION['Privilege'] <= 0)
			{
				feedback("Your admin privileges do not allow access to the previous page.");
				myRedirect($config->adminDashboard);
			}
			break;

		# not developer/owner/superadmin/admin/mod/handler, back to admin page
		case 3: //"handler"
			# not developer/owner/superadmin, back to admin page
			if($_SESSION['Privilege'] <= 2)
			{
				feedback("Your admin privileges do not allow access to the previous page.");
				myRedirect($config->adminDashboard);
			}
			break;

		# not developer/owner/superadmin/admin/mod, back to admin page
		case 4: //"mod"
		case 5: //"admin"
			# not developer/owner/superadmin, back to admin page
			if($_SESSION['Privilege'] <= 3)
			{
				feedback("Your admin privileges do not allow access to the previous page.");
				myRedirect($config->adminDashboard);
			}
			break;

		case 6: //"superadmin"
		#case 6: //"owner"
			# not developer/owner/superadmin, back to admin page
			if($_SESSION['Privilege'] <= 5)
			{
				feedback("Your admin privileges do not allow access to the previous page.");
				myRedirect($config->adminDashboard);
			}
			break;

		case 7: //"developer" highest level. all access!
			# not developer
			//if($_SESSION['Privilege']!="developer")
			if($_SESSION['Privilege'] < 7)
			{
				feedback("Your admin privileges do not allow access to the previous page.");
				myRedirect($config->adminDashboard);
			}
			break;
		break;
	}
}
