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
$uID 	  	= $_SESSION['UserID'];
$uName 		= $_SESSION['UserName'];
$uPriv  	= $_SESSION['Privilege'];
$uStart 	= $_SESSION['uStart']; #startpage
$rID  		= 1; #userStart Rich Content Default ID
$rSQL 		= "SELECT RTEID, AdminID, LastUpdated, RTEText FROM ma_RTE WHERE RTEID = $rID";


chekPrivies(1); //known guest or better (no unlogged visitors basically here)


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
echo '<div class="container-fluid">';
echo bootswatchFeedback();  //feedback on form operations - see bootswatch_functions.php
echo getSidebar($uName, $uID, $uPriv);// see custom-inc.php to edit
echo '<div class="col-sm-9 col-md-10 main">
	<!--toggle sidebar button-->
	<p class="visible-xs">
		<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
	</p>

	<h3> Welcome <a href="' . VIRTUAL_PATH . 'users/dashboard.php">' . $uName . '</a> to your start page</h3>
	';

//SHOW editable content area

if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}

switch ($myAction)
{//check 'act' for type of process
	case "add": //if admin+
		addContent($uPriv, $rSQL);
		break;


	case "insert": //3) insert/revise content
		insertExecute($uPriv, $rSQL);
		showContent($uPriv, $rSQL);
		break;


	default: //1)Show existing content to all
		showContent($uPriv, $rSQL);
	}
	#END Editable Content Area
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





//FUNCTIONS -- we're probably duplicating a lot of functions and might want to review and refactor some up into common page maybe? Address when classifying the site!

function showContent($uPriv, $rSQL){//Select Customer
	global $config;


	$result = mysqli_query(IDB::conn(),$rSQL) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results
		echo '<div>';
		while ($row = mysqli_fetch_assoc($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db

			echo dbOut($row['RTEText']);
			echo '</div>';

			echo '<div>Updated: ';

			$date=date_create(dbOut($row['LastUpdated']));
			echo date_format($date,"Y/m/d H:i:s");

			#echo dbOut($row['LastUpdated']);

		}
		echo '</div>';
	}else{//no records
			echo '<div align="center"><h3>Placeholder.</h3><p>Content to come</p></div>';
	}

	if($uPriv >= 5){ echo '<a class="btn btn-primary btn-sm pull-right" href="' . THIS_PAGE . '?act=add">Revise Content </a>';}

	@mysqli_free_result($result); //free resources
}

function addContent($uPriv, $rSQL) {# shows details from a single customer, and preloads their first name in a form.
	chekPrivies(5); //known guest or better (no unlogged visitors basically here)

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
	</script>
	';


	$result = mysqli_query(IDB::conn(),$rSQL) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results
		echo '<script src="' . VIRTUAL_PATH . '_ckEditor/ckeditor.js"></script>
			<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">';

		while ($row = mysqli_fetch_assoc($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db

			echo '<textarea class="ckeditor" name="editor">' . dbOut($row['RTEText']) . '</textarea>';

		}
		echo '<div class="push"></div>
			<input class="btn btn-primary btn-sm"  type="submit" value="Commit Your Changes">
			<a class="btn btn-warning btn-sm pull-right" href="' . THIS_PAGE . '">Exit Without committing Changes</a>
		</form>
	';
	}

}

function insertExecute(){

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
