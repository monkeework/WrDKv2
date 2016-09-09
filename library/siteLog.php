<?php
function maxDoc_library_siteLog(){
	/**
 * based on add_pdo.php, siteLog.php is a single page web application that allows me to document what i am/have done on this site or am working towards
 *
 * Any number of additional steps or processes can be added by adding keywords to the switch
 * statement and identifying a hidden form field in the previous step's form:
 *
 *<code>
 * <input type="hidden" name="act" value="next" />
 *</code>
 *
 * The above code shows the parameter "act" being loaded with the value "next" which would be the
 * unique identifier for the next step of a multi-step process
 *
 *
 * @package ma-v1605-22
 * @author monkeework <monkeework@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.monkeework.com/
 * @license http://www.apche.org/licenses/LICENSE-2.0
 * @todo add more complicated checkbox & radio button examples
 */
}

$pageDeets = '<li> UPGRADE --> noCaptcha</li>
	<li> Review/update function checkForm(thisForm)</li>';

# '../' works for a sub-folder.  use './' for the root
require '../_inc/config_inc.php'; #configuration, pathing, error handling, db credentials

//set access priv needed for this page by member
chekPrivies(0); #vistors+

//END CONFIG AREA ----------------------------------------------------------


global $config;
get_header();

echo getJumbo();


echo MaxNotes($pageDeets); #notes to me!


# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}

switch ($myAction)
{//check 'act' for type of process

	case "add": //2) Form for adding new customer data
		if(startSession() && isset($_SESSION['UserID'])){
			echo addEntry();
		}

		break;

	case "insert": //3) Insert new customer data
		if(startSession() && isset($_SESSION['UserID'])){
			echo insertEntry();
		}

		header("Location: # ");
		break;


	default: //1)Show existing customers

		echo showFeatures();
		echo showEntries();

		echo thanxU();

}


get_footer();


function getJumbo()
{
	$siteName = $_SERVER['SERVER_NAME'];

$deg = rand(-4, -4); #for setting tilt degree of header

	echo '
<style>
	#tilt {
		transform:rotate(' . $deg . 'deg);
		-o-transform:rotate(' . $deg . 'deg);
		-moz-transform:rotate(' . $deg . 'deg);
		-webkit-transform:rotate(' . $deg . 'deg);
	}
</style>

<div class="container">
	<div class="jumbotron" style="background-image:url(../_img/_bgs/bgDeveloper.jpg); background-size: cover; repeat: norepeat;">

		<br /><br /><br /><br />

		<h2 id="tilt" style="
			color: white; text-shadow: 2px 2px 5px #000000;"><strong>' . $siteName . '</strong> Development Log</h2>
		<br />
	</div>
</div>

';
}

function showFeatures($str = '')
{
	$str .= '<div class="container text-center">
		<div class="row ">
			<div class="list-group col-sm-6">

				<a href="#" class="list-group-item" style="background-color: #eee;"><strong style="text-transform: uppercase;">Exisiting Site Features</strong></a>

				<a href="#" class="list-group-item"><span class="badge">v.0.0.1</span> Posting Forum</a>

				<a href="#" class="list-group-item"><span class="badge">v0.0.2</span> Character Creation Form</a>
				<a href="#" class="list-group-item"><span class="badge">v0.0.2</span> Show Tags</a>
				<a href="#" class="list-group-item"><span class="badge">v0.0.2</span> Timeline</a>

				<a href="#" class="list-group-item"><span class="badge">v0.0.3</span> Captcha (Spam Filtering)</a>
				<a href="#" class="list-group-item"><span class="badge">v0.0.3</span> Character Galleries</a>
				<a href="#" class="list-group-item"><span class="badge">v0.0.3</span> Contact Forms</a>
				<a href="#" class="list-group-item"><span class="badge">v0.0.3</span> Image Upload</a>
				<a href="#" class="list-group-item"><span class="badge">v0.0.3</span> Personalized Trait library</a>
				<a href="#" class="list-group-item"><span class="badge">v0.0.3</span> Self-expanding textareas</a>
			</div>


			<div class="list-group col-sm-6">

				<a href="#" class="list-group-item" style="background-color: #eee;"><strong style="text-transform: uppercase;">Features In Development</strong></a>

				<a href="#" class="list-group-item"><span class="badge">TBD</span> Auto-Tagging</a>
				<a href="#" class="list-group-item"><span class="badge">TBD</span> Auto-Trait Selection</a>
				<a href="#" class="list-group-item"><span class="badge">TBD</span> Character Based Emoji</a>

				<a href="#" class="list-group-item"><span class="badge">TBD</span> Chat-2-Post</a>
				<a href="#" class="list-group-item"><span class="badge">TBD</span> Click-2-Edit</a>
				<a href="#" class="list-group-item"><span class="badge">TBD</span> Email Notification</a>
				<a href="#" class="list-group-item"><span class="badge">TBD</span> Contact forms</a>
				<a href="#" class="list-group-item"><span class="badge">TBD</span> Dashboard (Users)</a>
				<a href="#" class="list-group-item"><span class="badge">TBD</span> Dashboard (Admin)</a>
				<a href="#" class="list-group-item"><span class="badge">TBD</span> Dashboard (Developers)</a>
				<a href="#" class="list-group-item"><span class="badge">TBD</span> Glyphicon/font Awesome support</a>
				<a href="#" class="list-group-item"><span class="badge">TBD</span> Full featured text editor</a>
			</div>

		</div>
	</div>
	<br>';

	return $str;

}

function showEntries($str = '')
{//Select Customer

	$sql = "select DevID, img, DevNote, sticky from  ma_DeveloperLog";
	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results

		while ($row = mysqli_fetch_assoc($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
			$str .= '<hr />
			<div class="row">
				<div class="col-sm-1">
					<img style="width: 100%;" src="' . dbOut($row['img']) . '" alt="" />
				</div>
				<div class="col-sm-11 text-left" style="border-left: solid 1px #ddd; padding-left:20px; ">' . dbOut($row['DevNote']) . '</div>
			</div>';
		}

	}else{//no records
		$str .= '<h3>Currently No Entries in Database.</h3>';
	}

	if(startSession() && isset($_SESSION['UserID'])){
		$str .= '<hr />
			<div align="center"><a class="btn btn-primary" href="' . THIS_PAGE . '?act=add">ADD Entry</a></div>
			<br />';
	}


	return $str;
}

function addEntry($str = '')
{# shows details from a single customer, and preloads their first name in a form.

	$str .=  '<h3 align="center">Add Entry</h3>

		<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">

			<p class="text-center">
				<textarea class="col-sm-12"
					name="DevNote"
					placeholder="Add notes here..."></textarea>
			</p>

			<input type="hidden" name="act" value="insert" />



			<p class="text-right">
				<br />
				<input style="class="text-right"" type="submit" value="Add Entry!">
			</p>


		</form>

	<div align="center"><a href="' . THIS_PAGE . '"> cancel entry</a></div>
	';

	return $str;
}

function insertEntry($str = '')
{

	//$FirstName = strip_tags($_POST['FirstName']);
	//$LastName = strip_tags($_POST['LastName']);
	//$Email = strip_tags($_POST['Email']);

	$devNote = $_POST['DevNote'];

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
		$sql = "INSERT INTO ma_DeveloperLog (DevNote) VALUES (?)";

	$stmt = $db->prepare($sql);
	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);
	$stmt->bindValue(1, $devNote, PDO::PARAM_STR);


	try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
	#feedback success or failure of update

	if ($stmt->rowCount() > 0)
	{//success!  provide feedback, chance to change another!
		feedback("Entry Added Successfully!","success");
	}else{//Problem!  Provide feedback!
		feedback("Houston we have a problem. Entry NOT Added!","warning");
	}


}

function thanxU($str = '')
{
	$str .= '<hr />
		<p>Special thanks to the following for all the advice, encouragement, and guidance they have all so freely given me. Thank you to all of you - without you I could never have done half of this:
		<a href="http://andrewwoods.net" target="_blank">Andrew</a>,

		<a href="http://newmanix.com/bill.php" target="_blank">Bill</a>,

		<a href="http://northwestpress.com/about/" target="_blank">Christen "Zan" Christensen</a>,

		Isaac,

		<a href="https://www.linkedin.com/in/dmalouf" target="_blank">David</a>,

		<a href="http://premiumdw.com/" target="_blank">Mike</a>,

		<a href="http://portiaplante.com/" target="_blank">Portia</a>,

		<a href="http://sagegatzke.com/" target="_blank">Sage</a>,

		<a href="http://newmanix.com/sara.php" target="_blank">Sara</a>,

		Tessa,

		Tim Bond,

		SCCC &amp;
		SeaPHP meetup group.</p>';

	return $str;
}
#tha-tha-that's all folks!
