<?php
/**
 * validate.php checks access to user/admin area
 *
 * Processes form data from login.php to process administrator login requests.
 * Forwards user to dashboard.php, upon successful login.
 *
 *
 * @package ma-v1605-22
 * @author monkeework <monkeework@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.monkeework.com/
 * @license http://www.apche.org/licenses/LICENSE-2.0
 * @see login.php
 * @see dashboard.php
 * @todo none
 */

require '../_inc/config_inc.php'; #provides configuration, et al.


if (isset($_POST['em']) && isset($_POST['pw']))
{//if POST is set, prepare to process form data
	//next check for specific issues with data
	if(!onlyAlphaNum($_POST['pw']))
	{//data must be alphanumeric or punctuation only
		feedback("Illegal characters were entered. (error code #" . createErrorCode(THIS_PAGE,__LINE__) . ")","error");
		myRedirect($config->userLogin);
	}

	if(!onlyEmail($_POST['em']))
	{//login must be a legal email address only
		feedback("Illegal characters were entered. (error code #" . createErrorCode(THIS_PAGE,__LINE__) . ")","error");
		myRedirect($config->userLogin);
	}

	$iConn = IDB::conn(); # mysql classic conn, MUST precede iformReq() which uses active connection to parse data

	feedback("Login and/or Password are incorrect.","warning");
	$redirect = $config->userLogin; # global var used for following iformReq redirection on failure
	$Email = iformReq('em',$iConn);# iformReq()requires a form element with data, redirects to $redirect if no data sent
	$MyPass = iformReq('pw',$iConn);# iformReq() calls dbIn() internally, to check form data

	$sql = sprintf("select UserID,UserName,Privilege,NumLogins from " . PREFIX . "Users WHERE Email='%s' AND UserPW=SHA('%s')",$Email,$MyPass);
	$result = @mysqli_query($iConn,$sql) or die(trigger_error(mysqli_error($iConn), E_USER_ERROR));
	if(mysqli_num_rows($result) > 0) # had to be a match
	{# valid user, create session vars, redirect!

		$row = mysqli_fetch_array($result); #no while statement, should be single record
		startSession(); #wrapper for session_start()
		$UserID = (int)$row["UserID"];  # use (int) cast to for conversion to integer
		$_SESSION["UserID"] = $UserID; # create session variables to identify admin
		$_SESSION["UserName"] = dbOut($row["UserName"]);  #use dbOut() to clean strings, replace escaped quotes
		$_SESSION["Privilege"] = dbOut($row["Privilege"]);
		$NumLogins = (int)$row["NumLogins"];
		$NumLogins+=1;  # increment number of logins, then prepare to update record!

		# update Admin record, recording new number of logins, and new LastLogin date/time
		$sql = sprintf("UPDATE " . PREFIX . "User set NumLogins=%d, LastLogin=NOW()  WHERE UserID=%d",$NumLogins,$UserID);
		@mysqli_query($iConn,$sql) or die(trigger_error(mysqli_error($iConn), E_USER_ERROR));

		if(isset($_SESSION['admin-red']) && $_SESSION['admin-red'] != "")
		{#check to see if we'll be redirecting to a requesting page
			$red = $_SESSION['admin-red']; #redirect back to original page
			$_SESSION['admin-red'] == ''; #clear session var
			feedback("Login Successful!", "notice");
			myRedirect($red);
		}else{
			feedback("Login Successful!", "notice");
			myRedirect($config->adminDashboard);# successful login! Redirect to admin page
		}

	}else{# failed login, redirect
			feedback("Login and/or Password are incorrect.","warning");
		myRedirect($config->userLogin);
	}
}else{
	feedback("Required data not sent. (error code #" . createErrorCode(THIS_PAGE,__LINE__) . ")","error");
	myRedirect($config->userLogin);
}
?>
