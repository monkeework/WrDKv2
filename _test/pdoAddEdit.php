<?php

# '../' works for a sub-folder.  use './' for the root
require '../_inc/config_inc.php'; #configuration, pathing, error handling, db credentials


//END CONFIG AREA ----------------------------------------------------------

# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}


switch ($myAction)
{//check 'act' for type of process
	case "add": //2) Form for adding new customer data
		var_dump($_POST);
		 addUser();
		 break;

	case "edit": //3) Insert new customer data
		var_dump($_POST);
			editUser();
			break;

	case "insert": //3) Insert new customer data
		var_dump($_POST);

				if(empty($_POST['FirstName'])) {
					header('Location: pdoAddEdit.php');
					exit;
				}
				if(empty($_POST['LastName'])) {
					header('Location: ?');
					exit;
					}
				if(empty($_POST['Email'])) {
					header('Location: ?');
					exit;
					}

				// all necessary data is good, add user insert
				insertUser();

				//Send home
				header('Location: ?');
				exit;

			break;


	case "execute": //3) update existing customer data
		var_dump($_POST);
			updateUser();
				header('Location: ?');
				exit;
			break;

	default: //1)Show existing customers
		showUsers();
}



function showUsers(){//Select Customer
	global $config;
	get_header();
	echo '<h3 align="center"> DEFAULT <small>S1</small></h3>';


	$sql = "select CustomerID,FirstName,LastName,Email from test_Customers";
	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results
		echo '<table align="center" border="1" style="border-collapse:collapse" cellpadding="3" cellspacing="3">';
		echo '<tr>
				<th>CustomerID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
			</tr>

			<form action="' . THIS_PAGE . '?act=edit" method="post">
			';
		while ($row = mysqli_fetch_assoc($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
			$cID = (int)$row['CustomerID'];

			echo '<tr>
					<td><input type="radio" name="CustomerID" value="' . $cID . '"> &nbsp; ' . $cID . '</td>
					<td>' . dbOut($row['FirstName']) . '</td>
					<td>' . dbOut($row['LastName']) . '</td>
					<td>' . dbOut($row['Email']) . '</td>
				</tr>
				';
		}
		echo '<tr>
				<!-- using a link to add customer -->
				<td colspan="2">
					<a href="' . THIS_PAGE . '?act=add" class="btn btn-primary btn-sm">
						Add Customer
					</a>
				</td>

				<!-- using post to edit customer -->
				<td colspan="2" align="right">
					<input type="submit" name="submit" value="Edit Customer" class="btn btn-primary btn-sm">
				</td>
			</tr>

		</table>';
		echo '</form>';

	}else{//no records
			echo '<div align="center"><h3>Currently No Customers in Database.</h3></div>';
	}

	@mysqli_free_result($result); //free resources
	get_footer();
}


#better names add & addCommit
function addUser(){# shows details from a single customer, and preloads their first name in a form.
	global $config;
	$config->loadhead .= '
	<script type="text/javascript" src="' . VIRTUAL_PATH . '_inc/util.js"></script>
	<script type="text/javascript">
		function checkForm(thisForm)
		{//check form data for valid info
			if(empty(thisForm.FirstName,"Please Enter Customer\'s First Name")){return false;}
			if(empty(thisForm.LastName,"Please Enter Customer\'s Last Name")){return false;}
			if(!isEmail(thisForm.Email,"Please Enter a Valid Email")){return false;}
			return true;//if all is passed, submit!
		}
	</script>';

	get_header();
	echo '<h3 align="center">' . smartTitle() . '</h3>
	<h4 align="center">Add User</h4>
	<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">
	<table align="center">
		 <tr><td align="right">First Name</td>
				 <td>
					 <input type="text" name="FirstName" />
					 <font color="red"><b>*</b></font> <em>(alphanumerics & punctuation)</em>
				 </td>
		 </tr>
		 <tr><td align="right">Last Name</td>
				 <td>
					 <input type="text" name="LastName" />
					 <font color="red"><b>*</b></font> <em>(alphanumerics & punctuation)</em>
				 </td>
		 </tr>
		 <tr><td align="right">Email</td>
				 <td>
					 <input type="text" name="Email" />
					 <font color="red"><b>*</b></font> <em>(valid email only)</em>
				 </td>
		 </tr>
		 <input type="hidden" name="act" value="insert" />
		 <tr>
				 <td align="center" colspan="2">
					 <input type="submit" value="Add Customer!"><em>(<font color="red"><b>*</b> required field</font>)</em>
				 </td>
		 </tr>
	</table>
	</form>
	<div align="center"><a href="' . THIS_PAGE . '">Exit Without Add</a></div>
	';
	get_footer();

}

function insertUser(){

	//$FirstName = strip_tags($_POST['FirstName']);
	//$LastName = strip_tags($_POST['LastName']);
	//$Email = strip_tags($_POST['Email']);

	$FirstName = $_POST['FirstName'];
	$LastName = $_POST['LastName'];
	$Email = $_POST['Email'];

	$db = pdo(); # pdo() creates and returns a PDO object

	//dumpDie($FirstName);

	//PDO Quote has some great stuff re: injection:
	//http://www.php.net/manual/en/pdo.quote.php

	//next check for specific issues with data
	/*
	if(!ctype_graph($_POST['FirstName'])|| !ctype_graph($_POST['LastName']))
	{//data must be alphanumeric or punctuation only
		feedback("First and Last Name must contain letters, numbers or punctuation");
		myRedirect(THIS_PAGE);
	}


	if(!onlyEmail($_POST['Email']))
	{//data must be alphanumeric or punctuation only
		feedback("Data entered for email is not valid");
		myRedirect(THIS_PAGE);
	}
	*/




		//build string for SQL insert with replacement vars, ?
		$sql = "INSERT INTO test_Customers (FirstName, LastName, Email) VALUES (?,?,?)";

	$stmt = $db->prepare($sql);
	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);
	$stmt->bindValue(1, $FirstName, PDO::PARAM_STR);
	$stmt->bindValue(2, $LastName, PDO::PARAM_STR);
	$stmt->bindValue(3, $Email, PDO::PARAM_STR);

	try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
	#feedback success or failure of update

	if ($stmt->rowCount() > 0)
	{//success!  provide feedback, chance to change another!
		feedback("Customer Added Successfully!","success");
	}else{//Problem!  Provide feedback!
		feedback("Customer NOT added!","warning");
	}

}


#better names edit & editCommit
function editUser(){# shows details from a single customer, and preloads their first name in a form.
	if(!isset($_POST['CustomerID'])){
		//oops - no one selected!
		feedback("Customer NOT selected!","warning");
		//send back to start
		header('Location: ?');
		exit;
	}


	global $config;
	$config->loadhead .= '
	<script type="text/javascript" src="' . VIRTUAL_PATH . '_inc/util.js"></script>
	<script type="text/javascript">
		function checkForm(thisForm)
		{//check form data for valid info
			if(empty(thisForm.FirstName,"Please Enter Customer\'s First Name")){return false;}
			if(empty(thisForm.LastName,"Please Enter Customer\'s Last Name")){return false;}
			if(!isEmail(thisForm.Email,"Please Enter a Valid Email")){return false;}
			return true;//if all is passed, submit!
		}
	</script>';

	get_header();

	$myID = $_POST['CustomerID'];
	$sql = "select CustomerID,FirstName,LastName,Email from test_Customers WHERE CustomerID = $myID";

	#dumpDie($sql);

	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results

		#out html here
		while ($row = mysqli_fetch_assoc($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
			#$cID        = (int)$row['CustomerID'];
			$cFirstName = dbOut($row['FirstName']);
			$cLastName  = dbOut($row['LastName']);
			$cEmail			= dbOut($row['Email']);

			#dumpDie($cEmail);

			echo '<h3 align="center"> EDIT <small>S2</small></h3>';

			echo '<form action="' . THIS_PAGE . '" act=insert" method="post"onsubmit="return checkForm(this);">
			<table align="center">
				<tr>
				<td align="right">First Name</td>
					 <td>
						 <input type="text" name="FirstName" value="' . $cFirstName . '" />
						 <font color="red"><b>*</b></font> <em>(alphanumerics & punctuation)</em>
					 </td>
				</tr>
				<tr><td align="right">Last Name</td>
					 <td>
						 <input type="text" name="LastName" value="' . $cLastName . '" />
						 <font color="red"><b>*</b></font> <em>(alphanumerics & punctuation)</em>
					 </td>
				</tr>
				<tr><td align="right">Email</td>
					 <td>
						 <input type="text" name="Email" value="' . $cEmail . '" />
						 <font color="red"><b>*</b></font> <em>(valid email only)</em>
					 </td>
				</tr>';
		}
		echo '<input type="hidden" name="CustomerID" value="' . $myID . '" />
			<input type="hidden" name="act" value="execute" />

			<tr>
				 <td align="center" colspan="2">
					 <input type="submit" value="Edit Existing Customer!"><em>(<font color="red"><b>*</b> required field</font>)</em>
				 </td>
			</tr>
		</table>
	</form>
	<div align="center"><a href="' . THIS_PAGE . '">Exit Without Add</a></div>
	';

	}else{//no records
			echo '<div align="center"><h3>Currently No Matching Customer in Database.</h3></div>';
	}


	@mysqli_free_result($result); //free resources
	get_footer();


}

function updateUser(){


	//$FirstName = strip_tags($_POST['FirstName']);
	//$LastName = strip_tags($_POST['LastName']);
	//$Email = strip_tags($_POST['Email']);

	$CustomerID = $_POST['CustomerID'];
	$FirstName = $_POST['FirstName'];
	$LastName = $_POST['LastName'];
	$Email = $_POST['Email'];

	$db = pdo(); # pdo() creates and returns a PDO object


	//build string for SQL insert with replacement vars, ?
	$sql = "UPDATE test_Customers
	SET
		FirstName='$FirstName',
		LastName='$LastName',
		Email='$Email'

	WHERE CustomerID='$CustomerID'";

	$stmt = $db->prepare($sql);
	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);
	$stmt->bindValue(1, $FirstName, PDO::PARAM_STR);
	$stmt->bindValue(2, $LastName, PDO::PARAM_STR);
	$stmt->bindValue(3, $Email, PDO::PARAM_STR);

	try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
	#feedback success or failure of update

	if ($stmt->rowCount() > 0)
	{//success!  provide feedback, chance to change another!
		feedback("Customer Added Successfully!","success");
	}else{//Problem!  Provide feedback!
		feedback("Customer NOT added!","warning");
	}

}
