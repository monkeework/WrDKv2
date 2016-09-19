<?php
function maxDoc_users_userPrefs(){
/**
 * $config->addUser.php is a single page web application that adds an administrator
 * to the admin database table
 *
 * This page is public by default, but as soon as you add yourself to the database,
 * make the page private by removing the commented redirect to admin_only_inc.php on
 * approximately line 54 of this page
 *
 *
 * @package ma-v1605-22
 * @author monkeework <monkeework@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.monkeework.com/
 * @license http://www.apche.org/licenses/LICENSE-2.0
 * @see admin_only_inc.php
 * @todo Currently the JS file is hard wired to a folder named 'include' inside
 * $config->adminAdd.php & admin_reset.php.  Please change this path in these files until this is fixed.
 */
}


require '../_inc/config_inc.php'; #provides configuration, et al.


//set access priv needed for this page by member
chekPrivies(5); #admin+

$config->titleTag = 'Add Member'; #Fills <title> tag. If left empty will fallback to $config->titleTag in config_inc.php
$config->metaRobots = 'no index, no follow';#never index admin pages

//END CONFIG AREA ----------------------------------------------------------

$access = "superadmin"; #superadmin or above can add new administrators
include_once INCLUDE_PATH . 'admin_only_inc.php'; #session protected page - level is defined in $access var



if (isset($_POST['Email']))
{# if Email is set, check for valid data
	if(!onlyEmail($_POST['Email']))
	{//data must be alphanumeric or punctuation only
		feedback("Data entered for email is not valid", "error");
		myRedirect($config->userAdd);
	}

	if(!onlyAlphaNum($_POST['PWord1']))
	{//data must be alphanumeric or punctuation only
		feedback("Password must contain letters and numbers only.","error");
		myRedirect($config->userAdd);
	}

	$iConn = IDB::conn();
	$UserName = iformReq('UserName',$iConn);  # iformReq calls dbIn() internally, to check form data
	$UserPW = iformReq('PWord1',$iConn);
	$Email = strtolower(iformReq('Email',$iConn));

	$Privilege = iformReq('Privilege',$iConn);
	#$Privilege = $_POST['Privilege'];

	#sprintf() function allows us to filter data by type while inserting DB values.  Illegal data is neutralized, ie: numerics become zero
	$sql = sprintf("INSERT into " . PREFIX . "Users (UserName,UserPW,Email,Privilege,DateAdded) VALUES ('%s',SHA('%s'),'%s','%s',NOW())", $UserName,$UserPW,$Email,$Privilege);

	@mysqli_query($iConn,$sql) or die(trigger_error(mysqli_error($iConn), E_USER_ERROR));  # insert is done here

	# feedback success or failure of insert
	if (mysqli_affected_rows($iConn) > 0){
		feedback("User Added!","notice");
	}else{
		 feedback("User NOT Added!", "error");
	}
	get_header();

	echo '
		<div align="center"><h3>Add User</h3></div>
		<div align="center"><a href="' . $config->userAdd . '">Add More</a></div>
		<div align="center"><a href="' . $config->userDashboard . '">Exit To Dashboard</a></div>
		';


}else{ //show form - provide feedback
	$config->loadhead= '
	<script type="text/javascript" src="' . VIRTUAL_PATH . '_inc/util.js"></script>
	<script type="text/javascript">
			function checkForm(thisForm)
			{//check form data for valid info
				if(empty(thisForm.UserName,"Please Enter Username")){return false;}

				if(!isEmail(thisForm.Email,"Please enter a valid Email Address")){return false;}
				if(!isAlphanumeric(thisForm.PWord1,"Only alphanumeric characters are allowed for passwords.")){thisForm.PWord2.value="";return false;}
				if(!correctLength(thisForm.PWord1,6,20,"Password does not meet the following requirements:")){thisForm.PWord2.value="";return false;}
				if(thisForm.PWord1.value != thisForm.PWord2.value)
				{//match password fields
						 alert("Password fields do not match.");
						 thisForm.PWord1.value = "";
						 thisForm.PWord2.value = "";
						 thisForm.PWord1.focus();
						 return false;
					 }
				return true;//if all is passed, submit!
			}
	</script>
	';

	get_header();
	echo '
		<h3 align="center">Add New User</h3>
		<p align="center">Be sure to write down the password!!</p>
		<form action="' . $config->userAdd . '" method="post" onsubmit="return checkForm(this);">
			<table align="center">
				<tr>
					<td align="right">Username</td>
					<td>
						<input type="text" name="UserName" />
						<font color="red"><b>*</b></font>
					</td>
				</tr>
				<tr>
					<td align="right">Email</td>
					<td>
						<input type="text" name="Email" />
						<font color="red"><b>*</b></font>
					</td>
				</tr>
				<tr>
					<td align="right">Privilege:</td>
					<td>
						<select name="Privilege" >
							<option>Set Privilege</option>';

							//allow user to set privleges to one level lower then self;
							$uPriv = $_SESSION['Privilege'];
							$x = 0;
							#user can set another's user priv's to one value less then their own
							while($x < $uPriv) {
									echo '<option value="' . $x .'"> ' . $aarPrivilege[$x];
									$x++;
							}

						echo ' </select>';

		echo '</td>
				</tr>
				<tr>
					<td align="right">Password</td>
					<td>
					<input type="password" name="PWord1" />
					<font color="red"><b>*</b></font>
					<em>(6-20 alphanumeric chars)</em>
					</td>
				</tr>
				<tr>
					<td align="right">Re-enter Password</td>
					<td>
					<input type="password" name="PWord2" />
					<font color="red"><b>*</b></font>
					</td>
				</tr>
				<tr>
					<td align="center" colspan="2">
					<input type="submit" value="Add User!" />
					<em>(<font color="red"><b>*</b> required field</font>)</em>
					</td>
				</tr>
			</table>
		</form>
	<div align="center"><a href="' . $config->userDashboard . '">Exit To Dashboard</a></div>
	';

}

	get_footer(); #defaults to theme footer or footer_inc.php
?>
