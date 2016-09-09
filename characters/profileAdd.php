<?php
function maxDoc_characters_profileUpdate(){
	/**
 *add_pdo.php is based onadd.php is a single page web application that allows us customer to
 * to add a new an existing table
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

	 # '../' works for a sub-folder.  use './' for the root
}


$pageDeets = '<ol>
	<li> Review/update function checkForm(thisForm)</li>
	<li> Add Resolve Sort/Pager options</li>';


require '../_inc/config_inc.php'; #configuration, pathing, error handling, db credentials


//set access priv needed for this page by member
		chekPrivies(3); #mods+




$config->loadhead = '
	<script type="text/javascript" src="' . VIRTUAL_PATH . '_js/util.js"></script>
		<!-- Edit Required Form Elements via JavaScript Here -->
	<script type="text/javascript">
		//here we make sure the user has entered valid data
		function checkForm(thisForm)
		{//check form data for valid info
			if(empty(thisForm.Name,"Please Enter Your Name")){return false;}
			if(!isEmail(thisForm.Email,"Please enter a valid Email Address")){return false;}
			return true;//if all is passed, submit!
		}
	</script>

	<!-- CSS class for required field elements.  Move to your CSS? (or not) -->
	<style type="text/css">
		.required {font-style:italic;color:#FF0000;font-weight:bold;}
	</style>


	<!-- CSS class for required field elements.  Move to your CSS? (or not) -->
	<style>
		.jumbotron {
		margin: auto;
			//position: center;
			background: #000 url("../_img/_bgs/bgCharactersNew.jpg") center center;
			//width: 50%;
			//height: 100%;
			background-size: cover;
			//overflow: hidden;
			color: white;
		}

		div.container div.jumbotron h1 b, div.jumbotron p {
			color: white;
			text-shadow: 2px 2px 16px #000000;
			text-shadow: 0 0 16px #000000;
		}

		/* Set height of the grid so .sidenav can be 100% (adjust if needed) */
		.row.content {height: 1500px}

		/* On small screens, set height to \'auto\' for sidenav and grid */
		@media screen and (max-width: 767px) {
			.sidenav {
				height: auto;
				padding: 15px;
			}
			.row.content {height: auto;}
		}

		p:first-letter{ text-transform: capitalize; }
	</style>
	';


//END CONFIG AREA ----------------------------------------------------------

# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}

echo MaxNotes($pageDeets); #notes to me!

echo '
<div class="jumbotron">
	<h1 style="margin: 0 0 -35px -35px;"><br /><br /><br /><br />
</div>';

switch ($myAction)
{//check 'act' for type of process
	case "add": //2) Form for adding new customer data
		 addChar();
		 break;

	case "insert": //3) Insert new customer data
		insertChar();
		 showChar();
		break;




	case "update": //3) Insert new customer data
		showChar('update');
		break;

	case "status": //3) Insert new customer data
		showChar('status');
		break;

	case "handler": //3) Insert new customer data
		showChar('handler');
		break;

	case "codename": //3) Insert new customer data
		showChar('codename');
		break;

	case "search": //3) Insert new customer data;
		showChar('search');
		break;


/*
	case "type": //3) Insert new customer data
		showChar('type');
		break;

	case "mutant": //3) Insert new customer data
		showChar('mutant');
		break;

	case "inhuman": //3) Insert new customer data
		showChar('inhuman');
		break;

	case "tech": //3) Insert new customer data
		showChar('tech');
		break;

	case "alien": //3) Insert new customer data
		showChar('alien');
		break;
*/


	default: //1)Show existing customers
		 showChar();
}


function showSearch($str = ''){

	if(isset($_POST['CodeName'])){
		$mySearchTerm = $_POST['CodeName'];
	}else{
		$mySearchTerm = '';
	}

/*
	$str = '<form  method="post" action="' . $mySearchTerm . '?act=search"  id="searchform">
		<input  type="text" name="CodeName" value="'. $mySearchTerm .'" placeholder="Enter codename here">
		<input  type="submit" name="Search" value="Search">
	</form>';
	*/

	$str = '<form method="post" action="' . $mySearchTerm . '?act=search"  id="searchform">
		<div class="input-group">
				<input
					type="text"
					class="form-control"

					name="CodeName"
					value="'. $mySearchTerm .'"

					placeholder="Enter a codename here">

				<span class="input-group-btn">
					<button
						class="btn btn-default"
						type="text">Search!</button>
				</span>
		</div><!-- /input-group -->
		</form>';

	return $str;

}



function showChar($firstSort='', $secondSort='')
{//Select Character
	global $config;
	get_header();
	echo '

	<div class="row">
		<div class="col-sm-3">
			<div class="dropdown">
				<button class="btn btn-default btn-sm dropdown-toggle " type="button"
					data-toggle="dropdown">Sort/Add Characters<span class="caret"></span></button>
					<ul class="dropdown-menu">

						<li><a href="' . THIS_PAGE . '?act=add" class="btn btn-sm" style="color: orange"><b>Add Character</b></a></li>

						<li><a href="' . THIS_PAGE . '?act=status"		class="btn btn-sm">By Status*</a></li>
						<li><a href="' . THIS_PAGE . '?act=handler" 	class="btn btn-sm">By Handler</a></li>
						<li><a href="' . THIS_PAGE . '?act=codename" 	class="btn btn-sm">By Codename</a></li>

						<li><a href="' . THIS_PAGE . '?act=updated" 	class="btn btn-sm">By Last Updated</a></li>


						<!--
						<li><a href="' . THIS_PAGE . '?act=type"			class="btn btn-sm">By Type</a></li>
						<li><a href="' . THIS_PAGE . '?act=mutant"		class="btn btn-sm">By Mutants</a></li>
						<li><a href="' . THIS_PAGE . '?act=inhuman"		class="btn btn-sm">By Inhumans</a></li>
						<li><a href="' . THIS_PAGE . '?act=tech"			class="btn btn-sm">By Hi-Tech Wonders</a></li>
						<li><a href="' . THIS_PAGE . '?act=alien"			class="btn btn-sm">By Aliens</a></li>


						<li><a href="' . THIS_PAGE . '?act=marySue"		class="btn btn-sm">Types 2 Come</a></li>

							<li><a href="' . THIS_PAGE . '?act=marySue" class="btn btn-sm">Type 2 Come</a></li>
							<li><a href="' . THIS_PAGE . '?act=marySue" class="btn btn-sm">Type 2 Come</a></li>
							<li><a href="' . THIS_PAGE . '?act=marySue" class="btn btn-sm">Type 2 Come</a></li>
						-->
				</ul>
			</div>
		</div><!-- /.col-sm-3 -->



		<div class="col-lg-6 pull-right">
			' . showSearch() . '
		</div><!-- /.col-sm-6 -->
	</div><!-- /.row -->

	<div class="clearfix"></div>
	<br /><br />';


// Set sort paremeters
switch ($firstSort) {
	case 'update':
			$firstSort  = ' ';
			$secondSort = ' ORDER by LastUpdated DESC';
			break;

		case 'status':
			$firstSort  = ' ';
			$secondSort = ' ORDER by StatusID DESC';
			break;

	case 'search':
			$firstSort  = ' ';
			$secondSort = ' WHERE CodeName = "' . $_POST['CodeName'] . '"';
			$search = $_POST['CodeName'];
			break;

	case 'handler':
			$firstSort  = ' ORDER by UserID DESC';
			$secondSort = ' ORDER by UserID DESC';
			break;

	case 'codename':
			$firstSort  = ' ';
			$secondSort = ' ORDER by CodeName';
			break;


	default:
			$firstSort  = ' ';
			$secondSort = ' ';
}




$sql = "SELECT UserID, UserName FROM ma_Users $firstSort";
$arrHandlers = []; #creat array to hold handler names and IDs

$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
if (mysqli_num_rows($result) > 0)//at least one record!
{//show results
	while ($row = mysqli_fetch_assoc($result))
	{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
		$arrHandlers[$row['UserID']] = dbOut($row['UserName']);
	}
}

@mysqli_free_result($result); //free resources

	#lets get all the characters....
	$sql = "SELECT CharID, UserID, CodeName, LastName, FirstName, MiddleName, StatusID, LastUpdated FROM ma_Characters $secondSort";

	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results
		echo '<form method="post" action="' . THIS_PAGE . '">
			<table class="table table-striped" >';

			echo '<tr>
				<th>Current Characters</th>
				<th>Current Handler</th>
			</tr>';

			#lets make our checkie boxes...

			while ($row = mysqli_fetch_assoc($result))
			{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db

				#show characters to select for deletion...
				$myCharacterName ='';
				#get character name...
				if(trim(dbOut($row['CodeName'])) != ''){ #codename if set
					$myCharacterName = dbOut($row['CodeName']);
				}else{	#use first/last name
					$myCharacterName = dbOut($row['FirstName']) . ' ' . dbOut($row['LastName']);
				}

				$myTest = dbOut($row['UserID']);
				$myTest = (int)$myTest;
				$myTest = $myTest - 1;

				if($myTest == -1){ $myTest = NULL;}

				if($myTest){ #codename if set



include './../_inc/arrays-inc.php';
/*
	$aarStatusTest = [
		"0"  => "Character Status Not Set", #non standards default setting
		"1"  => 'Wanted', #non standards default setting
		"2"  => 'Open',
		"3"  => 'Hold',
		"4"  => 'Taken',
		"5"  => 'Develop',
		"6"  => 'Submit',
		"7"  => 'Review',
		"8"  => 'Expand (Revsions required)',
		"9"  => 'Approved',
		"10" => 'Locked',
		"11" => 'Injured',
		"12" => 'Retired',
		"13" => 'M.I.A.',
		"14" => 'Dead',
		"15" => 'Clone',
		"16" => 'Unlisted (Invisible to membership)', #is the default setting when needed
		"17" => 'Restricted (Mod Approval needed)', #is the default setting when needed
		"18" => 'Banned'
	];
*/

					#Muted, Primary, Success, Info, Warning, Danger.
					$myHandler = $arrHandlers[$myTest] . ' &mdash; <em class="text-primary">' . $aarStatusTest[dbOut($row['StatusID'])] . '</em>';


				}else{	#use first/last name
					$myHandler = '<i>open</i>';
				}

				$myCharID = (int)$row['CharID']; #get character id

				echo '<tr>
					<td> &nbsp;
						<a href="' . VIRTUAL_PATH . 'characters/profile.php?CodeName=' . $myCharacterName . '&id=' . $myCharID . '&act=show" target="_blank">' . $myCharacterName . '</a>
					</td>

					<td>
						<label>' . $myHandler . '</label>
					</td>
				</tr>
				';

				}
			echo '</table>
		</form>';

	}else{//no records
		echo '<div align="center"><h3>Currently No Characters in Database.</h3></div>';
	}
	#echo '<div class="pull-left"><a href="' . THIS_PAGE . '?act=delete">DELETE CHARACTERS</a></div>';




	@mysqli_free_result($result); //free resources
	get_footer();
}

function addChar()
{# shows details from a single customer, and preloads their first name in a form.
	global $config;
	$config->loadhead .= '
	<script type="text/javascript" src="' . VIRTUAL_PATH . 'include/util.js"></script>
	<script type="text/javascript">
		function checkForm(thisForm)
		{//check form data for valid info
			if(empty(thisForm.CodeName,"Please Enter Character\'s Code Name")){return false;}
			if(empty(thisForm.FirstName,"Please Enter Character\'s First Name")){return false;}
			if(empty(thisForm.LastName,"Please Enter Customer\'s Last Name")){return false;}
			return true;//if all is passed, submit!
		}
	</script>';

	get_header();
	echo '<h3 align="center">Add Character</h3>

	<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">
	<table align="center">
		 <tr><td align="right">Code Name</td>
			 <td>
				 <input type="text" name="CodeName" />
				 <font color="red"><b>*</b></font> <em>(alphanumerics & punctuation)</em>
			 </td>
		</tr>
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
		 <input type="hidden" name="act" value="insert" />
		 <tr>
			 <td align="center" colspan="2">
				 <input type="submit" value="Add Character!"><em>(<font color="red"><b>*</b> required field</font>)</em>
			 </td>
		 </tr>
	</table>
	</form>
	<div align="center"><a href="' . THIS_PAGE . '">Exit Without Add</a></div>
	';
	get_footer();

}

function insertChar()
{


	#	$sql = "SELECT CharID, UserID, CodeName, LastName, FirstName, MiddleName FROM ma_Characters;";

	$CodeName = $_POST['CodeName'];
	$FirstName = $_POST['FirstName'];
	$LastName = $_POST['LastName'];

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
		$sql = "INSERT INTO ma_Characters (CodeName, FirstName, LastName) VALUES (?,?,?)";

	$stmt = $db->prepare($sql);
	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);
	$stmt->bindValue(1, $CodeName, PDO::PARAM_STR);
	$stmt->bindValue(2, $FirstName, PDO::PARAM_STR);
	$stmt->bindValue(3, $LastName, PDO::PARAM_STR);

	try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
	#feedback success or failure of update

	if ($stmt->rowCount() > 0)
	{//success!  provide feedback, chance to change another!
		feedback("Character Added Successfully!","success");
	}else{//Problem!  Provide feedback!
		feedback("Character NOT added!","warning");
	}

}

