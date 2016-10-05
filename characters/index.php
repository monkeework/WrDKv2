<?php






require '../_inc/config_inc.php'; #configuration, pathing, error handling, db credentials
include INCLUDE_PATH . 'aarContent-inc.php';

function maxDoc_characters_index(){
/**
 * index.php (list.php) character portal entry point
 *
 *
 * @package ma-v1605-22
 * @author monkeework <monkeework@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.monkeework.com/
 * @license http://www.apche.org/licenses/LICENSE-2.0
 * @seeview.php
 * @todo tooltips
 *
 * @todo Customize profiles show based on user
	 - show their characters
	 - show their character allies
	 - show most recently approved
 * @todo Add - sorry no results found for case statements
 * @todo ADD PAGER too playbys option
 *
 */

	# '../' works for a sub-folder.  use './' for the root
}

$pageDeets = '<ol>
	<li> Resolve chat box overlap issue</li>
	<li> Review/update function checkForm(thisForm)</li>

	<!--
		<ul>
			<li> m2 - extended layout?</li>
			<li> m2 - notifications-mail</li>
			<li> m2 - character posting styles</li>
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


# SQL statement
$sql = " SELECT CodeName, CharID, StatusID, Alias, Playby, Gender FROM ma_Characters ORDER BY RAND() LIMIT 15;";

#Fills <title> tag. If left empty will default to $PageTitle in config_inc.php
$config->titleTag = 'Character&nbsp;Profiles | ' . SITE_NAME;

#Fills <meta> tags.  Currently we're adding to the existing meta tags in config_inc.php
$config->metaDescription = 'Marvel Adventures Character Database ' . $config->metaDescription;
$config->metaKeywords = 'Super-Heroes, Superheroes, Marvel, Comics, Characters, Roleplay, RP, RPG'. $config->metaKeywords;
$config->loadhead = '<link rel="stylesheet" type="text/css" href="./../_css/maxStrap.css">'; #load page specific JS


# END CONFIG AREA ----------------------------------------------------------

get_header(); #defaults to theme header or header_inc.php

echo MaxNotes($pageDeets); #notes to me!


if(isset($_GET['act'])){ $act = ($_GET['act']); }else{ $act = ''; } #initialize $act for switch

switch ($act) {
	case 'ShowAvailable':
			$sql = "SELECT CodeName, FirstName, LastName, MiddleName, CharID, StatusID FROM ma_Characters
				WHERE StatusID BETWEEN 0 AND 2
				ORDER BY CodeName ASC;";

			showTest($sql, 'Available', $minNum=-0, $maxNum=2); #characters locked prevent meddling
		break;

	################ SHOW BANNED ################
	case 'ShowBanned':
			$sql = "SELECT CodeName, FirstName, LastName, MiddleName, CharID, StatusID FROM ma_Characters
				WHERE StatusID = 16
				ORDER BY CodeName ASC;";

				showTest($sql, 'banned', $minNum=16, $maxNum=16);
			break;

	############## SHOW PLAYBYS ###############
	case 'ShowPlayby':
			$sql = "SELECT CodeName, FirstName, LastName, MiddleName, CharID, StatusID, Playby, Gender
				FROM ma_Characters ORDER BY Playby ASC;";

			echo '<div class="row">
					<h1 class="text-center"> Current Castings (Playbys)</h1>
				</div>
				<div class="row">
				<div class="col-sm-6">
					<h3>Female</h3>';
					#process results - show female playbys
					showCurrentPlaybys($sql, 'female');

				echo '</div>
				<div class="col-sm-6">
					<h3>Male</h3>';
					#process results - show male playbys
					showCurrentPlaybys($sql, 'male');

				echo '</div>
			</div>'; #END playbys

			break; #END showPlayby

	################ SHOW GROUP PLOTTERS ################
	case 'ShowPlotter':
			echo '<h1>show group plotters - see profiles for individiual character plotters</h1>';
			break;

	############## SHOW TEAMS ###############
	case 'ShowTeams':
		$sql = "SELECT  c.CodeName, c.FirstName, c.LastName, c.MiddleName, c.CharID, c.StatusID, #selected from ma_Characters
			g.TeamName  #selected from ma_Groups

			FROM ma_Characters AS c

			LEFT JOIN ma_Characters_Groups AS cg
			ON c.CharID = cg.CharID

			LEFT JOIN ma_Groups AS g
			ON cg.GroupID = g.TeamID

			WHERE g.TeamName IS NOT NULL

			ORDER BY g.TeamName ASC ;
			";

			showTeams($sql, 'null', 'teamed together');

			break;

	############### SHOW TAKEN #################
	case 'ShowTaken':
		$sql = "SELECT CodeName, FirstName, LastName, MiddleName, CharID, StatusID
			FROM ma_Characters
			WHERE StatusID BETWEEN 2 AND 13
			ORDER BY CodeName ASC;";

			showTest($sql, 'taken', $minNum=2, $maxNum=13); #characters locked prevent meddling

		break;

	############## SHOW MEMBERS ###############

	case 'ShowMembers':

		//set access priv needed for this page by member
		chekPrivies(1); #members+

		echo '<h3>Current Active Members</h3>';

		$sql = "SELECT UserID, UserName, Email, Privilege, LastLogin FROM ma_Users ORDER BY UserName ASC;";
		# connection comes first in mysqli (improved) function
			$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

			if(mysqli_num_rows($result) > 0)
			{#records exist - process

				echo '<div align="center" style="margin: 5px;" >'; #start images container
				while($row = mysqli_fetch_assoc($result))
				{# process each row

					$uName = dbOut($row['UserName']);

					#creat image link to character
					echo '<a href="' . VIRTUAL_PATH . 'users/member.php?CodeName=' .
						#strip white spaces out of code name for url
						str_replace(' ', '-', $uName) . '&id=' . (int)$row['UserID'] . '&act=members">

						<div class="divThumbs">';

						#create image path to check...
						$filename = '../uploads/c' . dbOut($row['UserID']) . '_thumb.jpg';

						$imgPath = '<img src="' . $filename . '" />';

						#if image exists, show
						if (file_exists($filename)) {
							echo '<img class="imgThumbs"  src="' . $filename . '" />';

						} else {
							$x =  rand(160, 200);
							#no image show me random static image (6 possible returns)
							echo '<img class="imgThumbs" src="http://placekitten.com/' . $x. '/' . $x. '" alt="' . $uName . '"  />';
						}

						echo '<br />

						' . dbOut($row['UserName']) . '

						<i><font color="red">' . 	dbOut(sprintf("%03d",$row['UserID'])) . '</font></i>
						<br />
						<i><font color="red">' . 	dbOut($row['Email']) . '</font></i>

					 </div>
					</a>';; #close image

				}

				echo '</div>
				<br style="clear:both" />'; #close images container


			}else{#no records
					echo "<p>No matches were found.</p>";
			} #END PROFILES SEARCH

			@mysqli_free_result($result);

		break;

	################ SHOW WANTED ################
	case 'ShowWanted':
			$sql = "SELECT CodeName, FirstName, LastName, MiddleName, CharID, StatusID FROM ma_Characters
				WHERE StatusID = 1 ORDER BY CodeName ASC;";

				showTest($sql, 'wanted', $minNum=0, $maxNum=0, $equalNum=1);

			break;

	############## SHOW DEFAULT CASE ###############
	#Generic random assort of characters
	case 'ShowRandom':
	default:
		/*
		 *
		 * set ids inside images
		 * create tooltips

		 $sql = " SELECT CodeName, CharID, StatusID, Alias, Playby, Gender FROM ma_Characters ORDER BY RAND() LIMIT 15;";


		 *
		 */

		# connection comes first in mysqli (improved) function
		$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

		if(mysqli_num_rows($result) > 0)
		{#records exist - process

			echo '<div align="center" style="margin: 5px;" >'; #start images container
			while($row = mysqli_fetch_assoc($result))
			{# process each row

				#$cID = $cName = $cStatus = $cPlayby = $cGender = $cDefault = $cLink = $cImg = $pbImg = '';

				$cID   		= dbOut($row['CharID']);
				$cName 		= dbOut($row['CodeName']);
				$cStatus	= dbOut($row['StatusID']);
				$cPlayby  = dbOut($row['Playby']);
				$cGender  = dbOut($row['Gender']);


				#if no gender, declare as most characters are likely male
				if($cGender == ''){$cGender = 'male';}



				#creat image link to character
				echo '<a href="' . VIRTUAL_PATH . 'characters/profile.php?CodeName=' .
					#strip white spaces out of code name for url
					str_replace(' ', '-', $cName) . '&id=' . $cID  . '&act=show">

					<div class="divThumbs">';

					$tImg   = 'uploads/' . $cID  . '-0.jpg';
					$cbDir  = strtolower(str_replace(' ', '_', $cPlayby));
					$pImg   = 'uploads/_' . $cGender . '/' . $cbDir . '/' . $cbDir . '-000.jpg';
					$sImg   = VIRTUAL_PATH . '_img/_static/static---00' . rand(0, 9). '.gif';

					#if image exists, show
					if (file_exists('./../' . $tImg)) {
						echo '<img class="imgThumbs"  src="./../' . $tImg . '" alt="' . $cName . '" />';

					} elseif(file_exists('./../' . $pImg)) {
							#} elseif(file_exists($cbLnk) {
							#if playby match exists, show

						#uploads/_male//-000.jpg


							echo '<img src="./../' . $pImg . '" class="imgThumbs" alt="' . $cName . '" />';

					} else {
						#no image show me random static image (6 possible returns)
						echo '<img class="imgThumbs" src="' . $sImg . '" alt="' . $cName . '"  />';
					}

					echo '<br />
					' . $cName . '<i><font color="red">'
						. 	dbOut(sprintf("%05d", $cID))
						. '</font></i>
					<br /></div></a>'; #close image

			}

			echo '</div>
			<br style="clear:both" />'; #close images container


		}else{#no records
				echo "<p>No matches were found.</p>";
		} #END PROFILES SEARCH

		@mysqli_free_result($result);

		//display general info
		if(startSession() && isset($_SESSION['UserID'])){
			echo $aarContent['AccessMember'];
		}else{
			echo $aarContent['AccessVisitor'];
		} #END User Address/Instruction content area.
}#END Switch

get_footer(); #defaults to theme footer or footer_inc.php


###################################
function showCurrentPlaybys($sql, $myGender = '')
{
	# connection comes first in mysqli (improved) function
		$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));


	if(mysqli_num_rows($result) > 0) {#records exist - process

		echo '<div class="" >'; #start images container

		while($row = mysqli_fetch_assoc($result)) {# process each row

			if(!empty($row['Playby']) && ($row['Gender'] == $myGender)){
				#0. create needed vars
				$myCharID      = dbOut($row['CharID']);
				$myPlayby      = dbOut($row['Playby']);
				#my google image search of a playby
				#https://www.google.com/search?q=aaron+taylor+johnson
				#https://www.google.com/search?q=aaron+' . $myGoogle .'
				#replace whitespace, commas, and dashes with plus sign
				$myGoogle      = preg_replace('/[ ,]+/', '+', trim($myPlayby));
				$myPlayByGoogle = "<a href='https://www.google.com/search?q={$myGoogle}' target='_blank'>{$myPlayby}</a>";

				$myCodeName    = dbOut($row['CodeName']);
				$myURLCodeName = str_replace(' ', '-', dbOut($row['CodeName']));
				$myStatusID    = dbOut($row['StatusID']);

				#1. create thumbnail
				#$myImgPath = "../uploads/c{$myCharID}_thumb.jpg";

				$myImgPath = chekImgExists($myCharID);

				$myImg = "<img class='thumbSM' src='{$myImgPath}' alt='{$myPlayby}is
					the playby for {$myCodeName} - {$myCharID}' />";
				$myPageLink = VIRTUAL_PATH . 'characters/profile.php?CodeName=' .
					$myURLCodeName . '&id= ' .
					$myCharID . '&act=show';


				#2. create image assignments state
				switch ($myStatusID) {
					case "available":
						$myStatusID = '<i>temporarily</i> cast as';
						break;

					case "assigned":
					case "review":
					case "reserved":
						$myStatusID = '<i>reserved</i> for';
						break;
					case "assigned":
					case "approved":
					case "locked":
						$myStatusID = '<i>designated</i> casting for';
						break;
					default:
						$myStatusID = 'is a <i>placeholder</i> casting for';
					}

				echo "<p >{$myImg} <div><span class='text-info'>{$myPlayByGoogle}</span> {$myStatusID}
					<a href='{$myPageLink}'>{$myCodeName}</a></div></p>
					<hr />
					";
			}
		}

		echo '</div>
		<br style="clear:both" />'; #close images container

	}else{#no records
			echo "<div align=center>No matches were found.<br /><a href='" . THIS_PAGE . "'> Return To Characters?</a></div>";
	}
} #END Function showCurrentPlaybys
				# SQL statement


#makeButton - like make nav?
function myDropdown(){
	echo '<div class="dropdown">
	<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Show Characters By...
	<span class="caret"></span></button>
	<ul class="dropdown-menu">

		<li><a href="' . VIRTUAL_PATH . '/characters/' . THIS_PAGE . '?act=ShowWanted"  > Wanted Characters </a></li>

		<li><a href="' . VIRTUAL_PATH . '/characters/' . THIS_PAGE . '?act=ShowTaken"  > Taken Characters </a></li>';

		#let's protect our users privacy
	if(startSession() && isset($_SESSION['UserID'])){
		echo '<li><a href="' . VIRTUAL_PATH . '/characters/' . THIS_PAGE . '?act=ShowPlotters"  > Plotters </a></li>';
	}

		echo '<li><a href="' . VIRTUAL_PATH . '/characters/' . THIS_PAGE . '?act=ShowPlayby" > Playbys / Castings </a> </li>

		<li><a href="' . VIRTUAL_PATH . '/characters/' . THIS_PAGE . '?act=ShowBanned"  > Characters Banned</a></li>

		<li><a href="' . VIRTUAL_PATH . '/characters/' . THIS_PAGE . '?act=ShowAvailable"  > Characters Available</a></li>';



		#let's protect our users privacy
		if(startSession() && isset($_SESSION['UserID'])){
			echo '	<li><a href="' . VIRTUAL_PATH . '/characters/index.php?act=ShowMembers"  > Members </a></li>';
		}

			echo '<li><a href="' . VIRTUAL_PATH . '/characters/index.php?act=ShowTeams"  > Teams </a></li>

			<li><a href="' . VIRTUAL_PATH . '/characters/index.php?act=ShowRandom"  > Random </a></li>
		</ul>
	</div>
	';
}
#makes the dropdown button list thing


function showResult($mySQL = '', $myStatus, $myAdjective = '')
{
	echo "<h1 class=''>Characters currently {$myAdjective} on " . SITE_NAME ."</h1>";

	# connection comes first in mysqli (improved) function
	$result = mysqli_query(IDB::conn(), $mySQL) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));


	if(mysqli_num_rows($result) > 0) {#records exist - process

		echo '<div class="" >'; #start images container

		while($row = mysqli_fetch_assoc($result)) {# process each row

			if(!empty($row['StatusID']) && ($row['StatusID'] == $myStatus)){

				#0. create needed vars
				$myCharID      = dbOut($row['CharID']);
				$myCodeName    = dbOut($row['CodeName']);
				$myStatusID    = dbOut($row['StatusID']);


				#my freindly google news search of codename
				#https://www.google.com/search?q=aaron+taylor+johnson
				#https://www.google.com/search?q=' . $myGoogle .'
				#replace whitespace, commas, and dashes with plus sign

				$myGoogle      = preg_replace('/[ ,]+/', '+', trim($myCodeName));
				$myGoogleSearch = "<a href='https://www.google.com/search?q=marvel+super-hero+cinematic+universe+{$myGoogle}+x-men+avengers' target='_blank'>You can learn more about {$myCodeName} here.</a>";


				#$myURLCodeName = str_replace(' ', '-', dbOut($row['CodeName']));

				#0. Check image exists
				#$myImgPath = $myCharID; #creat path
				$myImgPath = chekImgExists($myCharID);           #chek image exists


				#http://localhost/git250-16q2/marvel-adventures//uploads/static---001.gif

				#var_dump($myImgPath); #string(35)
				#die;

				#1. create thumbnail
				#$myImgPath = "../uploads/c{$myCharID}_thumb.jpg";
				$myImg = "<img class='thumbSM' src='{$myImgPath}' alt='{$myCodeName} is
					currently {$myStatusID} - {$myCharID}' />";

				#2. create link
				$myPageLink = '<a href="profile.php?CodeName=' . $myCodeName .
					'&id=' . $myCharID .
					'&act=show">' . $myCodeName .
					'</a>';

				#3. show match results

				echo "<p >{$myImg} <div>{$myPageLink} -  {$myGoogleSearch}</div></p><hr />";

			}
		}

		echo '</div> <br style="clear:both" />'; #close images container

	}else{#no records
			echo "<div align=center>No matching results <i>{$myAdjective}</i> found.<br /><a href='" . THIS_PAGE . "'> Return To Character Database?</a></div>";
	}
} #END Function showCurrentPlaybys


/* will need to paginate this sucker */
function showTest( $mySQL, $myAdjective='', $minNum='0', $maxNum='0', $equalNum='0')
{
		echo "<h1 class=''>Characters currently {$myAdjective} on " . SITE_NAME ."</h1>";

		# connection comes first in mysqli (improved) function
		$result = mysqli_query(IDB::conn(), $mySQL) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));


		if(mysqli_num_rows($result) > 0) {#records exist - process
			echo '<div class="" >'; #start images container

			while($row = mysqli_fetch_assoc($result)) {# process each row

				if(!empty($row['StatusID'])
					 &&
					 ($row['StatusID'] >= $minNum) &&
					 ($row['StatusID'] <= $maxNum) ||
					 ($row['StatusID'] == $equalNum)
					){

					#0. create needed vars
					$myCharID      = dbOut($row['CharID']);
					$myCodeName    = dbOut($row['CodeName']);
					$myStatusID    = dbOut($row['StatusID']);

					$myGoogle      = preg_replace('/[ ,]+/', '+', trim($myCodeName));
					$myGoogleSearch = "<a href='https://www.google.com/search?q=marvel+super-hero+cinematic+universe+{$myGoogle}+x-men+avengers' target='_blank'>You can learn more about {$myCodeName} here.</a>";


					#$myURLCodeName = str_replace(' ', '-', dbOut($row['CodeName']));

					#0. Check image exists
					#$myImgPath = $myCharID; #creat path
					$myImgPath = chekImgExists($myCharID);           #chek image exists


					#http://localhost/git250-16q2/marvel-adventures//uploads/static---001.gif

					#var_dump($myImgPath); #string(35)
					#die;

					#1. create thumbnail
					#$myImgPath = "../uploads/c{$myCharID}_thumb.jpg";
					$myImg = "<img class='thumbSM' src='{$myImgPath}' alt='{$myCodeName} is
						currently {$myStatusID} - {$myCharID}' />";

					#2. create link
					$myPageLink = '<a href="profile.php?CodeName=' . $myCodeName .
						'&id=' . $myCharID .
						'&act=show">' . $myCodeName .
						'</a>';

					#3. show match results

					echo "<p >{$myImg} <div>{$myPageLink} -  {$myGoogleSearch}</div></p><hr />";

				}
			}

			echo '</div> <br style="clear:both" />'; #close images container

		}else{#no records
				echo "<div align=center>No matching results <i>{$myAdjective}</i> found.<br /><a href='" . THIS_PAGE . "'> Return To Character Database?</a></div>";
		}
	} #END Function showNewResult


function showTeams($mySQL = 'x', $myStatus = '', $myAdjective = '')
{
	echo "<h1 class=''>Characters currently {$myAdjective} on " . SITE_NAME ."</h1>";

	# connection comes first in mysqli (improved) function
	$result = mysqli_query(IDB::conn(), $mySQL) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

	if(mysqli_num_rows($result) > 0) {#records exist - process

		#myVars
		$myStr   = '';
		$myChek  = '';

		while($row = mysqli_fetch_assoc($result)) {# process each row
			if(!empty($row['TeamName'])
				 #example of how to control who shows up in search
				 #This seems odd - should be !='banned'
				 && (($row['StatusID'] != NULL)) || ($row['StatusID'] == 'banned'))
			{
				#0. create needed vars
				$myTeamName    = dbOut($row['TeamName']);
				$myCharID      = dbOut($row['CharID']);
				$myCodeName    = dbOut($row['CodeName']);
				#$myPosition    = dbOut($row['TeamPosition']); #must have default

				#1. create thumbnail
				$myImgPath = chekImgExists($myCharID);


				$myImg = "<img class='thumbSM' src='{$myImgPath}' alt='Image of {$myCodeName}' /><br />{$myCodeName}";

				#2. create link

				#http://localhost/git250-16q2/marvel-adventures//characters/profile.php?CodeName=ChimaeraX&act=showChimaeraX&id=2

				$myPageLink = "<div class='pull-left' style='display:block; text-align: left'> &nbsp;
					<a href='profile.php?CodeName={$myCodeName}&act=show&id={$myCharID}'>{$myImg}</a></div> ";

				#3. sort the results teamname

				#chek if TeamName new
				#it's empty first time, so title/teamname prints
				if ($myChek !== $myTeamName){
					#if TeamName new - set new
					$myStr .= "<br style='clear:both' />
					<h3 style='align:left'> {$myTeamName} </h3>";
					#Save new teamname
					$myChek = $myTeamName;
				}

				$myStr .= $myPageLink;


			} #END While

			if(isset($myStr)){
				echo $myStr;
				$myStr = ''; #clear out string
			}else{
				echo 'Currently No Teams Set';
			};

		}
		echo '<br style="clear:both" />'; #close images container

	}else{#no records
			echo "<div align=center>No matching results <i>{$myAdjective}</i> found.<br /><a href='" . THIS_PAGE . "'> Return To Character Database?</a></div>";
	}
} #END Function showCurrentPlaybys


#helper Functions
function chekImgExists($img){

	$filepath = "../uploads/{$img}-0t.jpg";
	#if image exists, show
	if (file_exists($filepath)) {
		return $filepath; #return nothing - path stays same

	} else {
		#no image show me random static image (6 possible returns)
		return '../_img/_static/static---00' . rand(0, 9). '.gif'; #new image path
	}
}

