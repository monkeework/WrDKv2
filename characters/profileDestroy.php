<?php
function myDocs_ProfileDestroy(){
	/**
	 * profileDestroy.php, based on add.php
	 * single page web application - will destory/purge a character from db.
	 *
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

require '../_inc/config_inc.php'; #configuration, pathing, error handling, db credentials

//set access priv needed for this page by member
		chekPrivies(3); #mods+

//END CONFIG AREA ----------------------------------------------------------

# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}

switch ($myAction)
{//check 'act' for type of process
	/*
	case "add": //2) Form for adding new Character data
		 addForm();
		 break;
	*/

	case "confirm": //3) Insert new Character data
		confirmDelete();

		#echo 'We are in confirm as hoped';
		dumpDie($_POST);

		/*
			http://localhost/git250-16q2/marvel-adventures/characters/profileDestroy.php?act=add
			--- --- ---   ---   --- --- ---
			"DELETE FROM ma_characters
			WHERE CharID = $IDtoDELETE";

			- javascript warning 'are you sure/can't be undone?'

		*/
		break;

	case "delete": //3) Insert new Character data
		#executeDelete();

		echo 'We are in delete as hoped';
		dumpDie($_POST);

		/*
			http://localhost/git250-16q2/marvel-adventures/characters/profileDestroy.php?act=add
			--- --- ---   ---   --- --- ---
			"DELETE FROM ma_characters
			WHERE CharID = $IDtoDELETE";

			- javascript warning 'are you sure/can't be undone?'

		*/

		break;

	default: //1)Show existing Characters
		selectCharacter();
}

function selectCharacter()
{//Select Character
	global $config;
	get_header();
	echo '<h3 align="center">' . smartTitle() . '</h3>
		<p> set some sort orders to ease life some</p>

		<div class="btn-group">
			<button type="button" class="btn btn-primary">By Codename</button>

			<button type="button" class="btn btn-primary">By Sir Name</button>

			<button type="button" class="btn btn-primary">By Team</button>

			<button type="button" class="btn btn-primary">By Type</button>
			<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
				<span class="caret"></span>
			</button>


			<ul class="dropdown-menu" role="menu">
				<li><a href="' . THIS_PAGE . '?act=showType&type=mutant">Mutants</a></li>
				<li><a href="' . THIS_PAGE . '?act=showType&type=tech">Hi Tech Wonders</a></li>
				<li><a href="' . THIS_PAGE . '?act=showType&type=marySue">Mary-Sues</a></li>
			</ul>


		</div>


		<p>
		Be careful on this page, you can nuke a lot of folks with these options - only developer access i think.
		</p>

		<div class="row">
			<div
				class="col-sm-3 postit"
				style="margin: 0 0 20px 0;
							 padding: 10px 20px;
							 background-color: #FFFF66;">
				<h4><b>MaxDO:</b></h4>
				<ol>
					<li> check lev access</li>
					<li> tweak/fix all bootstrap issues</li>
					<li> get sort orders working</li>
					<li> add pager class</li>
					<li> add classes</li>
				</ol>
		</div>

	';


	#lets get all the characters....
	$sql = "
	SELECT CharID, UserID, CodeName, LastName, FirstName, MiddleName
	FROM ma_characters;";

	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results
		echo '<form method="post" action="' . THIS_PAGE . '">
			<table class="table table-striped" >';

			echo '<tr>
				<th>Character To Delete</th>
				<th>Handler</th>
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
				if($myTest){ #codename if set
					$myHandler = $myTest;
				}else{	#use first/last name
					$myHandler = '<i>open</i>';
				}

				echo '<tr>
					<td> &nbsp;
						<input type="checkbox" name="CharID"
							value="' . (int)$row['CharID'] . '"> &nbsp; ' . $myCharacterName . '
						</input>
					</td>

					<td>
						<label>' . $myHandler . '</label>
					</td>
				</tr>
				';

				}
			echo '</table>
			<input type="hidden" name="act" value="confirm" />
			<input class="pull-right" type="submit" name="CharID" value="Delete Selected Character(s)"/>
		</form>';

	}else{//no records
		echo '<div align="center"><h3>Currently No Characters in Database.</h3></div>';
	}
	#echo '<div class="pull-left"><a href="' . THIS_PAGE . '?act=delete">DELETE CHARACTERS</a></div>';


	@mysqli_free_result($result); //free resources
	get_footer();
}

function confirmDelete()
{# shows the characters to be deleted from ma_Characters (This is a permanent delete).
	global $config;

	#$sql = "SELECT UserID, FirstName FROM ma_Users;";

	$sql = "
	SELECT CharID, UserID, CodeName, LastName, FirstName, MiddleName
	FROM ma_characters;";

	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

	get_header();

	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results

		$myCharacterName ='';
		#get name(s) of character(s) to be deleted...
		if(trim(dbOut($row['CodeName'])) != ''){ #codename if set
			$myCharacterName = dbOut($row['CodeName']);
		}else{	#use first/last name
			$myCharacterName = dbOut($row['FirstName']) . ' ' . dbOut($row['LastName']);
		}

		echo $myCharacterName;
		die;


		echo '<form method="post" action="' . THIS_PAGE . '">
			<table class="table table-striped" >';

			echo '<tr>
				<th>Character To Delete</th>
				<th>Handler</th>
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

				echo '<tr>
					<td> &nbsp;
						<input type="checkbox" name="CharID"
							value="' . (int)$row['CharID'] . '"> &nbsp; ' . $myCharacterName . ' has been submitted for deletion.
						</input>
					</td>
				</tr>
				';

				}
			echo '</table>
			<input type="hidden" name="act" value="delete" />
			<input class="pull-right" type="submit" name="CharID" value="Confrim Delete"/>
		</form>';

	}else{//no records
		echo '<div align="center"><h3>No Characters were submitted for deletion.</h3></div>';
	}
	#echo '<div class="pull-left"><a href="' . THIS_PAGE . '?act=delete">DELETE CHARACTERS</a></div>';
	echo '<div align="center"><a href="' . THIS_PAGE . '">Exit Without Add</a></div>
	';

	get_footer();
}

function executeDelete()
{
	#check delete request comes form site, not hack

	if(startSession() && isset($_SESSION['UserID'])){
		$iConn = IDB::conn();//must have DB as variable to pass to mysqli_real_escape() via iformReq()

		$redirect = THIS_PAGE; //global var used for following formReq redirection on failure

		$CodeName  = strip_tags(iformReq('CodeName',$iConn));
		$FirstName = strip_tags(iformReq('FirstName',$iConn));
		$LastName  = strip_tags(iformReq('LastName',$iConn));
		$UserID    = strip_tags(iformReq('UserID',$iConn));

		//next check for specific issues with data
		if(!ctype_print($_POST['CodeName'])|| !ctype_print($_POST['CodeName']))
		{//data must be alphanumeric or punctuation only
			feedback("Codename must contain letters, numbers or punctuation");
			myRedirect(THIS_PAGE);
		}

		if(!ctype_graph($_POST['FirstName'])|| !ctype_graph($_POST['LastName']))
		{//data must be alphanumeric or punctuation only
			feedback("First and Last Name must contain letters, numbers or punctuation");
			myRedirect(THIS_PAGE);
		}

		if(!ctype_digit ($_POST['UserID']))
		{//data must be alphanumeric or punctuation only
			feedback("UserID is not a number :(");
			myRedirect(THIS_PAGE);
		}

		/*
		if(!onlyEmail($_POST['Email']))
		{//data must be alphanumeric or punctuation only
			feedback("Data entered for email is not valid");
			myRedirect(THIS_PAGE);
		}
		*/

		//build string for SQL insert with replacement vars, %s for string, %d for digits

		#Insert into ma_Characters...
		$sql = "INSERT INTO ma_Characters (CodeName, FirstName, LastName, UserID)
		VALUES ( '%s', '%s', '%s', '%s' )";

		# sprintf() allows us to filter (parameterize) form data
		$sql = sprintf( $sql, $CodeName, $FirstName, $LastName, $UserID );

		@mysqli_query($iConn,$sql) or die(trigger_error(mysqli_error($iConn), E_USER_ERROR));
		#feedback success or failure of update
		if (mysqli_affected_rows($iConn) > 0)
		{//success!  provide feedback, chance to change another!
			feedback("Character Added Successfully!","notice");
		}else{//Problem!  Provide feedback!
			feedback("Character NOT added!");
		}
	}


	myRedirect(THIS_PAGE);

}

