<?php
function maxDoc_threads_index(){
	/**
	 * postback application based on add_pdo-update is a single page web application that allows us customer to
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

	# '../' works for a sub-folder.  use './' for the root require '../_inc/config_inc.php'; #configuration, pathing, error handling, db credentials
}

$pageDeets = '<ol>
						<li> Resolve chat box overlap issue</li>
						<li> Resolve Menu Dropdowns not dropping down</li>
						<li> Spin Out Posts to new threads</li>
						<li> Auto-tagging</li>
						<li> Review/update function checkForm(thisForm)</li>

						<!--
							<ul>
								<li> m2 - extended layout?</li>
								<li> m2 - notifications-mail</li>
								<li> m2 - character posting styles</li>
								<li> m2 - dashboard</li>
								<li> m2 - Classes/PDO</li>
								<li> M2 - unapprove/resubmit posts</li>
								<li> m2 - C2E (Click 2 Edit)</li>
								<li> m2 - chat box</li>
								<li> m2 - C2P (Chat to Joint-Post)</li>
								<li> m2 - C2M (Click to Move Thread/Post)</li>
								<li> ???</li>
							</ul>

							<ul>
								<li> m3 - MvC (CodeIngiter)</li>
								<li> M4 - MvC (Laravel)</li>
								<li> ???</li>
							</ul>
						-->';

require '../_inc/config_inc.php'; #configuration, pathing, error handling, db credentials


$config->metaDescription = 'Marvel Cinematic Universe Timeline (alternative)'; #Fills <meta> tags.
$config->metaKeywords = 'Marvel Super-Heroes, Superheroes, RPG, Roleplay, roleplaying, RP, PBP, PBEM, Avengers, X-Men, Iron Man, Captain America, THor, Ant-Man, Inhumans, Mutants, Black Panther, Defenders, Daredevil, Young Avengers, Fantastic Four';
/*
$config->metaRobots = 'no index, no follow';
$config->loadhead = ''; #load page specific JS
$config->banner = ''; #goes inside header
$config->copyright = ''; #goes inside footer
$config->sidebar1 = ''; #goes inside left side of page
$config->sidebar2 = ''; #goes inside right side of page
$config->nav1["page.php"] = "New Page!"; #add a new page to end of nav1 (viewable this page only)!!
$config->nav1 = array("page.php"=>"New Page!") + $config->nav1; #add a new page to beginning of nav1 (viewable this page only)!!
*/

$sqlThreads = "SELECT ThreadID, CatID, PostID, UserID, CharID, ThreadType,
ThreadRating, ThreadApproval, ThreadVisible,
ThreadFrom, ThreadFeaturing, ThreadPhaseOfDay, ThreadTimeOfDay, ThreadWeather, ThreadLocation,
ThreadContent, ThreadTitle, ThreadNotes, ThreadSummary,
ThreadTag, DateLockThread, DatePostThread, DatePullThread, LastEditor,
DateCreated, DateAssigned, LastUpdated FROM ma_Threads;";


$sqlPosts = "SELECT PostID, ThreadID, CatID, UserID, CharID, PostType,
PostApproval, PostRating, PostVisible,
PostFrom, PostFeaturing, PostPhaseOfDay, PostTimeOfDay, PostWeather, PostLocation,
PostContent, PostNotes, PostSummary, PostTags,
DatePostLock, DatePostPost, DatePullPost,
LastEditor, DateCreated, DateAssigned, LastUpdated
FROM ma_Posts;";


$sqlTags = "SELECT CharID AS CharacterID, Codename, FirstName, LastName FROM ma_Characters;";


#For Threads-short
$sql = "SELECT ThreadID, CatID, PostID,
ThreadFeaturing, ThreadType,
ThreadTitle, ThreadNotes, ThreadSummary,
ThreadTag, DatePostThread, DatePullThread,
DateCreated, LastUpdated FROM ma_Threads;";

$sqlCodeNames = "SELECT Codename, CharID FROM ma_characters
WHERE CharID IN (1,2,3,4,7,12);";

$sqlUserNames = "SELECT UserID, FirstName, Privilege FROM ma_Users
WHERE UserID = 1;";


//END CONFIG AREA ----------------------------------------------------------

# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}

global $config;
get_header();

#dumpDie($_SESSION);

include 'threads-css.php';


echo '<div class="jumbotron bottom-align">
		<h2 style="color: White;"><br /><br /><br /><br /><br />
		Recent <b>Threads</b></h2><br />
	</div>';

echo MaxNotes($pageDeets); #notes to me!


echo selectCat();

echo '<br /><br />
	<div class="container-fluid main-container">
		<div class="col-md-3 sidebar" >';

#chatbox
#echo chitChat(); #chatBox function...
echo '<br />';

#recent threads (IC)
echo threadSidebar('IC', $sql); #ic threads...

#threadSidebar(OC)
echo threadSidebar('OOC', $sql); #OOC posts...
echo '</div></div>';
#END sidebar


#BEGIN main content
switch ($myAction)
{//check 'act' for type of process
	case "categoryShow":
		echo categoryShow($sql, $sqlTags); #show all threads in specific category

		break;
	########################################################
		case "categoryAdd":
		echo categoryAdd(); #show all threads in specific category

		break;
	########################################################
	case "categoryInsert":
		echo categoryInsert(); #show all threads in specific category

		break;
	########################################################
	case "categoryEdit":
		echo categoryEdit(); #show all threads in specific category

		break;
	########################################################
	case "categoryRevise":
		echo categoryRevise(); #cetegoryEdit Formhandler

		break;
	########################################################
	case "categoryRemove":
		echo categoryRemove(); #set thread to hidden basically - vM2

		break;
	########################################################
	########################################################
	########################################################
	case "threadShow":
		echo threadShow($tally=8); #show all posts of single thread

		break;
	########################################################
	case "threadAdd":
		echo threadAdd($sql, $sqlTags); #show form to add a thread to catagory/general populace

		break;
	########################################################
	case "threadEdit":
		echo threadEdit($sqlThreads, $sqlTags); #show form to add a thread to catagory/general populace

		break;
	########################################################
	case "threadRevise":
		echo threadRevise($sqlThreads, $sqlTags); #show form to add a thread to catagory/general populace

		break;
	########################################################
	########################################################
	########################################################
	case "postShow":
		echo postShow(); #show single post
		#threadShow($tally=1);

		break;
	########################################################
	case "postAdd":
		echo postAdd(); #show form to add a post to thread

		break;
	########################################################
	case "postInsert":
		echo postInsert();

		break;
	########################################################
	case "postEdit":
		echo postEdit($sqlTags);

		break;
	########################################################
	case "postTrash":
		echo postTrash();

		break;
	########################################################
	default:
		echo threadRecent($sql, $sqlTags);

	}

echo get_footer();

##################   HELPER FUNCTION$   ##################
function formatUrl($str, $sep='-'){ #convert white space to dashes for urls
	$res = strtolower($str);
	$res = preg_replace('/[^[:alnum:]]/', ' ', $res);
	$res = preg_replace('/[[:space:]]+/', $sep, $res);
	return trim($res, $sep);
}

function selectCat($myDropdown=''){
	/**
	 * Create dropdown select for category/team to filter forum
	 *
	 */

	$myDropdown .='<div class="dropdown">
			<button class="btn btn-default dropdown-toggle" type="button"
				data-toggle="dropdown">Select Catagory<span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li><a href="' . THIS_PAGE . '">Most Recent Threads</a></li>';


			$sql = "SELECT CatID, CatSort, CatTitle, CatVisible FROM ma_Categories;";
			$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
			if (mysqli_num_rows($result) > 0)//at least one record!
			{//show results

				#Organize catagories
					$myGroup = $myPeeps = $myOrg = '';

				while ($row = mysqli_fetch_assoc($result))
				{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db

					if(($row['CatSort']) == 'team'){

						#we want them alphanumeric AND to show!

						$catName = $row['CatTitle'];
						$myGroup .= '<li><a href="' . THIS_PAGE . '?act=categoryShow&id=' . (int)$row['CatID'] . '&categoryName=' . $catName . '">' . $catName . '</a></li>';

					} else if(($row['CatSort']) == 'person'){

						$catName = $row['CatTitle'];
						$myPeeps .= '<li><a href="' . THIS_PAGE . '?act=categoryShow&id=' . (int)$row['CatID'] . '&categoryName=' . $catName . '">' . $catName . '</a></li>';;

					}else{

						$catName = $row['CatTitle'];
						$myOrg .= '<li><a href="' . THIS_PAGE . '?act=categoryShow&id=' . (int)$row['CatID'] . '&categoryName=' . $catName . '">' . $catName . '</a></li>';

					}
				}

				#now order them neatly
				if(!empty($myGroup)){
					$myDropdown .= '<li class="divider"></li>
					<li class="dropdown-header">Teams</li>'
					. $myGroup;
				}

				if(!empty($myOrg)){
					$myDropdown .= '<li class="divider"></li>
					<li class="dropdown-header">Organizations</li>'
					. $myOrg;
				}


				if(!empty($myPeeps)){
					$myDropdown .= '<li class="divider"></li>
					<li class="dropdown-header">Individuals</li>'
					. $myPeeps;
				}
			}

			@mysqli_free_result($result); //free resources

			if(startSession() && isset($_SESSION['UserID'])){
				$myDropdown .= '<li class="divider"></li>
				<li class="dropdown-header">Dropdown header 2</li>

				<li><a href="' . THIS_PAGE . '?act=threadAdd" >New Thread</a></li>


				<li class="divider"></li>
				<li class="dropdown-header">Admin Only</li>

				<li><a href="' . THIS_PAGE . '?act=categoryAdd" " >New Category</a></li>';
			}

			$myDropdown .= '</ul>
		</div>';

	return $myDropdown;

}

function chitChat($str=''){
	$str .= '<div class="row ">
			<div class="side-menu">
				<script src="http://www.shoutbox.com/chat/chat.js.php"></script> <script> var chat = new Chat(6065);</script>
			</div>
		</div><!-- End chitChat -->';
	return $str;
};

function threadSidebar($type='', $sql, $str=''){


	$str = '<row>
		<div class="side-menu">
			<nav class="navbar navbar-default" style="background-color: #fff;">
				<ul class="list-unstyled">';
				if($type == 'IC'){
					$str .= '<li style="background-color: orange;">Recently Active IC Threads</li>';
				}else{
					$str .= '<li style="background-color: Skyblue;">Recently Active OC Threads</li>';
				}


				$result = mysqli_query(IDB::conn(), $sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
				if (mysqli_num_rows($result) > 0)//at least one record!
				{//show results
					while ($row = mysqli_fetch_assoc($result))
					{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
						if($type == ($row['ThreadType'])){
							$str .= '<li>
							<a href="' . THIS_PAGE
								. '?act=threadShow&id='
								. (int)$row['ThreadID'] . '" />'
								. $row['ThreadTitle'] . '</a>
						</li>';
						}
					}
				}else{//no records
						$str .= "<li>There are currently no active $type threads. Wierd. We will have to do something about that.</li>";
				}
				@mysqli_free_result($result); //free resources

			$str .= '</ul>
			</nav>
		</div>
	</row>';

	return $str;

}
#extend class - add pager 'getPostsPaged' so we have the option for full thread read and paged read for mobile



function getPolyThumb($charID, $str=''){
	#get character info for tooltip from  ma_Characters
	$sqlTT = "SELECT Codename, Overview, Waiver, Team FROM ma_Characters WHERE CharID = $charID;"; #ToolTip

	$codeName = $overview = $waiver = $team = '';#initialize


	$resultTT = mysqli_query(IDB::conn(),$sqlTT) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

	$dbTT = pdo(); # pdo() creates and returns a PDO object

	#$result stores data object in memory
	try {$resultTT = $dbTT->query($sqlTT);} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}

	if($resultTT->rowCount() > 0)
	{#there are records - present data
		#set values needed for tool tip
		while($rowTT = $resultTT->fetch(PDO::FETCH_ASSOC))
		{# pull data from associative array
			$overview = $rowTT['Overview'];
			$waiver = $rowTT['Waiver'];
			$team = $rowTT['Team'];
			$codeName = $rowTT['Codename'];
		}
	}
	unset($resultTT, $dbTT); #free resources

	#verify Image or use FPO
	#create Image Path
	$filename = '../uploads/c'. $charID . '_thumb.jpg';
	#Verify image exists, show
	if (file_exists($filename)) {
		$filename = $filename;
	}else{
		#no image, use fpo static
		$filename =  '../_img/_static/static---00' . rand(0, 8). '.gif';
	}


	#construct the polyThumb
	$str .= '
		<a href="' . VIRTUAL_PATH . 'characters/profile.php?id=' . $charID . '&act=show"
			target="_blank" data-toggle="tooltip" data-placement="right" title="" data-container="body" class="tooltiplink" data-html="true"
			data-original-title="' . $codeName . ' >> ' . $overview .'"
			>

			<!--- for polygons -->
			<svg class="clip-svg">
				<defs>
					<clipPath id="polygon-clip-hexagon" clipPathUnits="objectBoundingBox">
						<polygon points="0.5 0, 1 0.25, 1 0.75, 0.5 1, 0 0.75, 0 0.25"></polygon>
					</clipPath>
				</defs>
			</svg>

			<div class="polygon-each-img-wrap">
					<img src="' . $filename . '" alt="demo-clip-heptagon" class="polygon-clip-hexagon">
			</div>
		</a>

		<div><p class="text-center"><small><strong>' . $codeName . '</strong></small></p></div>';

	return $str;

}

function getPostTags($postTags, $str = ''){
	#process $postTags into SQL friend list
	$postTags = "'" . str_replace(array("'", ","), array("\\'", "','"), $postTags) . "'";
	#assemble the sql
	$sqlTags = "SELECT Codename, CharID, Overview FROM ma_Characters
	WHERE CharID IN ($postTags);";

	$resultTags = mysqli_query(IDB::conn(), $sqlTags) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

		if (mysqli_num_rows($resultTags) > 0)//at least one record!
		{//show results

			$count = 0;
			$str .= "<p>Tags  &raquo; ";

			while ($row = mysqli_fetch_assoc($resultTags))
			{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
				$myCodeName 			= $row['Codename'];
				$myCharID   			= $row['CharID'];
				$myCharOverivew   = $row['Overview'];

				#add in comma/seperator
				If($count++ >= 1){ $str .= ', ';}

				$str .= '<a href="'
					. VIRTUAL_PATH . 'characters/profile.php?CodeName='
					. $myCodeName . '&id='
					. $myCharID . '&act=show"

					target="_blank" data-toggle="tooltip"
					data-placement="left"

					title=""
					data-container="body"

					class="tooltiplink"
					data-html="true"

					data-original-title="' . nl2br($myCharOverivew)  . '"
					>' . $myCodeName . '</a>';
			}
			$str .= "</p>";
		}

	return $str;

	@mysqli_free_result($resultCharTags);
}

#$str .= getPostsPaged($threadID)
function getPostsPaged($myThreadID, $tally, $str=''){
	/**
	 * Show the most recent posts for a catagory
	 */

	#var_dump($tally);
	$myTally=$tally;

	#pare this down to what is needed once we know what we need
	$sql = "SELECT PostID, ThreadID, CatID, UserID, CharID, PostType,
	 PostApproval, PostRating, PostVisible,
	 PostFrom, PostFeaturing, PostPhaseOfDay, PostWeather, PostLocation,
	 PostContent, PostNotes, PostSummary, PostTags,
	 DatePostLock, DatePostPost, DatePullPost,
	 LastEditor, DateCreated, DateAssigned, LastUpdated
	 FROM ma_Posts
	 WHERE ThreadID = $myThreadID;";

	$sqlTags = "SELECT CharID AS CharacterID, Codename, FirstName, LastName FROM ma_Characters;";

	$str .= '<!-- start general content -->
		<svg class="clip-svg">
			<defs>
				<clipPath id="polygon-clip-hexagon" clipPathUnits="objectBoundingBox">
					<polygon points="0.5 0, 1 0.25, 1 0.75, 0.5 1, 0 0.75, 0 0.25" />
				</clipPath>
			</defs>
		</svg>
		';

		#reference images for pager
		$prev = '<span class="glyphicon glyphicon-step-backward"></span>';
		$next = '<span class="glyphicon glyphicon-step-forward"></span>';

		# Create instance of new 'pager' class


		$myPager = new Pager($myTally,'',$prev,$next,'');
		$sql = $myPager->loadSQL($sql);  #load SQL, add offset

			$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

			if (mysqli_num_rows($result) > 0)//at least one record!
			{//show results

				#total number of posts in a thread
				$postTot   = mysqli_num_rows($result);
				$postCount = 1;

				/*
				if($myPager->showTotal()==1){$itemz = "post";}else{$itemz = "posts";}  //deal with plural
				$str .=  '<div align="center">We have ' . $myPager->showTotal() . ' ' . $itemz . '!</div>';
				*/

				while($row = mysqli_fetch_assoc($result))
				{# process each row


				#config post variables
					$handlerID				= (int)$row['UserID'];
					$threadID 				= (int)$row['ThreadID'];

					$charID						= (int)$row['CharID'];

					#format post id to 4 places
					$postID   				= (int)$row['PostID'];
					$formatPostID  		= str_pad($postID, 4, '0', STR_PAD_LEFT);

					#format time post updated
					$lastUpdate       = date_create($row['LastUpdated']);
					$formatLastUpdate = date_format($lastUpdate, 'Y-m-d H:i:s a');

					$postLocation     = $row['PostLocation'];
					$postWeather      = $row['PostWeather'];

					#get char ids for tags
					$postTags 				= $row['PostTags'];


					#make OOP SEE: http://php.net/manual/en/datetime.settime.php
					$format = 'Y-m-d H:i:s';
					$gameTime = strtotime('2016-09-03 14:55:24');


				$postSummary      = $row['PostSummary'];

				#if category matches selected category show
				if($myThreadID == $threadID){

					$str .=  '<hr />
					<div class="row " style="">
							<div class="col-sm-2">';

					$str .= getPolyThumb($charID) . '</div>'; #gets thumbnail of featured character with detailed tooltip

					$str .= '<div class="col-sm-7" style="background-color: white;">
						<p>'. $row['PostContent'] . '</p>
					</div>

					<div class="col-sm-3 small" >
						<div class="well">
							<p><strong>Message ' . $postCount . '  of ' . $postTot . '
							[<a href="'
								. VIRTUAL_PATH . 'threads/index.php?act=postShow&id='
								. $postCount . '">#'
								. $formatPostID . '</a> ]
						</strong></p>';

						$str .=	getHandlerDetails($handlerID, $postID); #returns a handler detail link

						$str .=	'<p><strong>Updated &raquo; </strong> ' . $formatLastUpdate . '</p>';

						$postCount++;

						$str .= '<p><a href="#">As Continued From Post #1234</a></p>

						<p><strong>Where &raquo; </strong> ' . $postLocation . ' </p>
						<p><strong>Weather &raquo; </strong> ' . $postWeather . ' </p>

						<p><strong>When &raquo; </strong> ' . $gameTime = date($format, $gameTime) . ' </p>';

						$str .= '<p><strong>Summary &raquo; </strong> ' . $postSummary . ' </p>';

						$str .= getPostTags($postTags);

						$str .= '</div>
					</div>
				</div><!-- END post content -->';
				}
			}
			$str .= $myPager->showNAV(); # show paging nav, only if enough records
			}else{#no records
		$str .= "<div align=center>What! No posts?  This is your chance to be the first!!</div>";
		}

	@mysqli_free_result($result); //free resources

	$str .='<a href="' . THIS_PAGE . '?act=postAdd&threadId=' . $myThreadID . '" class="btn btn-primary pull-right">Add Post</a>';

	return $str;
}



function getTagNames($sql, $arrTags=''){
/**
	 * create a key/index array of CharIDs/Names
	*/

	if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}

	#$sql = 'SELECT CharID AS CharacterID, Codename, FirstName, LastName FROM ma_Characters';

	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//make array

		$arrTags[] = 'No Character'; #occupy zero index

		while ($row = mysqli_fetch_assoc($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
										#key
			$arrTags[] = $row['Codename'];

		}
	}
	@mysqli_free_result($result); //free resources

	return $arrTags;
} #END getTags
#make drop down select from array - load preselected options - also in profiles
function makeDropDown($myTitle, $myName, $myArray, $myValue ){

	$myDropdown  = ''; #initialize

	$myDropdown .= '
	<div class="row hoverHighlight">
		<div class="col-sm-3 text-right text-muted">
			<p class="text-right"><strong>' . ucwords($myTitle) . ': </strong></p>
		</div>
		<div class="col-sm-7">
			<div class="form-group">
				<select class="form-control" name="' . $myName . '">';
				#create dropdown list - with option of select= 'selected' if matches db value!
				$count = 0;
				foreach($myArray as $item)
				{ #sometimes you feel like a select
					if($count==$myValue){
						 $myDropdown .= '<option value="'. $count++ .'" selected="selected">'. $item .'</option>';
					}else{
						 #sometimes you don't
						 $myDropdown .= '<option value="'. $count++ .'">'. $item .'</option>';
					}
				}
		return $myDropdown . '</select> </div></div></div><!-- END Container -->';
	}
#get value from the basic radio settings for OCFC and StatusID - also in profiles
function mkRadio( $myTitle, $myName, $myValue, $myChek1, $myChek2, $myDesc1, $myDesc2 ){
	#initialize needed variables
	$str   = $chekd1 = $chekd2 = '';

	if ($myValue == $myChek1) { $chekd1 = "checked='checked'"; }else{$chekd2 = "checked='checked'";}

	$str .= '<div class="row hoverHighlight">
			<div class="col-sm-3 text-right text-muted">
				<p class="text-right">
					<strong>' . ucwords($myTitle) . ': </strong>
				</p>
			</div>
			<div class="col-sm-9">
				<p>';
				$str .= "<label>
					<input type='radio' value='{$myChek1}' name='{$myName}' {$chekd1}> &nbsp; {$myDesc1} &nbsp; &nbsp; </label>
					<input type='radio' value='{$myChek2}' name='{$myName}' {$chekd2}> &nbsp; {$myDesc2} </label>
				</p>
			</div>
		</div>";

	return $str;
}

function getHandlerDetails($hID='', $pID='', $str=''){
	/**
	 * Helper Function
	 * getHandlerDetails returns a link (Handler Name, Handler ID)
	 *
	 * This ultimately will point to handlers user-page.
	 * Handler's user-page will only be accessible by those logged in/approved (not guests).
	 *
	 * The associated view page,view_pager.php is virtually identical toview.php.
	 * The only difference is the pager version links to the list pager version to create a
	 * separate application from the original list/view.
	 *
	 *
	 * @package ma-v1608-04
	 * @author monkeework <monkeework@gmail.com>
	 * @version 0.1.1 1608-04
	 * @link http://www.monkeework.com/
	 * @license http://www.apche.org/licenses/LICENSE-2.0
	 * @seeindex.php?act=threadShow&id=1
	 * @see Pager.php
	 * @todo none
	 */

	$sqlHID = "SELECT UserID, FirstName, Privilege FROM ma_Users WHERE UserID = $hID";

	$resultHID = mysqli_query(IDB::conn(), $sqlHID) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

	$dbHID = pdo(); # pdo() creates and returns a PDO object

	#$result stores data object in memory
	try {$resultHID = $dbHID->query($sqlHID);} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}

	if($resultHID->rowCount() > 0)
	{#there are records - present data
		#set values needed for tool tip
		while($rowHID = $resultHID->fetch(PDO::FETCH_ASSOC))
		{# pull data from associative array
			#Creat user link to user profile page
			$str .= '<p id="handlerID">
				<strong>By &raquo; </strong> <a href="#' . $rowHID['UserID'] . '">' . $rowHID['FirstName'] . '</a><br />
					<a href="' . VIRTUAL_PATH . 'threads/index.php?act=postEdit&postID=' . $pID . '">Edit</a> | <a href="' . VIRTUAL_PATH . 'threads/index.php?act=postTrash&postID=' . $pID . '">Remove</a>
			</p>';
		}
	}else{ #NO Hanlder, return link to edit the post
		$str .= '<p id="handlerID">
				<a href="' . VIRTUAL_PATH . 'threads/index.php?act=postEdit&postID=' . $pID . '">Edit</a> | <a href="' . VIRTUAL_PATH . 'threads/index.php?act=postTrash&postID=' . $pID . '">Remove</a>
			</p>';
	}
	unset($resultHID, $dbHID); #free resources

	return $str;

}



###################   MAIN FUNCTION$   ###################
function categoryShow($sql, $sqlTags, $str=''){
	/**
	 * Show the most recent posts for a catagory
	 */

	$str .= '<!-- start general content -->

	<div class="col-md-9 pull-right">
		<h4><strong>Most Recent Postings...</h4>

		<div class="bs-example">
			<div class="panel-group" id="accordion">';

			#reference images for pager
			$prev = '<span class="glyphicon glyphicon-backward"></span>';
			$next = '<span class="glyphicon glyphicon-forward"></span>';

			# Create instance of new 'pager' class
			$myPager = new Pager(10,'',$prev,$next,'');
			$sql = $myPager->loadSQL($sql);  #load SQL, add offset

			# connection comes first in mysqli (improved) function
			$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
			if (mysqli_num_rows($result) > 0)//at least one record!
			{//show results

				if($myPager->showTotal()==1){$itemz = "thread";}else{$itemz = "threads";}  //deal with plural

				$str .=  '<div align="center">' . $myPager->showTotal() . ' ' . $itemz . ' currently available.</div>';

				while($row = mysqli_fetch_assoc($result))
				{# process each row

					$threadID 		= (int)$row['ThreadID'];
					$catID    		= (int)$row['CatID'];
					#$catTitle 		= $row['CatTitle'];
					$myCatID    	= $_GET['id'];
					$myCatName    = $_GET['categoryName'];

					#if category matches selected category show
					if($catID == $myCatID){

						$str .=  '<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">

								<a data-toggle="collapse" data-parent="#accordion" href="#collapse-' . $threadID . '"> ' . $row['ThreadTitle'] . ' </a>

								<a class="pull-right" href="'. THIS_PAGE . '?act=threadShow&id=' . $threadID . '"> <small>Go To Thread &nbsp;<span class="glyphicon glyphicon-share"></span></small></i></a>
							</h4>
						</div>

						<div id="collapse-' . $threadID . '" class="panel-collapse collapse">
							<div class="panel-body">
								<p>'. $row['ThreadSummary'] . '</p>
								<p>';

								#set ground work for tags
								$threadTag 	= $row['ThreadTag'];
								$arrTags 		= explode(',', $threadTag);
								$arrNames 	= getTagNames($sqlTags);

								#dumpDie($arrTags);

								#if we have tags show them
								if (isset($threadTag)){
									$str .= '<span class="glyphicon glyphicon-tag"></span> ';

									$x = 0;
									$tot = count($arrTags);

									#make links, comma seperated
									foreach($arrTags as $key => $value)
									{
										$str .=  '<a href="../characters/profile.php?CodeName=CodeName&id=' . $value . '&act=show">' . $arrNames[$value] . '</a>, ';
									}
								}

								$str .=  '</p>
								<p><a class="pull-right" href="'. THIS_PAGE . '?act=threadShow&id=' . $threadID . '"      s> <span class="glyphicon glyphicon-share"></span> Go To Thread</i></a></p>
							</div>
						</div>
					</div>';

					}
				}

			@mysqli_free_result($result); //free resources

			$str .= $myPager->showNAV(); # show paging nav, only if enough records



			if(startSession() && isset($_SESSION['UserID'])){
				$str .= '<div class="pull-right">
					<a href="' . THIS_PAGE . '?act=categoryEdit&id=' . $myCatID . '&categoryName=' . formatUrl($myCatName) . '" class="btn btn-info btn-xs pull-right" role="button">Edit Catagory</a>
				</div>';
			}

		}else{#no records
			$str .= "<div align=center>There are currently no active threads for $myCatName. Wierd. We should really do something about that soon.</div>";
		}

	$str .='</div><!-- end accordian -->
	</div>';




	$str .= '</div><!-- END content -->';

	return $str;
}

function categoryAdd($str=''){
	/**
	 * create a new category
	 */

	$str .= '<!-- start general content -->
		<script type="text/javascript" src="' . VIRTUAL_PATH . '_js/util.js"></script>

		<script type="text/javascript">

			function checkForm(thisForm)

			{//check form data for valid info
				if(empty(thisForm.FirstName,"Please Enter Customer\'s First Name")){return false;}
				if(empty(thisForm.LastName,"Please Enter Customer\'s Last Name")){return false;}
				if(!isEmail(thisForm.Email,"Please Enter a Valid Email")){return false;}
				return true;//if all is passed, submit!
			}

		</script>


		<div class="row" style="background-color: #0a0;"><!-- begin content -->
			<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);" >


				<input  type="hidden" name="CatID" />

				<!-- inner container -->
				<div class="class="col-sm-9 pull-right" style="background-color: #aaa;">

					<!-- left container -->
					<div class="col-sm-8 pull-left" style="background-color: #ddd ;">
						<h4 class="text-center">Add New Catagory</b></h4>';




							$str .= '<div class="row ">
								<div class="pull-middle">

									<select class="selectpicker" name="CatSort" required>
										<option value="person" select="select">Group By: Indivual</option>
										<option value="team">Group By: Group/Team</option>
										<option value="organization">Group By: Organization</option>
									</select>


									<select class="selectpicker" name="CatSort" required>
										<option value="individual" select="select">Catagory Type: IC</option>
										<option value="team">Catagory Type: OOC</option>
									</select>

								</div>
							</div><!-- END Container -->

							<div class="row">
								<input
									class="col-sm-12"
									type="text"

									name="CatTitle"
									placeholder="Team/Group/Character Name here"/>
							</div><!-- END Container -->

							<div class="row">
								<textarea
									name="CatDescription"

									class="autoExpand col-sm-12"
									rows="3"
									data-min-rows="3"

									placeholder="Catagroy Description"
									></textarea>
							</div><!-- end container-->


					</div><!-- end inner container -->

				<div class="clearfix">
					<br /><br />
				</div>

				<div
					align="center"
					style="background-color: #a0a;">

					<input  type="hidden" name="act" value="categoryInsert" />
					<input class="btn btn-primary btn-xs outline" type="submit" value="Add Catagory">

					&nbsp; &nbsp;

					<a class="btn btn-primary btn-xs outline" href="' . THIS_PAGE . '">Exit Event</a>
				</div>

			</form>
		</div>

	<!-- END content -->';

	return $str;
}

function categoryInsert($str=''){

	#dumpDie($_POST);
	#PDO Setup needed vars...
	$catID 						= $_POST['CatID'];
	$catSort 					= $_POST['CatSort'];
	$catTitle 				= $_POST['CatTitle'];
	$catType 					= $_POST['CatType'];
	$catDescription 	= $_POST['CatDescription'];

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
		$sql = "INSERT INTO ma_Categories (
				CatID, CatTitle, CatType, CatDescription
			)
			VALUES (
				:CatID,
				:CatTitle,
				:CatType,
				:CatDescription
			)";

	$stmt = $db->prepare($sql);
	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);
	$stmt->bindValue(1, $catID,						PDO::PARAM_STR);
	$stmt->bindValue(2, $catTitle,				PDO::PARAM_STR);
	$stmt->bindValue(3, $catType,					PDO::PARAM_STR);
	$stmt->bindValue(4, $catDescription,	PDO::PARAM_STR);

	try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
	#feedback success or failure of update

	if ($stmt->rowCount() > 0)
	{//success!  provide feedback, chance to change another!
		feedback("Category Added Successfully To Site!","success");
	}else{//Problem!  Provide feedback!
		feedback("Category NOT added!","warning");
	}

	myRedirect(THIS_PAGE);
}

function categoryEdit($str=''){
	#If user is logged - allow edit else send back to timeline
	if(startSession() && isset($_SESSION['UserID']))
	{

		$myCatID = ($_GET["id"]);
		# ADD - DateCreated, DateAssigned, LastUpdated to table
		$sql = "select CatID, CatTitle, CatType, CatSort, CatDescription, CatVisible
			FROM ma_Categories WHERE CatID = $myCatID ;";

		$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

		if (mysqli_num_rows($result) > 0)//at least one record!
		{//show results

		# shows details from a single customer, and preloads their first name in a form.
		$str .= '
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


		$str .= '<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">';

			while ($row = mysqli_fetch_assoc($result))
			{//dbOut() function - 'wrapper' to strip slashes, etc. of data leaving db
				$catID 						= dbOut($row['CatID']);
				$catTitle    			= dbOut($row['CatTitle']);
				$catType 					= dbOut($row['CatType']);
				$catSort  				= dbOut($row['CatSort']);
				$catDescription		= dbOut($row['CatDescription']);
				$catVisible  			= dbOut($row['CatVisible']);

				$str .= '<form action="' . THIS_PAGE . '" method="post"
					onsubmit="return checkForm(this);">

							<input  type="hidden" name="CatID" value="' . $catID . '" />

							<h4 align="center">Edit Catagory (' . $catTitle . ')</h4>

							<!-- inner container -->
							<div class="class="col-sm-9 pull-right" style="background-color: #aaa;">

								<!-- left container -->
								<div class="col-sm-8 pull-left" style="background-color: #ddd ;">

									<div class="row ">
										<div class="pull-middle">

											<select class="selectpicker" name="CatType" required>
												<option value="IC" select="select">Category Type: IC</option>
												<option value="OOC"               >Category Type: OOC</option>
											</select>

											<select class="selectpicker" name="CatSort" required>
												<option value="organization" select="select">Group By: Indivual</option>
												<option value="team"                        >Group By: Group/Team</option>
												<option value="person"                      >Group By: Organization</option>
											</select>

											<select class="selectpicker" name="CatSort" required>
												<option value="0" select="select">Visible: Yes</option>
												<option value="1"                >Visible: No</option>
											</select>

										</div>
									</div><!-- END Container -->

									<div class="row">
										<input
											class="col-sm-12"
											type="text"

											name="CatTitle"
											value="' . $catTitle . '"
											placeholder="Team/Group/Character Name here"/>
									</div><!-- END Container -->

									<div class="row">
										<textarea
											name="CatDescription"

											class="autoExpand col-sm-12"
											rows="3"
											data-min-rows="3"

											placeholder="Catagroy Description"
											>' . $catDescription . '</textarea>
									</div><!-- end container-->

								</div><!-- end inner container -->

							<div class="clearfix">
								<br /><br />
							</div>

							<div
								align="center"
								style="background-color: #a0a;">







								<input  type="hidden" name="act" value="categoryRevise" />







								<input class="btn btn-primary btn-xs outline" type="submit" value="Edit Catagory">

								&nbsp; &nbsp;

								<a class="btn btn-primary btn-xs outline" href="' . THIS_PAGE . '">Exit Event</a>';

								if(startSession() && isset($_SESSION['UserID'])){
									$str .= '&nbsp; &nbsp;

									<!-- set to invisible actually -->
									<a class="btn btn-primary btn-xs outline" href="' . THIS_PAGE . '?act=categoryRemove&id=' . $catID . '&categoryName=' . formatUrl($catTitle) . '">Remove Catagory</a>';
								}

							$str .= '</div>

						</form>';

					}

				}else{//no records
					$str .= '<div align="center">
						<h3>Currently No Events Listed in the Timeline.</h3>
					</div>';
				}

			return $str;

			@mysqli_free_result($result); //free resources

		} else { #redirect back to timeline

			#myRedirect('index.php');
		}
}

function categoryRevise(){


	$CatID 						= strip_tags($_POST['CatID']);
	$CatTitle    			= strip_tags($_POST['CatTitle']);
	$CatType 					= strip_tags($_POST['CatType']);
	$CatSort  				= strip_tags($_POST['CatSort']);
	$CatDescription		= strip_tags($_POST['CatDescription']);
	$CatVisible  			= strip_tags($_POST['CatVisible']);

	$db = pdo(); # pdo() creates and returns a PDO object

	$sql = "UPDATE `ma_Categories`
		SET
			`CatID` 					= :CatID,
			`CatTitle` 				= :CatTitle,
			`CatType` 				= :CatType,
			`CatDescription`  = :CatDescription,
			`CatVisible` 			= :CatVisible

		WHERE `CatID`       = :CatID";

	$stmt = $db->prepare($sql);

	//The Primary Key of the row that we want to update.
	$stmt = $db->prepare($sql);
	$stmt->bindParam(':CatID', 					$CatID, 						PDO::PARAM_INT);
	$stmt->bindValue(':CatTitle',     	$CatTitle, 					PDO::PARAM_INT);

	$stmt->bindValue(':CatType',  			$CatType, 					PDO::PARAM_STR);
	$stmt->bindValue(':CatSort',   			$CatSort, 					PDO::PARAM_STR);
	$stmt->bindValue(':CatDescription', $CatDescription, 		PDO::PARAM_STR);
	$stmt->bindValue(':CatVisible',     $CatVisible, 				PDO::PARAM_STR);
	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);

	try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
	#feedback success or failure of update

	if ($stmt->rowCount() > 0)
	{//success!  provide feedback, chance to change another!
		feedback("Category Revised Successfully!","success");
	}else{//Problem!  Provide feedback!
		feedback("Category NOT REVISED!","warning");
	}
	#myRedirect(THIS_PAGE);

}

function categoryRemove(){
	#If user is logged - allow edit else send back to timeline
	if(startSession() && isset($_SESSION['UserID']))
	{
		$CatID			 	= strip_tags($_GET['id']);	#int - primaryKey

		$db = pdo(); # pdo() creates and returns a PDO object

		$sql = "DELETE FROM ma_Categories WHERE CatID = :CatID";

		$stmt = $db->prepare($sql);
		//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);
		$stmt->bindValue(':CatID', $CatID, PDO::PARAM_INT);

		try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
		#feedback success or failure of update

		if ($stmt->rowCount() > 0)
		{//success!  provide feedback, chance to change another!
			feedback("Category Removed Successfully","success");
		}else{//Problem!  Provide feedback!
			feedback("Category Not Trashed!","warning");
		}
		myRedirect(THIS_PAGE);
	}
	#script for expanding textarea
}





function threadShow($tally, $str=''){
	/**
	 * Show the most recent posts for a catagory
	 */

	$sql = "SELECT ThreadID, CatID, PostID,
		ThreadFeaturing, ThreadType,
		ThreadTitle, ThreadNotes, ThreadSummary,
		ThreadTag, DatePostThread, DatePullThread,
		DateCreated, LastUpdated FROM ma_Threads;";


	$str .= '<!-- start general content -->

	<div class="col-md-9 pull-right">';

	# connection comes first in mysqli (improved) function
	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if (mysqli_num_rows($result) > 0)//at least one record!
	{//show results

		while($row = mysqli_fetch_assoc($result))
		{# process each row
			$myID    = $_GET['id'];
			$threadID = (int)$row['ThreadID'];


			#if category matches selected category show
			if($myID == $threadID){
				$str .=  '<h3 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse-' . $threadID . '"> ' . $row['ThreadTitle'] . ' </a>
					</h3>

					<p>'. $row['ThreadSummary'] . '</p>';

					$threadTag 	= $row['ThreadTag'];

					#######################################################
					#get Codenames of characters tagged

					#get all unique id sets
					$sqlAllTags = "SELECT DISTINCT PostTags FROM ma_Posts WHERE ThreadID = $myID";

					$myStr = '';

					$resultAllTags = mysqli_query(IDB::conn(), $sqlAllTags) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
					if (mysqli_num_rows($resultAllTags) > 0)//at least one record!
					{//show results

						$count = 0;
						$myStr = '';

						#process id sets into string, add duplicates removed
						while ($row = mysqli_fetch_assoc($resultAllTags))
						{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
							$myStr .=  $row['PostTags'] . 'x';
						}

						#remove double commas
						$myStr = str_replace('xx',',', $myStr);
						$myStr = str_replace('x',',', $myStr);

						#remove duplicates
						$myStr = implode(',',array_unique(explode(',', $myStr)));

						#format numbers to row comma quoted delinated row with
						$myStr = "'" . str_replace(array("'", ","), array("\\'", "','"), $myStr) . "'";

						#removing trailing comma and or empty/white space or combos there of.
						$myStr = str_replace(",''",'', $myStr);
					}

					@mysqli_free_result($resultAllTags); //free resources


					$sqlCharTags = "SELECT Codename, CharID, Overview FROM ma_Characters WHERE CharID IN ($myStr) ORDER BY Codename;";

					$postTagsNew = '';

					$resultCharTags = mysqli_query(IDB::conn(), $sqlCharTags) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
					if (mysqli_num_rows($resultCharTags) > 0)//at least one record!
					{//show results

						$count = 0;
						$postTagsNew .= '<p>Featuring: ';

						while ($row = mysqli_fetch_assoc($resultCharTags))
						{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
							$myCodeName 			= $row['Codename'];
							$myCharID   			= $row['CharID'];
							$myCharOverivew   = $row['Overview'];

							#add in comma/seperator
							If($count++ >= 1){ $postTagsNew .= ', ';}

							$postTagsNew .= '<a href="' . VIRTUAL_PATH . 'characters/profile.php?CodeName=' . $myCodeName . '&id=' . $myCharID . '&act=show"

							data-toggle="tooltip" data-placement="right" title="' . $myCharOverivew  . '"

							>' . $myCodeName . '</a>';
						}
					$postTagsNew .= '</p>';
				}

				$str .= $postTagsNew;
				#######################################################


				if(startSession() && isset($_SESSION['UserID'])){
					$str .= '<p><!-- set to invisible actually -->
						<a class="" href="' . THIS_PAGE . '?act=threadRemove&id=' . $myID . '">Remove Thread</a>

						&nbsp; | &nbsp;

						<a class="" href="' . THIS_PAGE . '?act=threadLock&id=' . $myID . '">Lock Thread</a>

						&nbsp; | &nbsp;

						<!-- set to invisible actually -->
						<a class="" href="' . THIS_PAGE . '?act=threadEdit&id=' . $myID . '">Edit Thread</a></p>';
				}

				#FROM HERE
				#now get all the related posts
				$str .= getPostsPaged($threadID, $tally); #get all psots

			}
		}

		@mysqli_free_result($result); //free resources

		}else{#no records
			$str .= "<div align=center>Houston we have problemo</div>";
		}

		#close it all up
		$str .='</div><!-- END content -->';


	#show me the money
	return $str;
}

function threadRecent($sql, $sqlTags, $str=''){
	/**
	 * Show the most recent posts, set pager to 3 for test
	 */

	$str .= '<!-- start general content -->

	<div class="col-md-9 pull-right">

		<div class="bs-example">
			<div class="panel-group" id="accordion">';

			#reference images for pager
			$prev = '<span class="glyphicon glyphicon-backward"></span>';
			$next = '<span class="glyphicon glyphicon-forward"></span>';

			# Create instance of new 'pager' class
			$myPager = new Pager(10,'',$prev,$next,'');
			$sql = $myPager->loadSQL($sql);  #load SQL, add offset

			# connection comes first in mysqli (improved) function
			$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
			if (mysqli_num_rows($result) > 0)//at least one record!
			{//show results


				if($myPager->showTotal()==1){$itemz = "thread";}else{$itemz = "threads";}  //deal with plural

				$str .=  '<div align="center">' . $myPager->showTotal() . ' ' . $itemz . ' currently available.</div>';

				while($row = mysqli_fetch_assoc($result))
				{# process each row

					$threadID = (int)$row['ThreadID'];

					$str .=  '<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse-' . $threadID . '">' . $row['ThreadTitle'] . ' </a>

								<a class="pull-right" href="'. THIS_PAGE . '?act=threadShow&id=' . $threadID . '"> <small>Go To Thread &nbsp;<span class="glyphicon glyphicon-share"></span></small></i></a>
							</h4>
						</div>
						<div id="collapse-' . $threadID . '" class="panel-collapse collapse">
							<div class="panel-body">
								<p>'. $row['ThreadSummary'] . '</p>
								<p>';

								#set ground work for tags
								$threadTag 	= $row['ThreadTag'];
								$arrTags 		= explode(',', $threadTag);
								$arrNames 	= getTagNames($sqlTags);

								#dumpDie($arrTags);

								#if we have tags show them
								if (isset($threadTag)){
									$str .= '<span class="glyphicon glyphicon-tag"></span> ';

									$x = 0;
									$tot = count($arrTags);

									#make links, comma seperated
									foreach($arrTags as $key => $value)
									{
										$str .=  '<a href="../characters/profile.php?CodeName=CodeName&id=' . $value . '&act=show">' . $arrNames[$value] . '</a>, ';
									}
								}

								$str .=  '<a class="pull-right" href="'. THIS_PAGE . '?act=threadShow&id=' . $threadID . '"> <span class="glyphicon glyphicon-share"></span> Go To Thread</i></a></p>
							</div>
						</div>
					</div>';
				}

				@mysqli_free_result($result); //free resources

				$str .= $myPager->showNAV(); # show paging nav, only if enough records

				}else{#no records
					$str .= "<div align=center>There are currently no posts. Wierd.</div>";
				}

			$str .='</div><!-- end accordian -->
			</div>';


			if(startSession() && isset($_SESSION['UserID'])){
				$str .='<p> <a href="' . THIS_PAGE . '?act=threadAdd" class="btn btn-primary btn-xs pull-right">Add New Thread</a></p>';
			}

			$str .='</div> <!-- END content -->';

	return $str;
}

function threadAdd($sql, $sqlTags, $str=''){
	/**
	 * create a new thread:D
	 */
	$threadId 				= '';
	$threadTitle    	= 'N2G Thread Title';
	#$postPhaseOfDay 	= $_POST['PostPhaseOfDay']
	$postPhaseOfDay 	= 'N2G Post/ThreadPhaseOfDay';
	$postTimeOfDay 		= 'N2G Post/ThreadTimeOfDay'; #addd min 67 seconds to it...

	$postLocation 		= 'N2G PostLocation';
	$postWeather 			= 'N2G postWeather'; #addd min 67 seconds to it...
	$postWhen 				= 'N2G postWhen'; #addd min 67 seconds to it...



	$str .= '<!-- start general content -->
		<script type="text/javascript" src="' . VIRTUAL_PATH . '_js/util.js"></script>

		<script type="text/javascript">

			function checkForm(thisForm)

			{//check form data for valid info
				if(empty(thisForm.FirstName,"Please Enter Customer\'s First Name")){return false;}
				if(empty(thisForm.LastName,"Please Enter Customer\'s Last Name")){return false;}
				if(!isEmail(thisForm.Email,"Please Enter a Valid Email")){return false;}
				return true;//if all is passed, submit!
			}

		</script>


		<div class="row" style="background-color: #0a0;"><!-- begin content -->
			<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);" >


				<input  type="hidden" name="ThreadID" />

				<!-- inner container -->
				<div class="class="col-sm-9 pull-right" style="background-color: #aaa;">

					<!-- left container -->
					<div class="col-sm-6 pull-left" style="background-color: #ddd ;">
						<h4 class="text-center">Add Post to <b>' . $threadTitle .  '</b></h4>';

							#Pulldown-Post-Type
							#function also used in profiles
							#echo makeDropDown('postType', 'PostType', 'xxx', $PostType);

							#Pulldown-Post-As
							#function also used in profiles
							#echo makeDropDown('postType', 'PostType', 'xxx', $PostType);

							#Pulldown-select character emoji:
							#function also used in profiles
							#echo mkRadio('character type', 'OCFC', $OCFC, 'FC', 'OC', 'Featured Character (FC)', 'Original Character (OC)');


							$str .= '<div class="row">
								<div class="pull-middle">

									<select class="selectpicker">
										<option>Thread Type</option>
										<option>IC</option>
										<option>OOC</option>
										<option>Guidance</option>
										<option>Journal</option>
										<option>Timeline</option>
									</select>

									&nbsp; &nbsp;

									<select class="selectpicker">
										<option>Rating</option>
										<option>IC</option>
										<option>OOC</option>
										<option>Guidance</option>
										<option>Journal</option>
										<option>Timeline</option>
									</select>

									&nbsp; &nbsp;

									<select class="selectpicker">
										<option>Weather</option>
										<option>Image A</option>
										<option>Image B</option>
										<option>Image C</option>
										<option>Image D</option>
										<option>Image E</option>
									</select>

									<br /><br />

								</div>
							</div><!-- END Container -->


							<div class="row">
								<input
									class="col-sm-12"
									type="text"

									name="ThreadTitle"
									placeholder="Thread Title..."/>
							</div><!-- END Container -->


							<div class="row">
								<textarea
									name="ThreadContent"
									id="text"

									class="autoExpand col-sm-12"
									rows="3"
									data-min-rows="3"

									placeholder="Please Summarize your Post here in 140 characters or less..."
									></textarea>

									<div id="result">
										Total Characters(including trails): <span id="totalChars">0</span><br/>
									</div>

							</div><!-- END Container -->

							<div class="row">
								<textarea
									name="ThreadSummary"
									id="text"

									class="autoExpand col-sm-12"
									rows="3"
									data-min-rows="3"

									placeholder="Please Summarize the thread Scene Set here in 140 characters or less..."
									></textarea>

									<div id="result">
										Total Characters(including trails): <span id="totalChars">0</span><br/>
									</div>

							</div><!-- END Container -->









						<!--

							<div class="row">
							<p>show if notes exist, show if mod or player AND notes exist</p>
								<textarea
									name="PostNotes"

									class="autoExpand col-sm-12"
									rows="3"
									data-min-rows="3"

									placeholder="Moderator Notes here..." ></textarea>
							</div>



						-->
							<!-- END Container -->

						</div>
<!-- END left container -->
<!-- Right container -->


						<div class="col-sm-2 pull-right" style="background-color: #0aa;">

							<h4 class="text-center">Post Details</h4>

							<div class="row">
								<input
									class=""
									type="text"

									name="PostPhaseOfDay"
									value="' . $postPhaseOfDay . '"
									placeholder="?"/>


								<input
									class=""
									type="text"

									name="PostTimeOfDay"
									value="' . $postTimeOfDay . '"
									placeholder="0000-00-00 00:00:00"/>
							</div><!-- end container-->


							<div class="row">
								<select class="selectpicker">
									<option>Post Rating</option>
									<option>IC</option>
									<option>OOC</option>
									<option>Guidance</option>
									<option>Journal</option>
									<option>Timeline</option>
								</select>
							</div>

							<div class="row">
								<select class="selectpicker">
									<option>Weather</option>
									<option>IC</option>
									<option>OOC</option>
									<option>Guidance</option>
									<option>Journal</option>
									<option>Timeline</option>
								</select>
							</div>


							<div class="row">
								<input
									class=""
									type="text"

									name="PostLocation"
									value="' . $postLocation . '"
									placeholder="Where?"/>
							</div><!-- end container-->


							<div class="row">
								<input
									class=""
									type="text"

									name="PostTimeOfDay"
									value="' . $postWhen . '"
									placeholder="When?"/>
							</div><!-- end container-->



							<div class="row">
								<textarea
									name="PostNotes"

									class="autoExpand col-sm-12"
									rows="3"
									data-min-rows="3"

									placeholder="OOC Notes? "
									></textarea>
							</div><!-- end container-->


								<!-- auto fill needed -->
							<div class="row">
								<input
									class=""
									type="text"

									name="PostTags"
									placeholder="Tags? Get from reply"/>
							</div><!-- end container-->


						</div><!-- end right container -->
					</div><!-- end inner container -->

				<div class="clearfix">
					<br /><br />
				</div>

				<div
					align="center"
					style="background-color: #a0a;">

					<input  type="hidden" name="act" value="insertThread" />
					<input class="btn btn-primary btn-xs outline" type="submit" value="Add Post">

					&nbsp; &nbsp;

					<a class="btn btn-primary btn-xs outline" href="' . VIRTUAL_PATH . '">Exit Event</a>
				</div>

			</form>
		</div>

	<!-- END content -->';

	return $str;
}

#function threadClone($sql, $sqlTags, $str=''){  TODO  }

function threadEdit($sqlThreads, $sqlTags, $str=''){
	#If user is logged - allow edit else send back to timeline
	if(startSession() && isset($_SESSION['UserID']))
	{

		$myThreadID = ($_GET["id"]);

		$sqlThreads = "SELECT ThreadID, CatID, PostID, UserID, CharID,
			ThreadType, ThreadRating, ThreadApproval,
			ThreadVisible, ThreadFrom, ThreadFeaturing,
			ThreadPhaseOfDay, ThreadTimeOfDay,
			ThreadWeather, ThreadLocation,
			ThreadContent, ThreadTitle, ThreadNotes, ThreadSummary,
			ThreadTag,
			DateLockThread, DatePostThread, DatePullThread, LastEditor,
			DateCreated, DateAssigned, LastUpdated FROM ma_Threads
			WHERE ThreadID = $myThreadID;";


		$result = mysqli_query(IDB::conn(),$sqlThreads) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
		#dumpDie($result);          #hmmmmmm

		if (mysqli_num_rows($result) > 0)//at least one record!
		{//show results

			# shows details from a single customer, and preloads their first name in a form.
			$str .= '<script type="text/javascript" src="' . VIRTUAL_PATH . 'include/util.js"></script>

			<script type="text/javascript">

				function checkForm(thisForm)

				{//check form data for valid info
					if(empty(thisForm.FirstName,"Please Enter Customer\'s First Name")){return false;}
					if(empty(thisForm.LastName,"Please Enter Customer\'s Last Name")){return false;}
					if(!isEmail(thisForm.Email,"Please Enter a Valid Email")){return false;}
					return true;//if all is passed, submit!
				}

			</script>';


			$str .= '<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">';


				while ($row = mysqli_fetch_assoc($result))
				{//dbOut() function - 'wrapper' to strip slashes, etc. of data leaving db
					$threadId 				= dbOut($row['ThreadID']);

					$threadType    		= dbOut($row['ThreadType']);
					$threadRating    	= dbOut($row['ThreadRating']);
					$threadWeather    = dbOut($row['ThreadWeather']);

					$threadTitle    	= dbOut($row['ThreadTitle']);
					$threadContent 		= dbOut($row['ThreadContent']); #addd min 67 seconds to it...
					$threadSummary    = dbOut($row['ThreadSummary']);

					$threadPhaseOfDay = dbOut($row['ThreadPhaseOfDay']);
					$threadTimeOfDay 	= dbOut($row['ThreadTimeOfDay']); #addd min 67 seconds to it...

					$threadLocation 	= dbOut($row['ThreadLocation']);
					$threadWeather 		= dbOut($row['ThreadWeather']); #addd min 67 seconds to it...
					$threadNotes 			= dbOut($row['ThreadNotes']); #addd min 67 seconds to it...

					$threadTag 			= dbOut($row['ThreadTag']); #addd min 67 seconds to it...

					$threadWhen = 'tbs'; #to - be - set



					$str .= '<form action="' . THIS_PAGE . '" method="post"
						onsubmit="return checkForm(this);">

					<input  type="hidden" name="ThreadID" value="' . $threadId . '" />


					<!-- inner container -->
					<div class="class="col-sm-9 pull-right" style="background-color: #aaa;">

						<!-- left container -->
						<div class="col-sm-6 pull-left" style="background-color: #ddd ;">
							<h4 class="text-center">Edit <b>' . $threadTitle .  '</b></h4>

							<div class="row">
									<input
										class="col-sm-12"
										type="text"

										name="ThreadTitle"
										value="' . $threadTitle . '"
										placeholder="Thread Title..."/>
								</div><!-- END Container -->

								<div class="row">
									<textarea
										name="ThreadContent"
										id="text"

										class="autoExpand col-sm-12"
										rows="3"
										data-min-rows="3"

										placeholder="The first post or post details or something?"
										>' . $threadContent . '</textarea>

										<div id="result">
											Total Characters(including trails): <span id="totalChars">0</span><br/>
										</div>

								</div><!-- END Container -->

								<div class="row">
									<textarea
										name="ThreadSummary"
										id="text"

										class="autoExpand col-sm-12"
										rows="3"
										data-min-rows="3"

										placeholder="Please Summarize your Post here in 140 characters or less..."
										>' . $threadSummary . '</textarea>

										<div id="result">
											Total Characters(including trails): <span id="totalChars">0</span><br/>
										</div>

								</div><!-- END Container -->

								<!-- <div class="row">
								<p>show if notes exist, show if mod or player AND notes exist</p>
									<textarea
										name="PostNotes"

										class="autoExpand col-sm-12"
										rows="3"
										data-min-rows="3"

										placeholder="Moderator Notes funciton to come..." ></textarea>
									-->
								</div>
							<!-- END Container -->
						</div>
<!-- END left container -->
<!-- Right container -->

						<div class="col-sm-2 pull-right" style="background-color: #0aa;">
							<h4 class="text-center">Thread Details</h4>

							<div class="row">
									<select class="selectpicker" name="ThreadPhaseOfDay" value="' . $threadPhaseOfDay . '">';
										$myArray = ['Pre-Dawn','Early Morning','Morning','Midday','Early Afternoon','Afternoon','Early Evening','Evening','Midnight','Late Night'];
										#create dropdown list - with option of select= 'selected' if matches db value!
										$count = 0;

										foreach($myArray as $item)
										{ #sometimes you feel like a select
											if($item == $threadPhaseOfDay){
												 $str .= '<option value="'. $count++ .'" selected="selected">'. $item .'</option>';
											}else{
												 #sometimes you don't
												 $str .= '<option value="'. $count++ .'">'. $item .'</option>';
											}
										}
									$str .= '</select>
							</div><!-- end container-->

							<div class="row">
								<input
									class=""
									type="text"

									name="ThreadTimeOfDay"
									value="' . $threadTimeOfDay . '"
									placeholder="0000-00-00 00:00:00"/>
							</div><!-- end container-->

							<div class="row">
								<select class="selectpicker" name="CatID" value="">
									<option>Team - f2c </option>
									<option>Person - f2c </option>
									<option>Organization - f2c </option>
								</select>
							</div><!-- end container-->

							<div class="row">
									<select class="selectpicker" name="ThreadType" value="' . $threadType . '">';
										$myArray = ['IC',
																'OOC',
																'Announcement',
																'Guidance',
																'Journal',
																'Timeline'];
										#create dropdown list - with option of select= 'selected' if matches db value!
										$count = 0;

										foreach($myArray as $item)
										{ #sometimes you feel like a select
											if($item==$threadType){
												 $str .= '<option value="'. $count++ .'" selected="selected">'. $item .'</option>';
											}else{
												 #sometimes you don't
												 $str .= '<option value="'. $count++ .'">'. $item .'</option>';
											}
										}
									$str .= '</select>
							</div><!-- end container-->


							<div class="row">
									<select class="selectpicker" name="ThreadRating" value="' . $threadRating . '">';

										$myArray = ['G - General Audiences PG',
																'PG - Strong language used PG-13',
																'PG-13 - Strong violence or language used',
																'R - Restricted: Strong sexual or violent situations described',
																'NC-17 - Explicit Sexual/Graphic situations described',
																'X - Hee, hee, hee!'];
										#create dropdown list - with option of select= 'selected' if matches db value!
										$count = 0;

										foreach($myArray as $item)
										{ #sometimes you feel like a select
											if($item==$threadRating){
												 $str .= '<option value="'. $count++ .'" selected="selected">'. $item .'</option>';
											}else{
												 #sometimes you don't
												 $str .= '<option value="'. $count++ .'">'. $item .'</option>';
											}
										}

									$str .= '</select>
							</div><!-- end container-->


							<div class="row">
									<select class="selectpicker" name="ThreadWeather" value="' . $threadWeather . '">';

									$myArray = ['GOOD - Clear',
															'FAIR - Partly',
															'Overcast/Cloudy',
															'FAIR - Overcast/Cloudy',
															'MILD - Cloudy, Occasional Drizzle',
															'OVERCAST - Overcast OVERCAST - Partly Foggy',
															'OVERCAST - Foggy',
															'STORMY - Drizzle',
															'STORMY - Rain',
															'STORMY - Thunder & Lightning',
															'STORMY - Snow',
															'STORMY - Icestorm',
															'HAZARDOUS - Blizzard',
															'HAZARDOUS - Hurricane',
															'HAZARDOUS - Partial Eclipse',
															'HAZARDOUS - Full Eclipse'];
									#create dropdown list - with option of select= 'selected' if matches db value!
									$count = 0;

									foreach($myArray as $item)
									{ #sometimes you feel like a select
										if($item==$threadWeather){
											 $str .= '<option value="'. $count++ .'" selected="selected">'. $item .'</option>';
										}else{
											 #sometimes you don't
											 $str .= '<option value="'. $count++ .'">'. $item .'</option>';
										}
									}

								$str .= '</select>
							</div>


							<div class="row">
								<input
									class=""
									type="text"

									name="ThreadLocation"
									value="' . $threadLocation . '"
									placeholder="Where?"/>
							</div><!-- end container-->


							<div class="row">
								<input
									class=""
									type="text"

									name="ThreadTimeOfDay"
									value="' . $threadTimeOfDay . '"
									placeholder="When?"/>
							</div><!-- end container-->



							<div class="row">
								<textarea
									name="ThreadNotes"

									class="autoExpand col-sm-12"
									rows="3"
									data-min-rows="3"

									placeholder="OOC Notes? "
									>' . $threadNotes . '</textarea>
							</div><!-- end container-->


								<!-- auto fill needed -->
							<div class="row">
								<input
									class=""
									type="text"

									name="ThreadTag"
									value="' . $threadTag . '"
									placeholder="Tags? Get from reply"/>
							</div><!-- end container-->


						</div><!-- end right container -->
					</div><!-- end inner container -->

				<div class="clearfix">
					<br /><br />
				</div>

				<div
					align="center"
					style="background-color: #a0a;">

					<input  type="hidden" name="act" value="threadRevise" />
					<input  type="hidden" name="ThreadID" value="' . $myThreadID . '" />

					<input class="btn btn-primary btn-xs outline" type="submit" value="Edit Thread">

					&nbsp; &nbsp; ';

					if(startSession() && isset($_SESSION['UserID'])){
						$str .= '<!-- set to invisible actually -->
						<a class="btn btn-primary btn-xs outline" href="' . THIS_PAGE . '?act=threadRemove&id=' . $threadId . '&threadName=' . formatUrl($threadTitle) . '">Remove Thread</a> &nbsp; &nbsp; ';
					}

					$str .= '<a class="btn btn-primary btn-xs outline" href="' . VIRTUAL_PATH . '">Exit Event</a>
				</div>

			</form>
		</div>

	<!-- END content -->';

					}

				}else{//no records
					$str .= '<div align="center">
						<h3>Currently No Events Listed in the Timeline.</h3>
					</div>';
				}

			return $str;

			@mysqli_free_result($result); //free resources

		} else { #redirect back to timeline

			myRedirect('index.php');
		}
}

function threadRevise($sqlThreads, $sqlTags, $str=''){

	#echo 'thread revise';
	#dumpDie($_POST);

	#If user is logged - allow edit else send back to timeline
	if(startSession() && isset($_SESSION['UserID']))
	{
		#get thread id to delete - we want this ultimatelyt to be a post

		$threadID   				= strip_tags($_POST['ThreadID']);					#chk
		$catID    					= strip_tags($_POST['CatID']);						#chk
		$threadType    			= strip_tags($_POST['ThreadType']);				#chk
		$threadRating   		= strip_tags($_POST['ThreadRating']);			#chk
		$threadPhaseOfDay   = strip_tags($_POST['ThreadPhaseOfDay']);	#chk
		$threadTimeOfDay   	= strip_tags($_POST['ThreadTimeOfDay']);	#chk
		$threadWeather    	= strip_tags($_POST['ThreadWeather']);		#chk
		$threadLocation   	= strip_tags($_POST['ThreadLocation']);		#chk
		$threadContent    	= strip_tags($_POST['ThreadContent']);		#chk
		$threadTitle    		= strip_tags($_POST['ThreadTitle']);			#chk
		$threadNotes    		= strip_tags($_POST['ThreadNotes']);			#chk
		$threadSummary    	= strip_tags($_POST['ThreadSummary']);		#chk
		$threadTag    			= strip_tags($_POST['ThreadTag']);				#chk



/*
	Full Set
		$threadID   				= strip_tags($_POST['ThreadID']);					#chk
		$catID    					= strip_tags($_POST['CatID']);						#chk
		#$postID    				= strip_tags($_POST['PostID']);
		#$userID    				= strip_tags($_POST['UserID']);
		#$charID   					= strip_tags($_POST['CharID']);
		$threadType    			= strip_tags($_POST['ThreadType']);				#chk
		$threadRating   		= strip_tags($_POST['ThreadRating']);			#chk
		$threadApproval 		= strip_tags($_POST['ThreadApproval']);
		$threadVisible  		= strip_tags($_POST['ThreadVisible']);
		$threadFrom    			= strip_tags($_POST['ThreadFrom']);
		$threadFeaturing   	= strip_tags($_POST['ThreadFeaturing']);
		$threadPhaseOfDay   = strip_tags($_POST['ThreadPhaseOfDay']);	#chk
		$threadTimeOfDay   	= strip_tags($_POST['ThreadTimeOfDay']);	#chk
		$threadWeather    	= strip_tags($_POST['ThreadWeather']);		#chk
		$threadLocation   	= strip_tags($_POST['ThreadLocation']);		#chk
		$threadContent    	= strip_tags($_POST['ThreadContent']);		#chk
		$threadTitle    		= strip_tags($_POST['ThreadTitle']);			#chk
		$threadNotes    		= strip_tags($_POST['ThreadNotes']);			#chk
		$threadSummary    	= strip_tags($_POST['ThreadSummary']);		#chk
		$threadTag    			= strip_tags($_POST['ThreadTag']);				#chk
		$dateLockThread    	= strip_tags($_POST['DateLockThread']);
		$datePostThread    	= strip_tags($_POST['DatePostThread']);
		$datePullThread    	= strip_tags($_POST['DatePullThread']);
		$lastEditor    			= strip_tags($_POST['LastEditor']);
		$dateCreated   			= strip_tags($_POST['DateCreated']);
		$dateAssigned  			= strip_tags($_POST['DateAssigned']);
		$lastUpdated   			= strip_tags($_POST['LastUpdated']);
*/


		$db = pdo(); # pdo() creates and returns a PDO object
				#`ThreadID` = :ThreadID, #MOVED OUT OF SET
		$sql = "UPDATE `ma_Threads`
			SET

				`CatID`							= :CatID,
				`ThreadType`				= :ThreadType,
				`ThreadRating`			= :ThreadRating,
				`ThreadPhaseOfDay`	= :ThreadPhaseOfDay,
				`ThreadTimeOfDay`		= :ThreadTimeOfDay,
				`ThreadWeather`			= :ThreadWeather,
				`ThreadLocation`		= :ThreadLocation,
				`ThreadContent`			= :ThreadContent,
				`ThreadTitle`				= :ThreadTitle,
				`ThreadNotes`				= :ThreadNotes,
				`ThreadSummary`			= :ThreadSummary,
				`ThreadTag`					= :ThreadTag

				WHERE `ThreadID` 		= :ThreadID";

/*
	Full Set
	/* Don't need Thread id - it's handled at the bottom
		`CatID`									= :CatID,

		`PostID`								= :PostID,
		`UserID`								= :CharID,
		`CharID`								= :CharID,

		`ThreadType`						= :ThreadType,
		`ThreadRating`					= :ThreadRating,

		`ThreadApproval`				= :ThreadApproval,
		`ThreadVisible` 				= :ThreadVisible,
		`ThreadFrom`						= :ThreadFrom,
		`ThreadFeaturing`				= :ThreadFeaturing,

		`ThreadPhaseOfDay`			= :ThreadPhaseOfDay,
		`ThreadTimeOfDay`				= :ThreadTimeOfDay,
		`ThreadWeather`					= :ThreadWeather,
		`ThreadLocation`				= :ThreadLocation,
		`ThreadContent`					= :ThreadContent,
		`ThreadTitle`						= :ThreadTitle,
		`ThreadNotes`						= :ThreadNotes,
		`ThreadSummary`					= :ThreadSummary,
		`ThreadTag`							= :ThreadTag";

		`DateLockThread` 				= :DateLockThread,
		`DatePostThread`				= :DatePostThread,
		`DatePullThread`				= :DatePullThread,
		`LastEditor`						= :LastEditor,
		`DateCreated`						= :DateCreated,
		`DateAssigned`					= :DateAssigned,
		`LastUpdated`						= :LastUpdated
*/

		$stmt = $db->prepare($sql);


		//The Primary Key of the row that we want to update.
		$stmt = $db->prepare($sql);
			$stmt->bindParam(':ThreadID',					$threadID, 					PDO::PARAM_INT);
			$stmt->bindParam(':CatID',						$catID, 						PDO::PARAM_INT);
			$stmt->bindParam(':ThreadType',				$threadType, 				PDO::PARAM_INT);
			$stmt->bindParam(':ThreadRating',			$threadRating, 			PDO::PARAM_INT);
			$stmt->bindParam(':ThreadPhaseOfDay',	$threadPhaseOfDay, 	PDO::PARAM_INT);
			$stmt->bindParam(':ThreadTimeOfDay',	$threadTimeOfDay, 	PDO::PARAM_INT);
			$stmt->bindParam(':ThreadWeather',		$threadWeather, 		PDO::PARAM_INT);

			$stmt->bindParam(':ThreadLocation',		$threadLocation, 		PDO::PARAM_STR);
			$stmt->bindParam(':ThreadContent',		$threadContent, 		PDO::PARAM_STR);
			$stmt->bindParam(':ThreadTitle',			$threadTitle, 			PDO::PARAM_STR);
			$stmt->bindParam(':ThreadNotes',			$threadNotes, 			PDO::PARAM_STR);
			$stmt->bindParam(':ThreadSummary',		$threadSummary, 		PDO::PARAM_STR);
			$stmt->bindParam(':ThreadTag',				$threadTag, 				PDO::PARAM_STR);


/*
	Full Set
	$stmt->bindParam(':ThreadID',						$threadID, 						PDO::PARAM_INT);
	$stmt->bindParam(':CatID',							$catID, 							PDO::PARAM_INT);
	#$stmt->bindParam(':PostID',						$PostID, 							PDO::PARAM_INT);
	#$stmt->bindParam(':UserID',						$CharID, 							PDO::PARAM_INT);
	#$stmt->bindParam(':CharID',						$CharID, 							PDO::PARAM_INT);
	$stmt->bindParam(':ThreadType',					$threadType, 					PDO::PARAM_INT);
	$stmt->bindParam(':ThreadRating',				$threadRating, 				PDO::PARAM_INT);
	#$stmt->bindParam(':ThreadApproval',		$ThreadApproval, 			PDO::PARAM_INT);
	#$stmt->bindParam(':ThreadVisible', 		$ThreadVisible, 			PDO::PARAM_INT);
	#$stmt->bindParam(':ThreadFrom',				$ThreadFrom, 					PDO::PARAM_INT);
	#$stmt->bindParam(':ThreadFeaturing',		$ThreadFeaturing, 		PDO::PARAM_STR);
	$stmt->bindParam(':ThreadPhaseOfDay',		$threadPhaseOfDay, 		PDO::PARAM_INT);
	$stmt->bindParam(':ThreadTimeOfDay',		$threadTimeOfDay, 		PDO::PARAM_INT);
	$stmt->bindParam(':ThreadWeather',			$threadWeather, 			PDO::PARAM_INT);
	$stmt->bindParam(':ThreadLocation',			$threadLocation, 			PDO::PARAM_STR);
	$stmt->bindParam(':ThreadContent',			$threadContent, 			PDO::PARAM_STR);
	$stmt->bindParam(':ThreadTitle',				$threadTitle, 				PDO::PARAM_STR);
	$stmt->bindParam(':ThreadNotes',				$threadNotes, 				PDO::PARAM_STR);
	$stmt->bindParam(':ThreadSummary',			$threadSummary, 			PDO::PARAM_STR);
	$stmt->bindParam(':ThreadTag',					$threadTag, 					PDO::PARAM_STR);
	#$stmt->bindParam(':DateLockThread', 		$DateLockThread, 			PDO::PARAM_INT);
	#$stmt->bindParam(':DatePostThread',		$DatePostThread, 			PDO::PARAM_INT);
	#$stmt->bindParam(':DatePullThread',		$DatePullThread, 			PDO::PARAM_INT);
	#$stmt->bindParam(':LastEditor',				$LastEditor, 					PDO::PARAM_INT);
	#$stmt->bindParam(':DateCreated',				$DateCreated, 				PDO::PARAM_INT);
	#$stmt->bindParam(':DateAssigned',			$DateAssigned, 				PDO::PARAM_INT);
	#$stmt->bindParam(':LastUpdated',				$LastUpdated,         PDO::PARAM_INT);
*/




		//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);

		try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
		#feedback success or failure of update


		#dumpDie($db->errorInfo());
		#die;

		if ($stmt->rowCount() > 0)
		{//success!  provide feedback, chance to change another!
			feedback("$threadTitle Was Successfully Revised!","success");
		}else{//Problem!  Provide feedback!
			feedback("$threadTitle NOT REVISED!","warning");
		}
		myRedirect(THIS_PAGE);
	}
}

function threadRemove(){
	/**
	 * create a new thread:D
	 */

	$threadId			 	= strip_tags($_GET['ThreadId']);				  #int - primaryKey

	$db = pdo(); # pdo() creates and returns a PDO object
	#dumpDie($_POST);

	$sql = "DELETE FROM ma_Threads WHERE `ThreadID` = :ThreadID";

	$stmt = $db->prepare($sql);
	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);
	$stmt->bindValue(':ThreadID', $threadId, PDO::PARAM_INT);

	try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
	#feedback success or failure of update

	if ($stmt->rowCount() > 0)
	{//success!  provide feedback, chance to change another!
		feedback("Thread Removed Successfully From Timeline!","success");
	}else{//Problem!  Provide feedback!
		feedback("Thread Not Removed!","warning");
	}
	myRedirect(THIS_PAGE);
}

#function threadMove
#function threadHidden - show all 'nuked' threads





function postAdd($str=''){
	/**
	 * create a post :D
	 */

	$threadTitle    = 'N2G Thread Title';
	#$postPhaseOfDay = $_POST['PostPhaseOfDay']
	$postPhaseOfDay = 'N2G Post/ThreadPhaseOfDay';
	$postTimeOfDay = 'N2G Post/ThreadTimeOfDay'; #addd min 67 seconds to it...

	$postLocation = 'N2G PostLocation';
	$postWeather = 'N2G postWeather'; #addd min 67 seconds to it...
	$postWhen = 'N2G postWhen'; #addd min 67 seconds to it...





	#$postID = (int)$row['PostID'];


	$str .= '<!-- start general content -->
		<script type="text/javascript" src="' . VIRTUAL_PATH . 'include/util.js"></script>

		<script type="text/javascript">

			function checkForm(thisForm)

			{//check form data for valid info
				if(empty(thisForm.FirstName,"Please Enter Customer\'s First Name")){return false;}
				if(empty(thisForm.LastName,"Please Enter Customer\'s Last Name")){return false;}
				if(!isEmail(thisForm.Email,"Please Enter a Valid Email")){return false;}
				return true;//if all is passed, submit!
			}

		</script>


		<div class="row" style="background-color: #0a0;"><!-- begin content -->
			<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);" >


				<input  type="hidden" name="ThreadID" value="' . $_GET['threadId']. '" />

				<!-- inner container -->
				<div class="class="col-sm-9 pull-right" style="background-color: #aaa;">

					<!-- left container -->
					<div class="col-sm-6 pull-left" style="background-color: #ddd ;">
						<h4 class="text-center">Add Post to <b>' . $threadTitle .  '</b></h4>';

							#Pulldown-Post-Type
							#function also used in profiles
							#echo makeDropDown('postType', 'PostType', 'xxx', $PostType);

							#Pulldown-Post-As
							#function also used in profiles
							#echo makeDropDown('postType', 'PostType', 'xxx', $PostType);

							#Pulldown-select character emoji:
							#function also used in profiles
							#echo mkRadio('character type', 'OCFC', $OCFC, 'FC', 'OC', 'Featured Character (FC)', 'Original Character (OC)');


							$str .= '<div class="row">
								<div class="pull-middle">

									<select class="selectpicker">
										<option>Post Type</option>
										<option>IC</option>
										<option>OOC</option>
										<option>Guidance</option>
										<option>Journal</option>
										<option>Timeline</option>
									</select>

									&nbsp; &nbsp;

									<select class="selectpicker">
										<optgroup label="myCharacters">
											<option name="CharID" value="1">Char A</option>
											<option name="CharID" value="2">Char B</option>
										</optgroup>
										<optgroup label="npcs-assigned">
											<option>npc A</option>
											<option>npc B</option>
											<option>npc C</option>
											<option>npc D</option>
											<option>npc E</option>
										</optgroup>
										<optgroup label="npcs-general">
											<option>general A</option>
											<option>general B</option>
										</optgroup>
										<optgroup label="npcs-restricted">
											<option>restrict A</option>
											<option>restrict B</option>
											<option>restrict C</option>
										</optgroup>
									</select>


									&nbsp; &nbsp;

									<select class="selectEmoji">
										<option>Character Emoji</option>
										<option>Image A</option>
										<option>Image B</option>
										<option>Image C</option>
										<option>Image D</option>
										<option>Image E</option>
									</select>

									<br /><br />

								</div>
							</div><!-- END Container -->


							<div class="row">
								<textarea
									name="PostContent"
									id="text"

									class="autoExpand col-sm-12"
									rows="3"
									data-min-rows="3"

									placeholder="Your Reply?"></textarea>



									<div id="result">
										Words: <span id="wordCount">0</span><br/>
									</div>
							</div><!-- END Container -->


							<div class="row">
								<textarea
									name="PostContent"
									id="text"

									class="autoExpand col-sm-12"
									rows="3"
									data-min-rows="3"

									placeholder="Please Summarize your Post here in 140 characters or less..."
									></textarea>

									<div id="result">
										Total Characters(including trails): <span id="totalChars">0</span><br/>
									</div>

							</div><!-- END Container -->

						<!--

							<div class="row">
							<p>show if notes exist, show if mod or player AND notes exist</p>
								<textarea
									name="PostNotes"

									class="autoExpand col-sm-12"
									rows="3"
									data-min-rows="3"

									placeholder="Moderator Notes here..." ></textarea>
							</div>



						-->
							<!-- END Container -->

						</div>
<!-- END left container -->
<!-- Right container -->


						<div class="col-sm-2 pull-right" style="background-color: #0aa;">

							<h4 class="text-center">Post Details</h4>

							<div class="row">
								<input
									class=""
									type="text"

									name="PostPhaseOfDay"
									value="' . $postPhaseOfDay . '"
									placeholder="?"/>


								<input
									class=""
									type="text"

									name="PostTimeOfDay"
									value="' . $postTimeOfDay . '"
									placeholder="0000-00-00 00:00:00"/>
							</div><!-- end container-->


							<div class="row">
								<select class="selectpicker">
									<option>Post Rating</option>
									<option>IC</option>
									<option>OOC</option>
									<option>Guidance</option>
									<option>Journal</option>
									<option>Timeline</option>
								</select>
							</div>

							<div class="row">
								<select class="selectpicker">
									<option>Weather</option>
									<option>IC</option>
									<option>OOC</option>
									<option>Guidance</option>
									<option>Journal</option>
									<option>Timeline</option>
								</select>
							</div>


							<div class="row">
								<input
									class=""
									type="text"

									name="PostLocation"
									value="' . $postLocation . '"
									placeholder="Where?"/>
							</div><!-- end container-->


							<div class="row">
								<input
									class=""
									type="text"

									name="PostTimeOfDay"
									value="' . $postWhen . '"
									placeholder="When?"/>
							</div><!-- end container-->



							<div class="row">
								<textarea
									name="PostNotes"

									class="autoExpand col-sm-12"
									rows="3"
									data-min-rows="3"

									placeholder="OOC Notes? "
									></textarea>
							</div><!-- end container-->


								<!-- auto fill needed -->
							<div class="row">
								<input
									class=""
									type="text"

									name="PostTags"
									placeholder="Tags? Get from reply"/>
							</div><!-- end container-->


						</div><!-- end right container -->
					</div><!-- end inner container -->

				<div class="clearfix">
					<br /><br />
				</div>

				<div
					align="center"
					style="background-color: #a0a;">

					<input  type="hidden" name="act" value="postInsert" />
					<input class="btn btn-primary btn-xs outline" type="submit" value="Add Post">

					&nbsp; &nbsp;

					<a class="btn btn-primary btn-xs outline" href="timeline.php">Exit Event</a>
				</div>

			</form>
		</div>

	<!-- END content -->';

	return $str;
}
# @TODO need to allow unapprove/resubmit - m2
function postEdit($sqlTags){

	$str='';
	#If user is logged - allow edit else send back to timeline

	$myPostID = ($_GET["postID"]);

	if(startSession() && isset($_SESSION['UserID']))
	{

		# SQL statement - PREFIX is optional way to distinguish your app
		$sql = "SELECT

		PostID, ThreadID, CatID, UserID, CharID,

		PostType, PostApproval, PostRating, PostVisible,

		PostFrom, PostFeaturing, PostPhaseOfDay, PostTimeOfDay, PostWeather, PostLocation,

		PostContent, PostNotes, PostSummary, PostTags,

		DatePostLock, DatePostPost, DatePullPost,
		LastEditor, DateCreated, DateAssigned, LastUpdated

		FROM ma_Posts

		WHERE PostID = $myPostID;";

		$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

		if (mysqli_num_rows($result) > 0)//at least one record!
		{ #show result

			while ($row = mysqli_fetch_assoc($result))
			{//dbOut() function - 'wrapper' to strip slashes, etc. of data leaving db

				#set up needed variables...
				$postID					= dbOut($row['PostID']);
				$threadID    		= dbOut($row['ThreadID']);
				#$catTitle 			= dbOut($row['CatID']);
				$userID  				= dbOut($row['UserID']);
				$charID  				= dbOut($row['CharID']);

				#$threadID    	= dbOut($row['PostType']);
				#$catTitle 			= dbOut($row['PostApproval']);
				$postRating  		= dbOut($row['PostRating']);
				$postApproval  	= dbOut($row['PostVisible']);

				$postFrom    		= dbOut($row['PostFrom']);
				$postFeaturing  = dbOut($row['PostFeaturing']);
				$postTimeOfDay 	= dbOut($row['PostTimeOfDay']);
				$postPhaseOfDay = dbOut($row['PostPhaseOfDay']);
				$postWeather    = dbOut($row['PostWeather']);
				$postLocation 	= dbOut($row['PostLocation']);

				$postContent		= dbOut($row['PostContent']);
				$postNotes			= dbOut($row['PostNotes']);
				$postSummary		= dbOut($row['PostSummary']);
				$postTags    		= dbOut($row['PostTags']);

				#$datePostLock  = dbOut($row['DatePostLock']);
				#$datePostPost  = dbOut($row['DatePostPost']);
				#$datePullPost  = dbOut($row['DatePullPost']);
				#$lastEditor    = dbOut($row['LastEditor']);
				#$dateCreated   = dbOut($row['DateCreated']);
				#$dateAssigned  = dbOut($row['DateAssigned']);
				#$lastUpdated   = dbOut($row['LastUpdated']);


				# show post details for edit...
				$str .= '
				<script type="text/javascript" src="' . VIRTUAL_PATH . 'include/util.js"></script>

				<script type="text/javascript">
					function checkForm(thisForm)
					{//check form data for valid info
						if(empty(thisForm.FirstName,"Please Enter Customer\'s First Name")){return false;}
						if(empty(thisForm.LastName,"Please Enter Customer\'s Last Name")){return false;}
						if(!isEmail(thisForm.Email,"Please Enter a Valid Email")){return false;}
						return true;//if all is passed, submit!
					}
				</script>


				<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">


					<input  type="hidden" name="ThreadID" value="' . $myPostID . '" />

					<!-- inner container -->
					<div class="class="col-sm-9 pull-right" style="background-color: #aaa;">

						<!-- left container -->
						<div class="col-sm-6 pull-left" style="background-color: #ddd ;">
							<h4 align="center">Edit Post # ' . $myPostID . ' </h4>';

								#Pulldown-Post-Type
								#function also used in profiles
								#echo makeDropDown('postType', 'PostType', 'xxx', $PostType);

								#Pulldown-Post-As
								#function also used in profiles
								#echo makeDropDown('postType', 'PostType', 'xxx', $PostType);

								#Pulldown-select character emoji:
								#function also used in profiles
								#echo mkRadio('character type', 'OCFC', $OCFC, 'FC', 'OC', 'Featured Character (FC)', 'Original Character (OC)');


									$str .= '<div class="row">
										<div class="pull-middle">

											<select class="selectpicker">
												<option>Post Type</option>
												<option>IC</option>
												<option>OOC</option>
												<option>Guidance</option>
												<option>Journal</option>
												<option>Timeline</option>
											</select>

											&nbsp; &nbsp;

											<select class="selectpicker">
												<optgroup label="myCharacters">
													<option name="CharID" value="1">Char A</option>
													<option name="CharID" value="2">Char B</option>
												</optgroup>
												<optgroup label="npcs-assigned">
													<option>npc A</option>
													<option>npc B</option>
													<option>npc C</option>
													<option>npc D</option>
													<option>npc E</option>
												</optgroup>
												<optgroup label="npcs-general">
													<option>general A</option>
													<option>general B</option>
												</optgroup>
												<optgroup label="npcs-restricted">
													<option>restrict A</option>
													<option>restrict B</option>
													<option>restrict C</option>
												</optgroup>
											</select>


											&nbsp; &nbsp;

											<select class="selectEmoji">
												<option>Character Emoji</option>
												<option>Image A</option>
												<option>Image B</option>
												<option>Image C</option>
												<option>Image D</option>
												<option>Image E</option>
											</select>

											<br /><br />

										</div>
									</div><!-- END Container -->


									<div class="row">
										<textarea
											name="PostContent"

											class="autoExpand col-sm-12"
											rows="3"
											data-min-rows="3"

											placeholder="Your Reply?">' . $postContent . '</textarea>
									</div><!-- END Container -->


									<div class="row">
										<textarea
											name="PostSummary"

											class="autoExpand col-sm-12"
											rows="3"
											data-min-rows="3"

											placeholder="Please Summarize your Post here in 140 characters or less..."
											>' . $postSummary . '</textarea>
									</div><!-- END Container -->


									<div class="row">
										<textarea
											name="$postNotes"

											class="autoExpand col-sm-12"
											rows="3"
											data-min-rows="3"

											placeholder="Moderator Notes here..." >' . $postNotes . '</textarea>
									</div>

									<!-- END Container -->

								</div>


<!-- END left container -->
<!-- Right container -->


								<div class="col-sm-2 pull-right" style="background-color: #0aa;">

									<h4 class="text-center">Post Details</h4>

									<div class="row">
										<input
											class=""
											type="text"

											name="PostPhaseOfDay"
											value="' . $postPhaseOfDay . '"
											placeholder="?"/>


										<input
											class=""
											type="text"

											name="PostTimeOfDay"
											value="' . $postTimeOfDay . '"
											placeholder="0000-00-00 00:00:00"/>
									</div><!-- end container-->

									<div class="row">
										<select class="selectpicker">
											<option>Post Rating</option>
											<option>IC</option>
											<option>OOC</option>
											<option>Guidance</option>
											<option>Journal</option>
											<option>Timeline</option>
										</select>
									</div>

									<div class="row">
										<select class="selectpicker">
											<option>Weather</option>
											<option>IC</option>
											<option>OOC</option>
											<option>Guidance</option>
											<option>Journal</option>
											<option>Timeline</option>
										</select>
									</div>


									<div class="row">
										<input
											class=""
											type="text"

											name="PostLocation"
											value="' . $postLocation . '"
											placeholder="Where?"/>
									</div><!-- end container-->


									<div class="row">
										<input
											class=""
											type="text"

											name="PostLocation"
											value="' . $postTimeOfDay . '"
											placeholder="When?"/>
									</div><!-- end container-->



									<div class="row">
										<textarea
											name="PostNotes"

											class="autoExpand col-sm-12"
											rows="3"
											data-min-rows="3"

											placeholder="OOC Notes? "
											>' . $postNotes . '"</textarea>
									</div><!-- end container-->

									<!-- auto fill needed -->
									<div class="row">
										<input
											class=""
											type="text"

											name="PostTags" ';



		#get codenames for tags
		#set ground work for tags
		#$threadTag 	= $row['ThreadTag'];
		$arrTags 		= explode(',', $postTags);
		$arrNames 	= getTagNames($sqlTags);


		#if we have tags show them
		if (isset($threadTag)){
			$postTags .= '<span class="glyphicon glyphicon-tag"></span> ';

			$x = 0;
			$tot = count($arrTags);

			#make links, comma seperated
			foreach($arrTags as $key => $value)
			{
				$postTags .=  '<a href="../characters/profile.php?CodeName=CodeName&id=' . $value . '&act=show">' . $arrNames[$value] . '</a>, ';
			}
		}

										$str .= 'value="' . $postTags . '"

											placeholder="Tags?" />
									</div><!-- end container-->


								</div><!-- end right container -->
							</div><!-- end inner container -->

						<div class="clearfix">
							<br /><br />
						</div>

						<div
							align="center"
							style="background-color: #a0a;">

							<input  type="hidden" name="act" value="updatePost" />
							<input class="btn btn-primary btn-xs outline" type="submit" value="Edit Post">

							&nbsp; &nbsp;

							<a class="btn btn-primary btn-xs outline" href="index.php">Exit Post #' . $myPostID . '</a>
						</div>

					</form>
				</div>

			<!-- END content -->';
			}

		}else{//no records
			echo '<div align="center">
				<h3>Houston we have a problem...</h3>
			</div>';
		}

		@mysqli_free_result($result); //free resources

	} else { #redirect back to timeline
		echo '<div align="center">
				<h3>Houston we have a problem...</h3>
			</div>';

		myRedirect('index.php');
	}

	return $str;

}

function postInsert($str=''){
/*

	SELECT PostID, ThreadID, CatID, UserID, CharID, PostType,
PostApproval, PostRating, PostVisible,
PostFrom, PostFeaturing, PostPhaseOfDay, PostTimeOfDay, PostWeather, PostLocation,
PostContent, PostNotes, PostSummary, PostTags,
DatePostLock, DatePostPost, DatePullPost,
LastEditor, DateCreated, DateAssigned, LastUpdated
FROM ma_Posts;

*/

	#PDO Setup needed vars...
	#$PostID 				= $_POST['PostID'];
	$ThreadID 			= $_POST['ThreadID'];
	#$CatID 				= $_POST['CatID'];

	#$UserID 				= $_POST['UserID'];
	$CharID 				= $_POST['CharID'];
	#$PostType 			= $_POST['PostType'];
	#$PostApproval 	= $_POST['PostApproval'];
	#$PostRating 		= $_POST['PostRating'];
	#$PostVisible 	= $_POST['PostVisible'];
	#$PostFrom 			= $_POST['PostFrom'];
	#$PostFeaturing 		= $_POST['PostFeaturing'];
	#$postPhaseOfDay 		= $_POST['PostPhaseOfDay'];
	#$postTimeOfDay 		= $_POST['PostTimeOfDay'];
	#$postWeather 			= $_POST['PostWeather'];
	#$PostLocation 	= $_POST['PostLocation'];
	$PostContent 		= $_POST['PostContent'];
	#$PostNotes 		= $_POST['PostNotes'];
	#$PostSummary 	= $_POST['PostSummary'];
	#$PostTags 			= $_POST['PostTags'];
	#$DatePostLock 	= $_POST['DatePostLock'];
	#$DatePostPost 	= $_POST['DatePostPost'];
	#$DatePullPost 	= $_POST['DatePullPost'];
	#$LastEditor 		= $_POST['LastEditor'];
	#$DateCreated 	= $_POST['DateCreated'];
	#$DateAssigned 	= $_POST['DateAssigned'];
	#$LastUpdated	 	= $_POST['LastUpdated'];

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
		$sql = "INSERT INTO ma_Posts (
				ThreadID, CharID, PostContent
			)
			VALUES ( ?, ?, ? )";

	$stmt = $db->prepare($sql);
	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);
	$stmt->bindValue(1, $ThreadID,				PDO::PARAM_STR);
	$stmt->bindValue(2, $CharID,					PDO::PARAM_STR);
	$stmt->bindValue(3, $PostContent,			PDO::PARAM_STR);

	try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
	#feedback success or failure of update

	if ($stmt->rowCount() > 0)
	{//success!  provide feedback, chance to change another!
		feedback("Post Added Successfully To Thread Name!","success");
	}else{//Problem!  Provide feedback!
		feedback("Post NOT added!","warning");
	}

	myRedirect(THIS_PAGE);
}

#show Single Post - will need to work in pager... so we can advance up and down
function postShow($str='', $tID = 0, $codeName = ''){
	#$myID = (int)$_GET['id']; #get post ID
	#$tID = (int)$_GET['tID']; #get thread ID
	$tID = 2; #temp value of thread for dev purpose, must ultimately come from query string
	$pID = (int)$_GET['id']; #get post ID

	#sql call for tags
	$sqlTags = "SELECT CharID AS CharacterID, Codename, FirstName, LastName FROM ma_Characters;";
	#sql for post data
	$sqlPost = "SELECT PostID, ThreadID, UserID, CharID, PostType, PostApproval, PostRating, PostVisible, PostFrom,
	 PostFeaturing, PostPhaseOfDay, PostWeather, PostLocation, PostContent, PostNotes, PostSummary, PostTags,
	 DatePostLock, DatePostPost, DatePullPost, LastEditor, DateCreated, DateAssigned, LastUpdated
	 FROM ma_Posts

	 WHERE PostID = $pID;";

	#BEGIN post construction
	$str='
	<!-- END sidebar -->
	<!-- BEGIN content -->
	<div class="col-md-9 pull-right">';


		#reference images for pager
		$prev = '<span class="glyphicon glyphicon-backward"></span>';
		$next = '<span class="glyphicon glyphicon-forward"></span>';

		# Create instance of new 'pager' class
		$myPager = new Pager(2,'',$prev,$next,'');
		$sql = $myPager->loadSQL($sqlPost);  #load SQL, add offset

		# connection comes first in mysqli (improved) function
		$result = mysqli_query(IDB::conn(),$sqlPost) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
		if (mysqli_num_rows($result) > 0)//at least one record!
		{#records exist - process

			/*
			if($myPager->showTotal()==1){$itemz = "post";}else{$itemz = "posts";}  //deal with plural
			$str .= ' <div align="center">We have ' . $myPager->showTotal() . ' ' . $itemz . '!</div>';
			*/

				#build $str post by post
				while($row = mysqli_fetch_assoc($result))
				{# process each row
					#config post variables
					$handlerID				= (int)$row['UserID'];
					$threadID 				= (int)$row['ThreadID'];

					$charID						= (int)$row['CharID'];

					#format post id to 4 places
					$postID   				= (int)$row['PostID'];
					$formatPostID  		= str_pad($postID, 4, '0', STR_PAD_LEFT);

					#format time post updated
					$lastUpdate       = date_create($row['LastUpdated']);
					$formatLastUpdate = date_format($lastUpdate, 'Y-m-d H:i:s a');

					$postLocation     = $row['PostLocation'];
					$postWeather      = $row['PostWeather'];
					$postContent      = dbOut($row['PostContent']);
					$postNotes      	= dbOut($row['PostNotes']);

					#get char ids for tags
					$postTags 				= $row['PostTags'];

					#make OOP SEE: http://php.net/manual/en/datetime.settime.php
					$format = 'Y-m-d H:i:s';
					$gameTime = strtotime('2016-09-03 14:55:24');

					$postSummary      = dbOut($row['PostSummary']);


					$str .= '<div class="row">
						<div class="col-sm-2">';

						$str .= getPolyThumb($charID) . '</div>'; #gets thumbnail of featured character with detailed tooltip

					#get the post content - the actual meat of the post
					$str .= '<div class="col-sm-7" style="background-color: white;">
							<p><strong>' . $codeName . ' &raquo; </strong> ' .  nl2br($postContent) . '</p>
						</div>

						<!-- END innercontent -->
						<!-- BEGIN post details -->
						<div class="col-sm-3 small">
							<div class="well">
								<p><strong>Message '
									. $formatPostID . '&raquo; </strong> <br /> [ <a href="'
									. VIRTUAL_PATH . 'threads/index.php?act=postEdit&postID='
									. $pID . '">Edit</a> | <a href="'
									. VIRTUAL_PATH . 'threads/index.php?act=postTrash&postID='
									. $pID . '">Remove</a> ]</p>

								<p><strong>Updated &raquo; </strong> ' . $formatLastUpdate . '</p>';


								$str .=	'<p>' . getHandlerDetails($handlerID, $postID) . '<p>'; #returns a handler detail link

								###########################################################
																 // ** IF SET SHOW **//
								###########################################################
								$str .= '<p><strong>From &raquo; </strong>[ #XXXX ]</p>

								<p><strong>Where &raquo; </strong> ' . $postLocation . ' </p>

								<p><strong>Weather &raquo; </strong> ' . $postWeather . ' </p>

								<p><strong>When &raquo; </strong> ' . $gameTime = date($format, $gameTime) . ' </p>

								<p><strong>Notes &raquo; </strong> ' . nl2br($postNotes) . ' </p>

								<p><strong>Summary &raquo; </strong> ' . nl2br($postSummary) . ' </p>';

								$str .= getPostTags($postTags);

							$str .= '</div><!-- END post details -->
						</div>
					</div>';

				} #END main while loop

				$str .= $myPager->showNAV(); # show paging nav, only if enough records

				@mysqli_free_result($result);

			}else{#no records
				$str .= "<div align=center>Currently no posts. You should do </div>";
			}


			$str .= '<p>(b1-not if first / b2-if last post only/b3-not if last)</p>
			<br />
			<p>
				<a href="#" class="btn btn-primary btn-xs">Prior Post (ID-1)</a>
				<a href="index.php?act=postAdd&threadId=' . $tID . '" class="btn btn-primary btn-xs">Add/INSERT Post</a>
				<a href="#" class="btn btn-primary btn-xs">Next Post (ID+1)</a>
			</p>
		</div><!-- END post/content -->
	<!-- START footer-->
	';

	return $str;
}

function postTrash(){
	#dumpDie($_POST);
	$postID			 	= strip_tags($_GET['postID']);				  #int - primaryKey

	$db = pdo(); # pdo() creates and returns a PDO object
	#dumpDie($_POST);

	$sql = "DELETE FROM ma_Posts WHERE `PostID` = :PostID";

	$stmt = $db->prepare($sql);
	//INTEGER EXAMPLE $stmt->bindValue(1, $id, PDO::PARAM_INT);
	$stmt->bindValue(':PostID', $postID, PDO::PARAM_INT);

	try {$stmt->execute();} catch(PDOException $ex) {trigger_error($ex->getMessage(), E_USER_ERROR);}
	#feedback success or failure of update

	if ($stmt->rowCount() > 0)
	{//success!  provide feedback, chance to change another!
		feedback("Post Removed Successfully From Thread!","success");
	}else{//Problem!  Provide feedback!
		feedback("Post Not Removed!","warning");
	}
	myRedirect(THIS_PAGE);
}

#function postMove(){}


#Th-Th-Th-Th-Th-... That's all, folks.
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

<script src="//cdn.jsdelivr.net/prefixfree/1.0.7/prefixfree.min.js"></script>

<!-- Prefixfree.js allows you to write prefix-free CSS
		 This means no -webkit-transform, -moz-transform, ... -->


<!--
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
-->

<!-- for word count -->
<script>
	counter = function() {
		var value = $('#text').val();

		if (value.length == 0) {
				$('#wordCount').html(0);
				$('#totalChars').html(0);
				$('#charCount').html(0);
				$('#charCountNoSpace').html(0);
				return;
		}

		var regex = /\s+/gi;
		var wordCount = value.trim().replace(regex, ' ').split(' ').length;
		var totalChars = value.length;
		var charCount = value.trim().length;
		var charCountNoSpace = value.replace(regex, '').length;

		$('#wordCount').html(wordCount);
		$('#totalChars').html(totalChars);
		$('#charCount').html(charCount);
		$('#charCountNoSpace').html(charCountNoSpace);
	};

	$(document).ready(function() {
		$('#count').click(counter);
		$('#text').change(counter);
		$('#text').keydown(counter);
		$('#text').keypress(counter);
		$('#text').keyup(counter);
		$('#text').blur(counter);
		$('#text').focus(counter);
	});
</script>

<!-- for toolTip -->
<script>
$(document).ready(function(){
 $('[data-toggle="tooltip"]').tooltip();
});

	$('input[rel="txtTooltip"]').tooltip({
	container: 'body'
});
</script>
