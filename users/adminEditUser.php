<?php
/**
 * $config->adminEdit.php is a single page web application that allows an admin to
 * edit some of their personal data
 *
 * This page is an addition to the application started as the nmAdmin package
 *
 *
 * @package ma-v1605-22
 * @author monkeework <monkeework@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.monkeework.com/
 * @license http://www.apche.org/licenses/LICENSE-2.0
 * @see $config->adminAdd.php
 * @see admin_reset.php
 * @see admin_only_inc.php
 * @todo Add ability to change privilege level of admin by developer - add ability of SuperAdmin to change priv. level
 */

require '../_inc/config_inc.php'; #provides configuration, et al.
$config->titleTag = 'Edit User'; #Fills <title> tag. If left empty will fallback to $config->titleTag in config_inc.php
$config->metaRobots = 'no index, no follow';#never index admin pages

//END CONFIG AREA ----------------------------------------------------------




//set access priv needed for this page by member
chekPrivies(2); #mems+


/*

<img alt="Adam Gallagher - Everything Is Peter's!!!!! - The twin" class="unselectable" id="main_photo" itemprop="contentURL" src="http://cdn10.lbstatic.nu/files/looks/medium/2011/08/23/1509105_PETER.jpg?1314086187" srcset="http://cdn10.lbstatic.nu/files/looks/large/2011/08/23/1509105_PETER.jpg?1314086187 1.5x" style="width: 553px; height: 560px;" title="Adam Gallagher - Everything Is Peter's!!!!! - The twin">

*/


$access = "admin"; #admins can edit themselves, developers can edit any - don't change this var or no one can edit their own data
include_once INCLUDE_PATH . 'admin_only_inc.php'; #session protected page - level is defined in $access var

# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}

switch ($myAction)
{//check for type of process
	case "edit": # 2) show form to edit data
		 editDisplay();
		 break;
	case "update": # 3) execute SQL, redirect
		updateExecute();
		break;
	default: # 1)Select Administrator
		 selectUser();
}

function selectUser(){//Select administrator
	global $config;

	if($_SESSION["Privilege"] == "admin")
	{#redirect if logged in only as admin
		myRedirect(THIS_PAGE . "?act=edit");
	}

	$config->loadhead='
	<script type="text/javascript" src="' . VIRTUAL_PATH . '_inc/util.js"></script>
	<script type="text/javascript">
			function checkForm(thisForm)
			{//check form data for valid info
				//if(!checkRadio(thisForm.UserID,"Please Select a User.")){return false;}
				if(empty(thisForm.UserID,"Please Select an User.")){return false;}
				return true;//if all is passed, submit!
			}
	</script>
	';
	get_header();
	echo '<h3 align="center">Edit User</h3>';
	if($_SESSION["Privilege"] >= 5)
	{# must be greater than admin level to have  choice of selection
		echo '<p align="center">Select User to edit their data:</p>';
	}
	echo '<form action="' . $config->userEdit . '" method="post" onsubmit="return checkForm(this);">';
	$iConn = IDB::conn();
	$sql = "select UserID,UserName,Email,Privilege,LastLogin,NumLogins from " . PREFIX . "Users";
	if($_SESSION["Privilege"] != "developer" && $_SESSION["Privilege"] != "superadmin")
	{# limit access to the individual, if not developer level
		$sql .= " where UserID=" . $_SESSION["UserID"];
	}
	$result = mysqli_query($iConn,$sql) or die(trigger_error(mysqli_error($iConn), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results
		echo '
		<form action="' . $config->userEdit . '" method="post" onsubmit="return checkForm(this);">
		<table align="center" border="1" style="border-collapse:collapse" cellpadding="3" cellspacing="3">
		<tr><th>UserID</th><th>Admin</th><th>Email</th><th>Privilege</th></tr>
		';
		while ($row = mysqli_fetch_array($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
				 echo '
				 <tr>
					 <td>
						 <input type="radio" name="UserID" value="' . (int)$row['UserID'] . '">' .
						 (int)$row['UserID'] . '</td>
					 <td>' . dbOut($row['UserName']) . '</td>
					 <td>' . dbOut($row['Email']) . '</td>
					 <td>' . dbOut($row['Privilege']) . '</td>
				 </tr>
				 ';
		}
		echo '
			<input type="hidden" name="act" value="edit" />
			<tr>
				<td align="center" colspan="4">
					<input type="submit" value="Choose User!" />
				</td>
			</tr>
		</table>
		</form>
		';
	}else{//no records
			echo '<div align="center"><h3>Currently No Users in Database.</h3></div>';
	}
	 echo '<div align="center"><a href="' . $config->userDashboard . '">Exit To Dashboard</a></div>';
	@mysqli_free_result($result); //free resources
	get_footer();

}

function editDisplay(){
	global $config;
	if($_SESSION["Privilege"] == "admin")
	{#use session data if logged in as admin only
		$myID = (int)$_SESSION['UserID'];
	}else{
		if(isset($_POST['UserID']) && (int)$_POST['UserID'] > 0)
		{
			 $myID = (int)$_POST['UserID']; #Convert to integer, will equate to zero if fails
		}else{
			feedback("UserID not numeric","error");
			myRedirect($config->userReset);
		}
	}
	$privileges = getENUM(PREFIX . 'Users','Privilege'); #grab all possible 'Privileges' from ENUM

	$iConn = IDB::conn();
	$sql = sprintf("select UserName, Email ,Privilege from " . PREFIX . "Users WHERE UserID=%d",$myID);
	$result = @mysqli_query($iConn,$sql) or die(trigger_error(mysqli_error($iConn), E_USER_ERROR));
	if(mysqli_num_rows($result) > 0)//at least one record!
	{//show results
		while ($row = mysqli_fetch_array($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
				 $UserName = dbOut($row['UserName']);
				 $Email = dbOut($row['Email']);
				 $Privilege = dbOut($row['Privilege']);
		}
	}else{//no records
			//put links on page to reset form, exit
			echo '
			<div align="center"><h3>No such administrator.</h3></div>
			<div align="center"><a href="' . $config->userDashboard . '">Exit To Dashboard</a></div>
			';
	}

	$config->loadhead = '<script type="text/javascript" src="<?php echo VIRTUAL_PATH; ?>_inc/util.js"></script>
	<script type="text/javascript">
			function checkForm(thisForm)
			{//check form data for valid info
				if(empty(thisForm.UserName,"Please enter username.")){return false;}
				if(!isEmail(thisForm.Email,"Please enter a valid Email Address")){return false;}
				return true;//if all is passed, submit!
			}
	</script>
	';

	get_header();

	echo '
	<h3 align="center">Edit ' . $_SESSION['UserName'] . '</h3>
	<form action="' . $config->userEdit . '" method="post" onsubmit="return checkForm(this);">
	<table align="center">
		<tr>
			<td align="right">Username</td>
			<td>
				<input type="text" name="UserName" value="' . $UserName . '" />
				<font color="red"><b>*</b></font>
			</td>
		</tr>
		<tr>
			<td align="right">Email</td>
			<td>
				<input type="text" name="Email" value="' . $Email . '" />
				<font color="red"><b>*</b></font>
			</td>
		</tr>
	';



	#error in file: '/Applications/AMPPS/www/WrDKv2/users/editUser.php' on line: 209 Error message: Undefined variable: aarPrivilegeBackTrace:
	$uPriv = $_SESSION['Privilege'];


	var_dump($uPriv);





	if($_SESSION["Privilege"] >= 5)
	{# uses createSelect() function to preload the select option
		echo '
		<tr>
			<td align="right">Privilege</td>
			<td>

			<select name="Privilege" >
				<option>Set Privilege</option>';

				//allow user to set privleges to one level lower then self;
				$setPriv = (int)$uPriv  - 1;

$x = 1;
				#user can set another's user priv's to one value less then their own
				while($x <= $uPriv) {
						#echo '<option value="' . $x .'"> ' . $aarPrivilege[$x];
						echo '<option value="' . $x .'"> ' . $x;
						$x++;
				}

			echo ' </select>

			</td>
		</tr>';
	}else{
		echo '<input type="hidden" name="Privilege" value="' . $_SESSION["Privilege"] . '" />';
	}


	echo '
		 <input type="hidden" name="UserID" value="' , $myID . '" />
		 <input type="hidden" name="act" value="update" />
		 <tr>
			<td align="center" colspan="2">
				<input type="submit" value="Update User" />
				<em>(<font color="red"><b>*</b> required field</font>)</em>
			</td>
		</tr>
	</table>
	</form>
	<div align="center"><a href="' . $config->userDashboard . '">Exit To Dashboard</a></div>
	';
	@mysqli_free_result($result); //free resources
	get_footer();
}

function updateExecute(){
	global $config;
	$iConn = IDB::conn(); # MUST precede iformReq() function, which uses active connection to parse data
	$redirect = $config->userEdit; # global var used for following iformReq redirection on failure
	$UserName = iformReq('UserName',$iConn);  # iformReq calls dbIn() internally, to check form data

	$Email = strtolower(iformReq('Email',$iConn));
	$Privilege = iformReq('Privilege',$iConn);
	$UserID = iformReq('UserID',$iConn);

	#check for duplicate email
	$sql = sprintf("select UserID from " . PREFIX . "Users WHERE (Email='%s') and UserID != %d",$Email,$UserID);
	$result = mysqli_query($iConn,$sql) or die(trigger_error(mysqli_error($iConn), E_USER_ERROR));
	if(mysqli_num_rows($result) > 0)//at least one record!
	{# someone already has email!
		feedback("Email already exists - please choose a different email.");
		myRedirect($config->userEdit); # duplicate email
	}

	#sprintf() function allows us to filter data by type while inserting DB values.  Illegal data is neutralized, ie: numerics become zero
	$sql = sprintf("UPDATE " . PREFIX . "Users set UserName='%s',Email='%s',Privilege='%s' WHERE UserID=%d",$UserName,$Email,$Privilege,(int)$UserID);

	mysqli_query($iConn,$sql) or die(trigger_error(mysqli_error($iConn), E_USER_ERROR));

	//feedback success or failure of insert
	if (mysqli_affected_rows($iConn) > 0){
	 $msg= "Admin Updated!";
	 feedback("Successfully Updated!","notice");
	 if($_SESSION["UserID"] == $UserID)
	 {#this is me!  update current session info:
		$_SESSION["Privilege"] = $Privilege;
		 $_SESSION["UserName"] = $UserName;
	 }
	}else{
		 feedback("Data NOT Updated! (or not changed from original values)");
	}

	get_header();
	echo '
		<div align="center"><h3>Edit User</h3></div>
		<div align="center"><a href="' . $config->userReset . '">Edit More</a></div>
		<div align="center"><a href="' . $config->userDashboard . '">Exit To Dashboard</a></div>
		';
	get_footer();

}
