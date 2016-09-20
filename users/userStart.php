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
$twID  		= 1; #userStart textarea ID

$rSQL 		= "SELECT RTEID, AdminID, LastUpdated, RTEText FROM ma_RTE WHERE RTEID = $twID";

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
	//adding...
	case "add": //if admin+
		chekPrivies(4); //known guest or better (no unlogged visitors basically here)
		addContent($uPriv, $rSQL, $twID, $uID);
		break;

	case "insert": //3) insert/revise content
		addCommit($uPriv);
		showContent($uPriv, $rSQL);
		break;


 //for edits
	case "edit": //if admin+
		chekPrivies(4); //known guest or better (no unlogged visitors basically here)
		editContent($uPriv, $rSQL, $twID, $uID);
		break;

	case "commit": //3) insert/revise content

		editCommit($uPriv, $twID, $uID);
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



//BEGIN page functions

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

			echo '<div class="btn btn-outline btn-sm" style="border: solid 1px #ddd;">Updated: ';

			$date=date_create(dbOut($row['LastUpdated']));
			echo date_format($date,"Y/m/d H:i:s");

			#echo dbOut($row['LastUpdated']);
			echo '</div>';
		}

	}else{//no records
			echo '<div align="center"><h3>Placeholder.</h3><p>Content to come</p></div>';
	}

	if($uPriv >= 5){ echo '<a class="btn btn-success btn-sm pull-right" href="' . THIS_PAGE . '?act=edit">Edit Content </a>';}

	#if($uPriv >= 6){ echo '<a class="btn btn-primary btn-sm pull-right" href="' . THIS_PAGE . '?act=add">Add Content </a>';}





	@mysqli_free_result($result); //free resources
}

function addContent($uPriv, $rSQL, $twID, $uID) {# shows details from a single customer, and preloads their first name in a form.
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

			echo '<textarea class="ckeditor" name="rteText">' . dbOut($row['RTEText']) . '</textarea>';

		}
		echo '<div class="push"></div>
			<input type="hidden" name="act" value="insert" />

			<input type="hidden" name="rteID" value="' . $twID . '" />
			<input type="hidden" name="adminID" value="' . $uID . '" />

			<input class="btn btn-primary btn-sm"  type="submit" value="Commit Your Changes">
			<a class="btn btn-warning btn-sm pull-right" href="' . THIS_PAGE . '">Exit Without committing Changes</a>
		</form>
	';
	}

}

function addCommit($uPriv){

/*
dumpDie($_POST);

array (size=4)
	'rteText' => string '<p>GGGGGeneral instructions on what to do/get going to go here</p>

<h5>Suggested Steps</h5>

<ul>
	<li><a href="http://localhost/WrDKv2/users/userPrefs.php">Update your start Page here</a></li>
	<li><del><a href="#">Do You have a character?</a></del></li>
	<li><del><a href="#">Do You Have a character that needs updating?</a></del></li>
	<li><del><a href="#">Do You have any posts to reply to?</a></del></li>
	<li><del><a href="#">Do you have any posts to start?</a></del></li>
	<li><del><a href="#">'... (length=874)
	'act' => string 'insert' (length=6)
	'rteID' => string '1' (length=1)
	'adminID' => string '1' (length=1)
*/


	$rteID 		= strip_tags($_POST['rteID']);   //RTE Instance
	$rteText 	= $_POST['rteText']; //RTE Content
	$adminID 	= strip_tags($_POST['adminID']); //User ID

	$db = pdo(); # pdo() creates and returns a PDO object

	//dumpDie($db);

	//build string for SQL insert with replacement vars, ?
	$sql = "UPDATE `ma_RTE`
		SET
			`RTEID` 				= :RTEID,
			`RTEText` 			= :RTEText
		WHERE `AdminID`   = :AdminID";


	$stmt = $db->prepare($sql);
		//The Primary Key of the row that we want to update.
	 $stmt->bindParam(':RTEID', 		$rteID, 			PDO::PARAM_INT);
	 $stmt->bindValue(':RTEText', 	$rteText, 		PDO::PARAM_STR);
	 $stmt->bindValue(':AdminID', 	$adminID, 		PDO::PARAM_INT);
	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);


//dumpDie($stmt);
/*

	object(PDOStatement)[3]
	public 'queryString' => string 'UPDATE `ma_RTE`
		SET
			`RTEID`  = :RTEID,
			`RTEText`  = :RTEText
		WHERE `AdminID` = :AdminID' (length=104)

*/


	#dumpDie($db->errorInfo());


	try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
	#feedback success or failure of update


	$arr = $stmt->errorInfo();
	print_r($arr);







	if ($stmt->rowCount() > 0)
	{//success!  provide feedback, chance to change another!
		feedback("Content Updated!","success");
	}else{//Problem!  Provide feedback!
		feedback("Content NOT added!","warning");
	}

}


function editContent($uPriv, $rSQL, $twID, $uID) {# shows details from a single customer, and preloads their first name in a form.
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

			echo '<textarea class="ckeditor" name="rteText">' . dbOut($row['RTEText']) . '</textarea>';

		}
		echo '<div class="push"></div>
			<input type="hidden" name="act" value="commit" />

			<input type="hidden" name="rteID" value="' . $twID . '" />
			<input type="hidden" name="adminID" value="' . $uID . '" />

			<input class="btn btn-primary btn-sm"  type="submit" value="Commit Your Changes">
			<a class="btn btn-warning btn-sm pull-right" href="' . THIS_PAGE . '">Exit Without committing Changes</a>
		</form>
	';
	}

}

function editCommit($uPriv, $twID, $uID){

	$rteID = strip_tags($_POST['rteID']);   //textarea id
	$rText = $_POST['rteText']; //the content
	$uID   = strip_tags($_POST['adminID']); //user id


	$db = pdo(); # pdo() creates and returns a PDO object

	//build string for SQL insert with replacement vars, ?
	$sql = "UPDATE ma_RTE
	SET
		AdminID='$uID',
		RTEText='$rText'
	WHERE RTEID='$rteID'";


	$stmt = $db->prepare($sql);
		//The Primary Key of the row that we want to update.
	 $stmt->bindParam(1, 	$uID, 			PDO::PARAM_INT);
	 $stmt->bindValue(2, 	$rText, 		PDO::PARAM_STR);
	 $stmt->bindValue(3, 	$rteID, 		PDO::PARAM_INT);
	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);


	try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
	#feedback success or failure of update


	if ($stmt->rowCount() > 0)
	{//success!  provide feedback, chance to change another!
		feedback("Content Updated!","success");
	}else{//Problem!  Provide feedback!
		feedback("Content NOT added!","warning");
	}

}
