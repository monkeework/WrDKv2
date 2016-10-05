<?php
function maxDoc_library_timeline(){
	/**
	 * postback application based onadd.php is a single page web application that allows us customer to
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
	}

	# '../' works for a sub-folder.  use './' for the root
	require '../_inc/config_inc.php'; #configuration, pathing, error handling, db credentials

	/*
	$config->metaDescription = 'Web Database ITC281 class website.'; #Fills <meta> tags.
	$config->metaKeywords = 'SCCC,Seattle Central,ITC281,database,mysql,php';
	$config->metaRobots = 'no index, no follow';
	$config->loadhead = ''; #load page specific JS
	$config->banner = ''; #goes inside header
	$config->copyright = ''; #goes inside footer
	$config->sidebar1 = ''; #goes inside left side of page
	$config->sidebar2 = ''; #goes inside right side of page
	$config->nav1["page.php"] = "New Page!"; #add a new page to end of nav1 (viewable this page only)!!
	$config->nav1 = array("page.php"=>"New Page!") + $config->nav1; #add a new page to beginning of nav1 (viewable this page only)!!
*/
}

$pageDeets = '<li> Review/update function checkForm(thisForm)</li>';

require '../_inc/config_inc.php'; #configuration, pathing, error handling, db credentials


$config->metaDescription = 'Marvel Cinematic Universe Timeline (alternative)'; #Fills <meta> tags.
$config->metaKeywords = 'Marvel Super-Heroes, Superheroes, RPG, Roleplay, roleplaying, RP, PBP, PBEM, Avengers, X-Men, Iron Man, Captain America, THor, Ant-Man, Inhumans, Mutants, Black Panther, Defenders, Daredevil, Young Avengers, Fantastic Four';


//END CONFIG AREA ----------------------------------------------------------

# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}

global $config;
get_header();

#dumpDie($_SESSION);

echo MaxNotes($pageDeets); #notes to me!

include 'timeline.css';

echo '
<div class="jumbotron bottom-align">
	<img
		class="pull-right"
		src="../_img/_polygons/polyWatcher00.png" alt="Uatu the watcher"
		style="position: absolute; bottom: 0; right: 50px;"
			 />

	<br/><h2 style="color: white; position: relative; bottom: -15px; text-shadow: 3px 3px 5px rgba(150, 150, 150, 1);;"><br /><br /><br /><br /><br />
	MCU <b> Timeline</b></h2>

</div>';


switch ($myAction)
{//check 'act' for type of process
	case "add":
		chekPrivies(4); #admin+

		echo timelineAdd(); #show my silly assed timeline
		echo get_footer();

		break;
	########################################################
	case "edit":
		chekPrivies(4); #admin+
		echo timelineEdit(); #process event/add to timeline
		echo get_footer();

		break;
	########################################################
	case "insert":
		chekPrivies(4); #admin+
		echo timelineInsert(); #process event/add to timeline

		#myRedirect(THIS_PAGE);

		break;
	########################################################
	case "revise":
		chekPrivies(4); #admin+
		echo timelineRevise(); #process event/add to timeline

		break;
	########################################################
	case "trash":
		chekPrivies(4); #admin+
		echo timelineTrash(); #process event/add to timeline

		break;
	########################################################
	default:
			echo timelineShow(); #show my silly assed timeline
			echo get_footer();
	}

function timelineShow(){//Select Customer
	# SQL statement - PREFIX is optional way to distinguish your app
	$sql = "select

		TimelineID, EntryID, EntryTitle, EntryDate, HandlerID,
		PostID, ThreadID, CharID,
		WeatherID, GameDate,
		EntryDescription, CharTag,
		DateCreated, DateAssigned, LastUpdated

		FROM ma_Timeline";

	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results
		$str ='';

		$str .= '
			<div class="container">
				<ul class="timeline">';

		$num = 0;
		while ($row = mysqli_fetch_assoc($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db

			#build timeline with PDO
			if($num % 2 == 0){
				$str .= '<li>';
			}else{
				$str .= '<li class="timeline-inverted">';
			}

			$str  .= '<div class="timeline-badge">
					<i class="glyphicon glyphicon-check"></i>
				</div>

				<div class="timeline-panel">
					<div class="timeline-heading">

					<h4 class="timeline-title"><a href="#" target="_blank" >' . $row['EntryTitle'] . '</a></h4>

					<p><small class="text-muted"><i class="glyphicon glyphicon-time">
						</i> By ' . (int)$row['HandlerID'] . ' | documented ' . (int)$row['GameDate'] . '</small>
					</p>
				</div>

				<div class="timeline-body">
					<p><strong>ENTRY #' . $row['EntryID'] . ':</strong>


						' . $row['EntryDescription'] . '</p>';


						#if people mentioned, show....
						if(empty($CharTag)){
							$txt = $row['CharTag'];

							#convert comma seperated string to array
							trim($txt);
							$arr = explode(",", $txt);

							$str .= '<p>
								<small class="text-muted"><i class="glyphicon glyphicon-time">
								</i> Featured ';
							$x = 1;
							#process array to links
							foreach($arr AS $char){
								$str .= '<a href="' . VIRTUAL_PATH . 'characters/characters.php?id=' . $char . '" target="_blank"> Char#' . $x++ . '</a>';
							}

							#If user is logged - show edit button
							if(startSession() && isset($_SESSION['UserID'])){

								#add additional cheks
								#if is admin, suepr, owner, developer or is player show edit option.

								$str .= '<br />
								<a class="pull-right" href="' . THIS_PAGE . '?act=edit&event=' . (int)$row['TimelineID'] . '" title="Edit Event">
								<i class="glyphicon glyphicon-edit"></i></a>';
							}

							$str .= '</small></p>';
						}

						$str .= '</div>
					</div>
				</li>';
				$num++;
			}

		$str .= '</ul>
			</div>'; #END Timeline

	}else{//no records
			$str .=  '<div align="center"><h3>What? Where did everything go? Did they have some new big assed universe ending event? Who do they think they are, DC Comics? Seriously... this blows.</h3></div>';
	}

	#If user is logged - show edit button
		#If user is logged - show edit button
	if(startSession() && isset($_SESSION['UserID'])){

		#add additional cheks
		#if is admin, suepr, owner, developer or is player show edit option.

		$str .= '<hr />
		<div align="center">
					<a class="btn btn-primary btn-sm" href="' . THIS_PAGE . '?act=add">add event</a>
				</div>
			</div>
			<hr />';
	}

	return $str;

	@mysqli_free_result($result); //free resources

}

function timelineAdd(){

	# shows details from a single customer, and preloads their first name in a form.
	echo '
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


	echo '
	<h4 align="center">Add Event</h4>

	<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">

		<div class="row hoverHighlight">
			<div class="col-sm-3 text-right text-muted">
				<p class="text-right"><strong>Event Headline: </strong></p>
			</div>
			<div class="col-sm-9">
				<input class="col-sm-9" type="text" name="EntryTitle" placeholder="?" />
			</div>
		</div><!-- END Container -->


		<div class="row hoverHighlight">
			<div class="col-sm-3 text-right text-muted">
				<p class="text-right"><strong>Event Date: </strong></p>
			</div>
			<div class="col-sm-9">
				<input class="col-sm-9" type="text" name="EntryDate" placeholder="0000-00-00 00:00:00"/>
					<font color="red"><b>*</b></font>
			</div>
		</div><!-- END Container -->


		<div class="row hoverHighlight">
			<div class="col-sm-3 text-right text-muted">
				<p class="text-right"><strong>Event Description: </strong></p>
			</div>
			<div class="col-sm-9">
				<textarea
					class="autoExpand col-sm-9" rows="3" data-min-rows="3" placeholder="?"
					name="EntryDescription"" ></textarea>
		</div><!-- END Container -->


		<div class="row hoverHighlight">
			<div class="col-sm-3 text-right text-muted">
				<p class="text-right"><strong>Event Participants: </strong></p>
			</div>
			<div class="col-sm-9">
				<input class="col-sm-9" type="text" name="CharTag"placeholder="?"/>
					<font color="red"><b>*</b></font>
			</div>
		</div><!-- END Container -->


		<input  type="hidden" name="act" value="insert" />
		<div align="center">
			<input
				class="btn btn-primary btn-xs outline" type="submit" value="Add Event">
			&nbsp; &nbsp;
				<a class="btn btn-primary btn-xs outline" href="timeline.php">Exit Event</a>
		</div>

		<br />
	</form>
	';

}

function timelineEdit(){
	#If user is logged - allow edit else send back to timeline
	if(startSession() && isset($_SESSION['UserID']))
	{

		$myTimelineID = ($_GET["event"]);
		# SQL statement - PREFIX is optional way to distinguish your app
		$sql = "select

			TimelineID, EntryID, EntryTitle, EntryDate, HandlerID,
			PostID, ThreadID, CharID,
			WeatherID, GameDate,
			EntryDescription, CharTag,
			DateCreated, DateAssigned, LastUpdated

			FROM ma_Timeline

			WHERE TimelineID = $myTimelineID ;";

		$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

		if (mysqli_num_rows($result) > 0)//at least one record!
		{//show results


		# shows details from a single customer, and preloads their first name in a form.
		echo '
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

		<script src="' . VIRTUAL_PATH . '_ckEditor/ckeditor.js"></script>
		';

			while ($row = mysqli_fetch_assoc($result))
			{//dbOut() function - 'wrapper' to strip slashes, etc. of data leaving db
				$timelineID = dbOut($row['TimelineID']);
				$entryID    = dbOut($row['EntryID']);
				$entryTitle = dbOut($row['EntryTitle']);
				$entryDate  = dbOut($row['EntryDate']);
				$entryDesc  = dbOut($row['EntryDescription']);

				echo '<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">

				<form action="' . THIS_PAGE . '" method="post"
					onsubmit="return checkForm(this);">

					<h3>TimelineID: ' . $timelineID . ' |
							Entry: '      . $entryID . '</h3>

					<div class="row hoverHighlight">
						<div class="col-sm-3 text-right text-muted">
							<p class="text-right"><strong>Event Headline: </strong></p>
						</div>
						<div class="col-sm-9">
							<input class="col-sm-9" type="text" name="EntryTitle"
								value="' . $entryTitle . '"

								placeholder="?" />
						</div>
					</div><!-- END Container -->


					<div class="row hoverHighlight">
						<div class="col-sm-3 text-right text-muted">
							<p class="text-right"><strong>Event Date: </strong></p>
						</div>
						<div class="col-sm-9">
							<input class="col-sm-9" type="text" name="EntryDate"
							value="' . $entryDate . '"

								placeholder="0000-00-00 00:00:00"/>

								<font color="red"><b>*</b></font>
						</div>
					</div><!-- END Container -->
					<div class="row hoverHighlight">
						<div class="col-sm-3 text-right text-muted">
							<p class="text-right"><strong>Event Description: </strong></p>
						</div>


						<div class="col-sm-9">
							<textarea
								class="autoExpand col-sm-9 ckeditor" rows="3" data-min-rows="3"
								placeholder="Auto-Expanding Textarea" name="EntryDescription"" >'
								. $entryDesc . '</textarea>
					</div><!-- END Container -->


					<div class="row hoverHighlight">
						<div class="col-sm-3 text-right text-muted">
							<p class="text-right"><strong>Event Participants: </strong></p>
						</div>
						<div class="col-sm-9">

						<br />
						<br />

							<input class="col-sm-9" type="text" name="CharTag"
								value="' . dbOut($row['CharTag']) . '"

								placeholder="?"/>

								<font color="red"><b>*</b></font>
						</div>

						<br />

					</div><!-- END Container -->

					<input type="hidden" name="TimelineID" value="' . $timelineID . '" />
					<input type="hidden" name="EntryID"    value="' . $entryID . '" />

					<input type="hidden" name="act" value="revise" />

					<div align="center">
						<input

							class="btn btn-primary btn-xs outline"
							type="submit"
							value="Revise Event!">

							&nbsp; &nbsp;

						<a class="btn btn-primary btn-xs outline"
							href="' . THIS_PAGE . '"
							title="Delete Event"
							">Exit Event</a>


							&nbsp; &nbsp;

						<a
							class="pull-right"
							href="'
							. THIS_PAGE . '?act=trash&TimelineID=' . $timelineID
							. '" title="Delete Event">
								<i class="glyphicon glyphicon-trash"></i>
						</a>

							&nbsp; &nbsp;

					</div>
				';
			}

			echo '</form>';

		}else{//no records
				echo '<div align="center">
					<h3>Currently No event found matching this timeline ID.</h3>
				</div>';
		}

		@mysqli_free_result($result); //free resources

	} else { #redirect back to timeline

		myRedirect('index.php');
	}


}

function timelineInsert(){

	$EntryTitle			 		= strip_tags($_POST['EntryTitle']);
	$EntryDate			 		= strip_tags($_POST['EntryDate']);
	$EntryDescription		= strip_tags($_POST['EntryDescription']);
	$CharTag			 			= strip_tags($_POST['CharTag']);

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
		$sql = "INSERT INTO ma_Timeline (
				EntryTitle, EntryDate,
				EntryDescription,
				CharTag
			)
			VALUES ( ?, ?, ?, ? )";

	$stmt = $db->prepare($sql);
	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);
	$stmt->bindValue(1, $EntryTitle,				PDO::PARAM_STR);
	$stmt->bindValue(2, $EntryDate,					PDO::PARAM_STR);
	$stmt->bindValue(3, $EntryDescription,	PDO::PARAM_STR);
	$stmt->bindValue(4, $CharTag,						PDO::PARAM_STR);

	try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
	#feedback success or failure of update

	if ($stmt->rowCount() > 0)
	{//success!  provide feedback, chance to change another!
		feedback("Event Added Successfully To Timeline!","success");
	}else{//Problem!  Provide feedback!
		feedback("Event NOT added!","warning");
	}

	myRedirect(THIS_PAGE);
}


function timelineRevise(){

	#dumpDie($_POST);


	$TimelineID			 		= strip_tags($_POST['TimelineID']);				#int - primaryKey
	$EntryID			 		  = strip_tags($_POST['EntryID']); 					#int
	$EntryTitle			 		= strip_tags($_POST['EntryTitle']); 			#str
	$EntryDate			 		= strip_tags($_POST['EntryDate']);  			#str - entered by user
	$EntryDescription		= $_POST['EntryDescription']; #str
	$CharTag			 			= strip_tags($_POST['CharTag']);          #str of comma sep numbers

	$db = pdo(); # pdo() creates and returns a PDO object

	//build string for SQL insert with replacement vars, ?
	$sql = "UPDATE `ma_Timeline`
		SET
			TimelineID='$TimelineID',
			EntryID='$EntryID',
			EntryTitle='$EntryTitle',
			EntryDate='$EntryDate',
			EntryDescription='$EntryDescription',
			CharTag='$CharTag'

		WHERE `EntryID`='$EntryID'";

	$stmt = $db->prepare($sql);
	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);
	//The Primary Key of the row that we want to update.
	$stmt = $db->prepare($sql);

	$stmt->bindValue(1, $TimelineID, PDO::PARAM_STR);
	$stmt->bindValue(2, $EntryID, PDO::PARAM_STR);
	$stmt->bindValue(3, $EntryTitle, PDO::PARAM_STR);
	$stmt->bindValue(4, $EntryDate, PDO::PARAM_STR);
	$stmt->bindValue(5, $EntryDescription, PDO::PARAM_STR);
	$stmt->bindValue(6, $CharTag, PDO::PARAM_STR);

	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);

	try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
	#feedback success or failure of update

	if ($stmt->rowCount() > 0)
	{//success!  provide feedback, chance to change another!
		feedback("Event Revised Successfully!","success");
	}else{//Problem!  Provide feedback!
		feedback("Event NOT REVISED!","warning");
	}
	myRedirect(THIS_PAGE);
}

function timelineTrash(){
	#dumpDie($_POST);
	$TimelineID			 	= strip_tags($_GET['TimelineID']);				  #int - primaryKey
	#$EntryID			 		  = strip_tags($_POST['EntryID']); 					#int
	#$EntryTitle			 	= strip_tags($_POST['EntryTitle']); 			#str
	#$EntryDate			 		= strip_tags($_POST['EntryDate']);  			#str - entered by user
	#$EntryDescription	= strip_tags($_POST['EntryDescription']); #str
	#$CharTag			 			= strip_tags($_POST['CharTag']);          #str of comma sep numbers

	$db = pdo(); # pdo() creates and returns a PDO object
	#dumpDie($_POST);

	$sql = "DELETE FROM ma_Timeline WHERE `TimelineID` = :TimelineID";

	$stmt = $db->prepare($sql);
	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);
	$stmt->bindValue(':TimelineID', $TimelineID, PDO::PARAM_INT);

	try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
	#feedback success or failure of update

	if ($stmt->rowCount() > 0)
	{//success!  provide feedback, chance to change another!
		feedback("Event Removed Successfully From Timeline!","success");
	}else{//Problem!  Provide feedback!
		feedback("Event Not Trashed!","warning");
	}
	myRedirect(THIS_PAGE);
}
#script for expanding textarea
?>


<script>
	$(document)
		.one('focus.textarea', '.autoExpand', function(){
			var savedValue = this.value;
			this.value = '';
			this.baseScrollHeight = this.scrollHeight;
			this.value = savedValue;
		})

		.on('input.textarea', '.autoExpand', function(){
			var minRows = this.getAttribute('data-min-rows')|0,
				 rows;
			this.rows = minRows;
				console.log(this.scrollHeight , this.baseScrollHeight);
			rows = Math.ceil((this.scrollHeight - this.baseScrollHeight) / 17);
			this.rows = minRows + rows;
		});

</script>
