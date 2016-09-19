<?php
function maxDoc_users_userPrefs(){
/**
 * based on userPrefs.php is based on dashboard.php & _test/edit.php
 * A session protected 'dashboard' page of links to handler/administrator tools
 *
 * Use this file to set user site prefs.
 * Be sure this page is not publicly accessible by referencing admin_only_inc.php
 *
 *
 * @package ma-v1605-22
 * @author monkeework <monkeework@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.monkeework.com/
 * @license http://www.apche.org/licenses/LICENSE-2.0
 * @see $config->userLogin.php
 * @see $config->adminValidate.php
 * @see $config->adminLogout.php
 * @see admin_only_inc.php
 * @todo Get Image Border to show around submitted characters in my characters portion of dashboard.
 */
}

require '../_inc/config_inc.php'; //provides configuration, et al.

#declaried in users/validateUser.php
$uID 	= $_SESSION['UserID'];
$uName 	= $_SESSION['UserName'];
$uPriv 	= $_SESSION['Privilege'];
$uStart = $_SESSION['uStart']; #startpage



#dumpDie($_SESSION);
//set access priv needed for this page by member
chekPrivies(1); //known guest (1+)

//Do I need diss?
//$server = 'localhost'; //CHANGE TO YOUR MYSQL HOST!!
//$username='root'; //CHANGE TO YOUR MYSQL USERNAME!!

//to switch theme from Yeti to testBoard
$config->theme = 'testBoard'; //default theme (header/footer combo) see 'Themes' folder for others and info
$config->style = 'testBoard.css'; //currently only Bootswatch Theme uses style to switch look & feel


//END CONFIG AREA ----------------------------------------------------------
$access = "admin"; //admin or higher level can view this page
include_once INCLUDE_PATH . 'admin_only_inc.php'; //session protected page - level is defined in $access var

$feedback = ""; //initialize feedback
if(isset($_GET['msg']))
{
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

			<!-- content to go here -->


<?php
	# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
	if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}

	switch ($myAction)
	{//check 'act' for type of process
		case "edit": //2) show first name change form
			 editDisplay();
			 break;
		case "update": //3) Change customer's first name
			updateExecute();
			break;
		default: //1)Select Customer from list
			#setPrimeChar($uID); //Preferred start page/point

			setStartPage($uID, $uStart); //Prefered starting point
	}

?>


			<div class="clearfix"></div>
		</div>
	</div>
	</div><!--/row-->

	<div class="push"></div>

</div><!--/.container-->


<?php

//END CONTENT AREA

get_footer(); //defaults to theme footer or footer_inc.php


function getDirectories($path='', $str = ''){


	foreach (glob("*") as $dirname ) {
	if( is_dir( $dirname ) )
	echo "<a target=\"_blank\" href=\"$dirname \">$dirname</a><br />";}
	}


function setPrimeChar($uID){//Select Customer
	global $config;
	$config->loadhead .= '<script type="text/javascript" src="' . VIRTUAL_PATH . '_inc/util.js"></script>
	<script type="text/javascript">
			function checkForm(thisForm)
			{//check form data for valid info
				if(empty(thisForm.StartPage,"Please Select a Start Page.")){return false;}
				return true;//if all is passed, submit!
			}
	</script>
	';

	$sql = "SELECT UserID, UserName, Email, UserIP, Privilege, UserPW, UserStartPage, NumLogins, DateAdded, LastUpdated, LastLogin FROM " . PREFIX . "Users WHERE UserID = $uID";
	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));


	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results

		echo '<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">';  //TWO COPIES OF THIS LINE IN ORIG!!
		echo '<table align="center" border="1" style="border-collapse:collapse" cellpadding="3" cellspacing="3">';
		echo '<tr>
				<th colspan="2" class="text-center">Set Primary character as posting default</th>

			</tr>
			';
		while ($row = mysqli_fetch_assoc($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db

			//' . dbOut($row['UserStartPage']) . '
			/*
				<td>' . dbOut($row['UserName']) . '</td>
				<td>' . dbOut($row['Privilege']) . '</td>
				<td>' . dbOut($row['Email']) . '</td>
				'
						 . (int)$row['UserID'] . '
			*/

			$uStart = dbOut($row['UserStartPage']);

			var_dump($_SESSION);

			echo '<tr>
				<td> &nbsp; <input type="radio" name="uStart" value="userBegin"';
			if($uStart = 'userBegin'){echo 'checked';}

			echo '> &nbsp; </td>
				<td> &nbsp; User Begin Page - dashboardBegin.php</td>
			</tr>
			<tr>
				<td> &nbsp; <input type="radio" name="uStart" value="threads"';
			if($uStart = 'threads'){echo 'checked';}

			echo '> &nbsp; </td>
				<td> &nbsp; Posting Forum - threads.php</td>
			</tr>
			<tr>
				<td> &nbsp; <input type="radio" name="uStart" value="characters"';
			if($uStart = 'characters'){echo 'checked';}

			echo '> &nbsp; </td>
				<td> &nbsp; Character Index - character/index.php</td>
			</tr>
			<tr>
				<td> &nbsp; <input type="radio" name="uStart" value="dashboard"';
			if($uStart = 'users/dashboard'){echo 'checked';}

			echo '>  &nbsp; </td>
				<td> &nbsp; ' . $_SESSION['UserName'] . ' Dashboard - dashboard.php</td>
			</tr>
			<!-- We;ll add soem dev stuff later today -->
			<tr>
				<td> &nbsp; <input type="radio" name="uStart" value="reviewCharacters"';
			if($uStart = 'users/reviewCharacters'){echo 'checked';}

			echo '>  &nbsp; </td>
				<td> &nbsp; Character Review Forum</td>
			</tr>';
		}
		echo '<tr>
				<td><input type="hidden" name="act" value="edit" /></td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" value="Set Your Startpage!" style="width:100%"></em>
				</td>
			</tr>
			</table>
		</form>
		';
	}else{//no records
			echo '<div align="center"><h3>Currently User Start Page Declared.</h3></div>';
	}
	@mysqli_free_result($result); //free resources

}

function setStartPage($uID, $uStart, $str=''){//Select Customer

	/**
	 * We get the existing setting form the session
	 * we set the setting in the db - which updates the session
	 * so when user logs in they go to their start page
	 * this is only for first login of a session!
	 */

	global $config;
	$config->loadhead .= '<script type="text/javascript" src="' . VIRTUAL_PATH . '_inc/util.js"></script>
	<script type="text/javascript">
			function checkForm(thisForm)
			{//check form data for valid info
				if(empty(thisForm.StartPage,"Please Select a Start Page.")){return false;}
				return true;//if all is passed, submit!
			}
	</script>
	';

	$sql = "SELECT UserID, UserName, Email, UserIP, Privilege, UserPW, UserStartPage, NumLogins, DateAdded, LastUpdated, LastLogin FROM " . PREFIX . "Users WHERE UserID = $uID";
	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));


	// BEGIN FORM
	echo '<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">';  //TWO COPIES OF THIS LINE IN ORIG!!
	echo '<table align="center" border="1" style="border-collapse:collapse" cellpadding="3" cellspacing="3">';
	echo '<tr><th colspan="2" class="text-center">Set Start Page</th></tr>';



	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results

		#external/extra html here

		while ($row = mysqli_fetch_assoc($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db

			echo '<tr>
				<td> &nbsp; <input type="radio" name="uStart" value="userBegin"';
			if($uStart = 'userBegin'){echo 'checked';}

			echo '> &nbsp; </td>
				<td> &nbsp; User Begin Page - dashboardBegin.php</td>
			</tr>
			<tr>
				<td> &nbsp; <input type="radio" name="uStart" value="threads"';
			if($uStart = 'threads'){echo 'checked';}

			echo '> &nbsp; </td>
				<td> &nbsp; Posting Forum - threads.php</td>
			</tr>
			<tr>
				<td> &nbsp; <input type="radio" name="uStart" value="characters"';
			if($uStart = 'characters'){echo 'checked';}

			echo '> &nbsp; </td>
				<td> &nbsp; Character Index - character/index.php</td>
			</tr>
			<tr>
				<td> &nbsp; <input type="radio" name="uStart" value="dashboard"';
			if($uStart = 'users/dashboard'){echo 'checked';}

			echo '>  &nbsp; </td>
				<td> &nbsp; ' . $_SESSION['UserName'] . ' Dashboard - dashboard.php</td>
			</tr>
			<!-- We;ll add soem dev stuff later today -->
			<tr>
				<td> &nbsp; <input type="radio" name="uStart" value="reviewCharacters"';
			if($uStart = 'users/reviewCharacters'){echo 'checked';}

			echo '>  &nbsp; </td>
				<td> &nbsp; Character Review Forum</td>
			</tr>';
		}

		#external/extra html here
		@mysqli_free_result($result); //free resources

	}

	//CONTINUE FORM
	//BEGIN chek for Handler Characters
	$sql = "SELECT UserID, CharID, CodeName, LastName, FirstName, MiddleName FROM " . PREFIX . "Characters WHERE UserID = $uID";
	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

	if (mysqli_num_rows($result) > 0){//show results IF at least one record!

		#external/extra html here


		#setStartPage($uID, $uStart); //Prefered Character
		while ($row = mysqli_fetch_assoc($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db

			#$uStart = dbOut($row['UserStartPage']);

			//' . dbOut($row['UserStartPage']) . '
			/*
				<td>' . dbOut($row['UserName']) . '</td>
				<td>' . dbOut($row['Privilege']) . '</td>
				<td>' . dbOut($row['Email']) . '</td>
				'
						 . (int)$row['UserID'] . '
			*/

			$cName = dbOut($row['CodeName']);
			$cID   = (int)$row['CharID'];

			echo '<tr>
				<td> &nbsp; <input type="radio" name="uStart" value="' . $cID . '"';
			if($uStart = $cID){echo 'checked';}

			echo '> &nbsp; </td>
				<td> &nbsp; ' . $cName . ' Profile</td>
			</tr>';

		}

		/*
			array (size=7)
			'feedback' => string '' (length=0)
			'feedback-level' => string '' (length=0)
			'admin-red' => string 'logout.php' (length=10)
			'UserID' => int 1
			'UserName' => string 'The Gardner' (length=11)
			'Privilege' => int 7
			'uStart' => string '../users/dashboardBegin.php' (length=27)
	*/

	@mysqli_free_result($result); //free resources

}

	#CLOSE FORM
	echo '<tr>
				<td><input type="hidden" name="act" value="edit" /></td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" value="Set Your Startpage!" style="width:100%"></em>
				</td>
			</tr>
		</table>
	</form>
	';

}



function editDisplay() {# shows details from a single customer, and preloads their first name in a form.
	global $config;
	if(!is_numeric($_POST['CustomerID']))
	{//data must be alphanumeric only
		feedback("id passed was not a number. (error code #" . createErrorCode(THIS_PAGE,__LINE__) . ")","error");
		myRedirect(THIS_PAGE);
	}


	$myID = (int)$_POST['CustomerID'];  //forcibly convert to integer

	$sql = sprintf("select CustomerID,FirstName,LastName,Email from test_Customers WHERE CustomerID=%d",$myID);
	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if(mysqli_num_rows($result) > 0)//at least one record!
	{//show results
		while ($row = mysqli_fetch_array($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
				 $Name = dbOut($row['FirstName']) . ' ' . dbOut($row['LastName']);
				 $First = dbOut($row['FirstName']);
				 $Last = dbOut($row['LastName']);
				 $Email = dbOut($row['Email']);
		}
	}else{//no records
			//feedback issue to user/developer
			feedback("No such customer. (error code #" . createErrorCode(THIS_PAGE,__LINE__) . ")","error");
		myRedirect(THIS_PAGE);
	}

	$config->loadhead .= '
	<script type="text/javascript" src="' . VIRTUAL_PATH . 'include/util.js"></script>
	<script type="text/javascript">
		function checkForm(thisForm)
		{//check form data for valid info
			if(empty(thisForm.FirstName,"Please Enter Customer\'s First Name")){return false;}
			if(empty(thisForm.LastName,"Please Enter Customer\'s Last Name")){return false;}
			if(!isEmail(thisForm.Email,"Please Enter a Valid Email")){return false;}
			return true;//if all is passed, submit!
		}
	</script>';


	echo '<h3 align="center">' . smartTitle() . '</h3>
	<h4 align="center">Update Customer\'s Name</h4>
	<p align="center">Customer: <font color="red"><b>' . $Name . '</b>
	 Email: <font color="red"><b>' . $Email . '</b></font>
	<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">
	<table align="center">
		 <tr><td align="right">First Name</td>
				 <td>
					 <input type="text" name="FirstName" value="' .  $First . '">
					 <font color="red"><b>*</b></font> <em>(alphanumerics & punctuation)</em>
				 </td>
		 </tr>
		 <tr><td align="right">Last Name</td>
				 <td>
					 <input type="text" name="LastName" value="' .  $Last . '">
					 <font color="red"><b>*</b></font> <em>(alphanumerics & punctuation)</em>
				 </td>
		 </tr>
		 <tr><td align="right">Email</td>
				 <td>
					 <input type="text" name="Email" value="' .  $Email . '">
					 <font color="red"><b>*</b></font> <em>(valid email only)</em>
				 </td>
		 </tr>
		 <input type="hidden" name="CustomerID" value="' . $myID . '" />
		 <input type="hidden" name="act" value="update" />
		 <tr>
				 <td align="center" colspan="2">
					 <input type="submit" value="Update Info!"><em>(<font color="red"><b>*</b> required field</font>)</em>
				 </td>
		 </tr>
	</table>
	</form>
	<div align="center"><a href="' . THIS_PAGE . '">Exit Without Update</a></div>
	';
	@mysqli_free_result($result); //free resources


}

function updateExecute(){
	if(!is_numeric($_POST['CustomerID']))
	{//data must be alphanumeric only
		feedback("id passed was not a number. (error code #" . createErrorCode(THIS_PAGE,__LINE__) . ")","error");
		myRedirect(THIS_PAGE);
	}




	$iConn = IDB::conn();//must have DB as variable to pass to mysqli_real_escape() via iformReq()


	$redirect = THIS_PAGE; //global var used for following formReq redirection on failure

	$CustomerID = iformReq('CustomerID',$iConn); //calls mysqli_real_escape() internally, to check form data
	$FirstName = strip_tags(iformReq('FirstName',$iConn));
	$LastName = strip_tags(iformReq('LastName',$iConn));
	$Email = strip_tags(iformReq('Email',$iConn));

	//next check for specific issues with data
	if(!ctype_graph($_POST['FirstName'])|| !ctype_graph($_POST['LastName']))
	{//data must be alphanumeric or punctuation only
		feedback("First and Last Name must contain letters, numbers or punctuation","warning");
		myRedirect(THIS_PAGE);
	}


	if(!onlyEmail($_POST['Email']))
	{//data must be alphanumeric or punctuation only
		feedback("Data entered for email is not valid","warning");
		myRedirect(THIS_PAGE);
	}

		//build string for SQL insert with replacement vars, %s for string, %d for digits
		$sql = "UPDATE test_Customers set
		FirstName='%s',
		LastName='%s',
		Email='%s'
		 WHERE CustomerID=%d"
		 ;




		# sprintf() allows us to filter (parameterize) form data
	$sql = sprintf($sql,$FirstName,$LastName,$Email,(int)$CustomerID);

	@mysqli_query($iConn,$sql) or die(trigger_error(mysqli_error($iConn), E_USER_ERROR));
	#feedback success or failure of update
	if (mysqli_affected_rows($iConn) > 0)
	{//success!  provide feedback, chance to change another!
	 feedback("Data Updated Successfully!","success");

	}else{//Problem!  Provide feedback!
	 feedback("Data NOT changed!","warning");
	}
	myRedirect(THIS_PAGE);
}