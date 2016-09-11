<?php // maps currently too profile-rdSTAT.php

require '../_inc/config_inc.php';

$config->loadhead = ''; #load page specific JS


function maxDoc_characters_profile(){
/**
 * profile.php based view.php, display character attributes
 *
 *
 * @package ma-v1605-22
 * @author monkeework <monkeework@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.monkeework.com/
 * @license http://www.apche.org/licenses/LICENSE-2.0
 * @seelist.php
 *
 * @todo edit peekaboo edit character link
 *	  cheks char assigned/is mod+
 *		show edit option
 *
 * @todo add back button
 */

 # '../' works for a sub-folder.  use './' for the root
}

$pageDeets = '<ol>
	<li> Review the upload image with Andrew :: compare and review.</li>
	<li> Add word counters for limited text areas</li>
	<li> -thumbnail will display most current character mood /post association?</li>
	<li> REWORK weight - in pounds, convert to tons</li>

	<li> add classes</li>

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



	#id - series - suffix
	#THUMB   2-1t.jpg     teddy thumbnail
	#GALLY 	 2-1g.jpg     teddy gallery
	#PROFL   2.jpg        teddy profile/featured image/emoji
	#HEADR   2-1h.jpg     teddy header/background


#config for image uploads
$title = "Image Upload";

#declare file size max (100000 = 100K)
$sizeBytes = 100000; # bytes max file size

#If true, will create thumbnail in same upload directory
#Pass as a string, so can be placed in hidden form field
$createThumb = "TRUE";

#Declared width of thumbnail
#Height calculated from there
$thumbWidth = 50; #thumb

$gallyWidth = ''; #gallery
$proflwidth = 170; #gallery
$headrwidth = 940; #gallery

#Declared suffix of thumbnail.
#if use '_thumb', and image prefix is 'm', file name would be: m1_thumb.jpg
$thumbSuffix = "_thumb";

#$thumbSuffix = 'x'; #thumb
$gallySuffix = 'x'; #gallery
$proflSuffix = 'x'; #gallery
$headrSuffix = 'x'; #gallery

#Folder for upload.
$uploadFolder = "uploads/"; # Physical path added to uploadFolder info in upload_execute.php

#unique prefix to add to your image name.
#$imagePrefix = "m";

$thumbPrefix = 't'; #thumb
$gallyPrefix = 'g'; #gallery
$proflPrefix = 'p'; #gallery
$headrPrefix = 'h'; #gallery

#image extension - currently only supporting .jpg - see upload_execute.php
$extension = ".jpg";
#end config for image uploads




# check variable - if invalid redirect to index
if(isset($_GET['id']) && (int)$_GET['id'] > 0){#data must be on querystring
	 $myID = (int)$_GET['id']; #Convert to integer, will equate to zero if fails
}else{
	myRedirect(VIRTUAL_PATH . "characters/index.php");
}

######################  SQL QUERY 1  ########################
#Aliased FirstName from user table to avoid data conflation/collisions
#u.UserID AS HandlerID,
$sql = "SELECT u.UserName AS PlayerName,

c.CharID, c.UserID, c.CodeName, c.LastName, c.FirstName, c.MiddleName, c.NickName, c.Alias, c.StatusID, c.IdentityID, c.OCFC, c.Playby, c.Gender, c.CharHtFt, c.CharHtIn, c.CharWt0000, c.CharWt000, c.CharWt00, c.CharWt0, c.HairColor, c.EyeColor, c.DOByear, c.DOBmonth, c.DOBday, c.AgeActual, c.AgeApparent, c.Distinquishment, c.Appearance, c.Quote, c.ThemeSong, c.ThemeSongLink, c.Citizenship, c.LegalStatus, c.PlaceOfBirth, c.Affliation, c.Relationship, c.Education,  c.Waiver, c.Concept, c.Orientation, c.Demeanor,  c.Nature, c.Personality, c.Goal, c.Team, c.TeamPosition, c.Classification, c.PowerSource, c.RankPower, c.RankFighting, c.RankAgility, c.RankStrength, c.RankEndurance, c.RankReason, c.RankIntuition, c.RankPsyche, c.RankAsset, c.RankExpertise, c.Power, c.PowerDesc, c.SkillLevel, c.Aptitude, c.Merit, c.Flaw, c.Uniform, c.UniformSpecs, c.Resource, c.Equipment, c.Transportation, c.Contact, c.Relative, c.Allies, c.Rivals, c.History, c.NumReviews, c.DevelopmentTime, c.DateCreated, c.DateAssigned, c.LastUpdated

#ALIASING FOR coming joins
#FROM ma_Characters AS c INNER JOIN
FROM ma_Characters AS c LEFT JOIN
ma_Users           AS u ON

#FILTER DATA NEED
c.CharID = u.UserID
WHERE c.CharID = " . $myID;

$foundRecord = FALSE; # Will change to true, if record found!

# connection comes first in mysqli (improved) function
$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

if(mysqli_num_rows($result) > 0){#records exist - process
	$foundRecord = TRUE;

	while ($row = mysqli_fetch_assoc($result)) {
		$CharID = dbOut($row['CharID']);
		$PlayerName = dbOut($row['PlayerName']);

		#$HandlerID = dbOut($row['HandlerID']);

		#added user id here...
		$HandlerUserID  			= dbOut($row['UserID']);
		$CodeName  						= dbOut($row['CodeName']);
		$StatusID  						= dbOut($row['StatusID']);

		$LastName  						= dbOut($row['LastName']);
		$FirstName 						= dbOut($row['FirstName']);
		$MiddleName 					= dbOut($row['MiddleName']);
		$NickName 						= dbOut($row['NickName']);
		$Alias 								= dbOut($row['Alias']);
		$FullName 						= $LastName . ', ' . $FirstName;

		$StatusID 						= dbOut($row['StatusID']);
		$IdentityID 					= dbOut($row['IdentityID']);
		$OCFC 								= dbOut($row['OCFC']);
		$Playby 							= dbOut($row['Playby']);
		$Gender 							= dbOut($row['Gender']);

		$CharHtFt 						= dbOut($row['CharHtFt']);
		$CharHtIn 						= dbOut($row['CharHtIn']);

		$CharWt0000 					= dbOut($row['CharWt0000']);
		$CharWt000 						= dbOut($row['CharWt000']);
		$CharWt00 						= dbOut($row['CharWt00']);
		$CharWt0 							= dbOut($row['CharWt0']);

		$HairColor 						= dbOut($row['HairColor']);
		$EyeColor 						= dbOut($row['EyeColor']);

		$DOByear							= dbOut($row['DOByear']);
		$DOBmonth							= dbOut($row['DOBmonth']);
		$DOBday								= dbOut($row['DOBday']);
		$AgeActual						= dbOut($row['AgeActual']);
		$AgeApparent					= dbOut($row['AgeApparent']);
		$Distinquishment 			= dbOut($row['Distinquishment']);
		$Appearance 					= dbOut($row['Appearance']);

		$Quote 								= dbOut($row['Quote']);
		$ThemeSong 						= dbOut($row['ThemeSong']);
		$ThemeSongLink 				= dbOut($row['ThemeSongLink']);
		$Waiver 							= dbOut($row['Waiver']);

		$Citizenship 					= dbOut($row['Citizenship']);
		$LegalStatus 					= dbOut($row['LegalStatus']);
		$PlaceOfBirth 				= dbOut($row['PlaceOfBirth']);
		$Affliation 					= dbOut($row['Affliation']);
		$Relationship 				= dbOut($row['Relationship']);
		$Education 						= dbOut($row['Education']);
		$Concept 							= dbOut($row['Concept']);
		$Orientation 					= dbOut($row['Orientation']);
		$Demeanor 						= dbOut($row['Demeanor']);
		$Nature 							= dbOut($row['Nature']);
		$Personality 					= dbOut($row['Personality']);
		$Goal 								= dbOut($row['Goal']);

		$Team 								= dbOut($row['Team']);
		$TeamPosition 				= dbOut($row['TeamPosition']);
		$Classification 			= dbOut($row['Classification']);
		$PowerSource 					= dbOut($row['PowerSource']);

		$RankFighting 				= dbOut($row['RankFighting']);
		$RankAgility 					= dbOut($row['RankAgility']);
		$RankStrength 				= dbOut($row['RankStrength']);
		$RankEndurance 				= dbOut($row['RankEndurance']);

		$RankReason 					= dbOut($row['RankReason']);
		$RankIntuition 				= dbOut($row['RankIntuition']);
		$RankPsyche 					= dbOut($row['RankPsyche']);

		$RankAsset 						= dbOut($row['RankAsset']);
		$RankExpertise 				= dbOut($row['RankExpertise']);

		$RankPower 						= dbOut($row['RankPower']);

		$Power 								= dbOut($row['Power']);
		$PowerDesc 						= dbOut($row['PowerDesc']);
		$SkillLevel 					= dbOut($row['SkillLevel']);
		$Aptitude 						= dbOut($row['Aptitude']);
		$Merit 								= dbOut($row['Merit']);
		$Flaw 								= dbOut($row['Flaw']);
		$Uniform 							= dbOut($row['Uniform']);
		$UniformSpecs 				= dbOut($row['UniformSpecs']);
		$Resource 						= dbOut($row['Resource']);
		$Equipment 						= dbOut($row['Equipment']);
		$Transportation 			= dbOut($row['Transportation']);
		$Contact 							= dbOut($row['Contact']);
		$Relative 						= dbOut($row['Relative']);
		$Allies 							= dbOut($row['Allies']);
		$Rivals 							= dbOut($row['Rivals']);
		$History 							= dbOut($row['History']);
		$NumReviews 					= dbOut($row['NumReviews']);
		$DevelopmentTime 			= dbOut($row['DevelopmentTime']);
		$DateCreated 					= dbOut($row['DateCreated']);
		$DateAssigned 				= dbOut($row['DateAssigned']);

		#$MetaDescription = dbOut($row['MetaDescription']);
		#$MetaKeywords = dbOut($row['MetaKeywords']);
	}
}

@mysqli_free_result($result); # We're done with the data!

//---end config area ---------------------


if($foundRecord){#only load data if record found
	$config->titleTag = $CodeName . " | " . ucfirst($Team); #overwrite PageTitle with character info!
	#Fills <meta> tags.  Currently we're adding to the existing meta tags in config_inc.php
	#$config->metaDescription = $MetaDescription . ' Seattle Central\'s ITC280 Class Muffins are made with pure PHP! ' . $config->metaDescription;
	#$config->metaKeywords = $MetaKeywords . ',Muffins,PHP,Fun,Bran,Regular,Regular Expressions,'. $config->metaKeywords;
}

$config->metaDescription = 'Marvel Adventures Character Profile for ' . $CodeName; #Fills <meta> tags.
$config->metaKeywords = $CodeName . ', ' . $FirstName . ' ' . $LastName . ', ' . $config->metaKeywords;

# END CONFIG AREA ---------------------------------------

get_header(); #defaults to theme header or header_inc.php

# Read 'act' value, if it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}


#notes to self
echo MaxNotes($pageDeets); #notes to me!


//Get header element after myAction processed to determine if we show button or not.
getJumbotron($myID, $CodeName);


switch ($myAction)
{//check 'act' for type of process
	case "show": #Show Character Profile!
		if($foundRecord) {#records exist - show character!
				#If user is logged - show edit button
				if(startSession() && isset($_SESSION['UserID'])){

					#add additional cheks
					#if is admin, suepr, owner, developer or is player show edit option.

					echo '<div class=text-right>
						<button type="button"  class="btn btn-sm btnJumbotron"><a class="txt-KO" href="./profile.php?id=' . $myID . '&act=edit" data-toggle="click to edit ' . $CodeName . '"> ' . $CodeName . '</a> &nbsp; <i class="glyphicon glyphicon-edit"></i></button>
					</div>';
				}


		echo '<style>
			.btn-primary {
				color: #333;
				background-color: #e7e7e7;
				border-color: #dadada;
				}

			.btn-primary:hover, .btn-primary:focus,
			.btn-primary:active, .btn-primary.active,
			.open .dropdown-toggle.btn-primary {
				color: #fff;
				background-color: #33a3C8;
				border-color: #dadada;
				}

			.btn-primary:hover {
				color: #eee;
				background-color: #70BED8;
				border-color: #dadada;
				}

		</style>
		';


		#character identifiers
		echo varChekDisplay('full name', $FullName, $Gender);
		echo varChekDisplay('availability', $StatusID, $aarStatus);
		echo varChekDisplay('player', $PlayerName);
		echo varChekDisplay('alias', $Alias);
		echo varChekDisplay('nicknames', $NickName);
		echo varChekDisplay('identity is', $IdentityID);
		echo varChekDisplay('char type', $OCFC);
		echo varChekDisplay('playby', $Playby);


		#appearance
		if(
			!empty($AgeApparent) || !empty($HairColor) || !empty($EyeColor) ||
			($CharHtFt != 0) || ($CharHtIn != 0) ||
			($CharWt0 != 0) || ($CharWt0 != 0)  || ($CharWt0 != 0) ||
			!empty($Distinquishment) || !empty($Appearance) || !empty($Uniform)
		){
			echo charLabel('appearance');

			if($AgeApparent != 0){
				echo varChekDisplay('age', $AgeApparent . ' | <i style="color: #bbb;"> ' . $AgeActual . '</i>');
			}

			echo varChekDisplay('hair color', $HairColor, $aarHair);
			echo varChekDisplay('eye color', $EyeColor, $aarEye);

			if(($CharHtFt != 0) || ($CharHtIn != 0) || ($CharWt0 != 0) || ($CharWt0 != 0)  || ($CharWt0 != 0)){
				# IF hieght or weight exists, show me

				echo '<div class="row hoverHighlight">
				<div class="col-sm-3 text-right text-muted"><p class="text-right"><strong>Measurements:</strong></p></div>
					<div class="col-sm-7"><p>
						<strong>H:</strong> ' . $CharHtFt . '&ldquo;  ' . $CharHtIn . '&lsquo;  <strong>|</strong>
						<strong>W:</strong> ' . $CharWt000 .  $CharWt00 . $CharWt00 . ' lbs.
						</p></div>

				</div>';

			}

			echo varChekDisplay('distinquishing features', $Distinquishment);
			echo varChekDisplay('appearance', $Appearance);
			echo varChekDisplay('uniform', $Uniform);
		}


		#personality
		if(
			!empty($Quote) || !empty($Waiver) || !empty($Orientation) ||
			!empty($Demeanor) || !empty($Nature) || !empty($Personality)
		){
			echo charLabel('personality');

			echo varChekDisplay('quote', $Quote);

			if ($ThemeSong){
				#IF Themesong exists, show data
				echo varChekDisplay('theme song', '<a href="http::/' . $ThemeSongLink . '" >'. $ThemeSong . ' </a>');
			}

			echo varChekDisplay('waiver', $Waiver, $aarWaiver);
			echo varChekDisplay('concept', $Concept);
			echo varChekDisplay('orientation', $Orientation, $aarOrientation);
			echo varChekDisplay('demeanor', $Demeanor, $aarTrait);
			echo varChekDisplay('nature', $Nature, $aarTrait);
			echo varChekDisplay('personality', $Personality);
		}


		#legal/clerical
		if(
			!empty($Citizenship) || !empty($LegalStatus) ||
			!empty($DOByear) ||
			!empty($PlaceOfBirth) ||!empty($Education)
		){
			echo charLabel('legal');

			echo varChekDisplay('citizenship', $Citizenship, $aarCountryName);
			echo varChekDisplay('legal status', $LegalStatus, $aarLegal);
			#yes - three vars shoved into one - yippee!

			if(!empty($DOByear) && !empty($DOBday) && !empty($DOBmonth)){
				# IF we have a date of birth...
				echo varChekDisplay('DOB', $DOByear . ' / ' . $DOBday . ' / ' . $DOBmonth);
			}

			echo varChekDisplay('place of birth', $PlaceOfBirth);
			echo varChekDisplay('education', $Education, $aarEducation);
		}


		#team/group
		if(!empty($Team)){
			echo charLabel('group');

			echo varChekDisplay('team', $Team);
			echo varChekDisplay('team position', $TeamPosition);
		}


		#Abilities
		if( !empty($Classification) || !empty($PowerSource) ||!empty($RankPower) ||
			!empty($RankFighting) || !empty($RankAgility) ||!empty($RankStrength) || !empty($RankEndurance) || !empty($RankReason) ||!empty($RankIntuition) || !empty($RankPsyche) ||
			!empty($RankExpertise) ||!empty($RankAsset) ||
			!empty($SkillLevel) || !empty($PowerDesc) ||
			!empty($Aptitude) || !empty($Merit) || !empty($Flaw)
		){
			echo charLabel('abilities');

			echo varChekDisplay('classification', $Classification, $aarClassification);
			echo varChekDisplay('power source', $PowerSource, $aarPowSource);
			echo varChekDisplay('power rank', $RankPower);
			echo varChekDisplay('Stats', 'Fi: ' . $RankFighting . '| Ag: ' . $RankAgility . '| St: ' . $RankStrength . '| En: ' . $RankEndurance . '| Re: ' . $RankReason . '| In: ' . $RankIntuition . '| Ps: ' . $RankPsyche );
			echo varChekDisplay('expertise',     $RankExpertise,  $aarExpertise);
			echo varChekDisplay('assets',        $RankAsset,      $aarAsset);
			echo varChekDisplay('skill level',   $SkillLevel,     $aarExpertise);

			echo varChekDisplay('powers', $Power);

			echo varChekDisplay('power description', $PowerDesc);

			echo varChekDisplay('aptitude', $Aptitude);
			echo varChekDisplay('merit', $Merit);
			echo varChekDisplay('flaw', $Flaw);
		}


		#collateral
		if(
			!empty($Equipment) || !empty($Resource) ||!empty($Transportation) || !empty($Uniform) || !empty($UniformSpecs)
		){
			echo charLabel('collateral');

			echo varChekDisplay('equipment', $Equipment);
			echo varChekDisplay('resource', $Resource);
			echo varChekDisplay('transportation', $Transportation);
			echo varChekDisplay('uniform', $Uniform);
			echo varChekDisplay('uniformSpecs', $UniformSpecs);
		}


		#contacts
		if(
			!empty($Affliation) || !empty($Allies) ||!empty($Contact) ||
			!empty($Relative) || !empty($Rivals)
		){
			echo charLabel('Affiliates');

			echo varChekDisplay('affliation', $Affliation);
			echo varChekDisplay('allies', $Allies);
			echo varChekDisplay('contacts', $Contact);
			echo varChekDisplay('relationship', $Relationship);
			echo varChekDisplay('relatives', $Relative);
			echo varChekDisplay('rivals', $Rivals);
		} #END CONTACTS


		#history
		if(!empty($History)){
			echo charLabel('history');

			echo varChekDisplay('character history', $History);
		}



		if(isset($DateCreated)){
			echo '<tr class="profileLeftTR">
				<td>  Number of Reviews/Time Spent: </td>
				<td>' . $NumReview . ' / ' . $DevelopmentTime . '</td>
			</tr>
			<tr><td colspan="2"><hr /></td></tr>';
		}

		if(isset($DateCreated)){
			echo '<tr class="profileLeftTR"> Date Created/Assigned: </td>
			<td>' . $DateCreated . ' / . ' . $DateAssigned . '
			</td>';
		}

	}

break; #END SHOW
	############################################################################
	case "edit": //2) show first name change form

		//set access priv needed for this page by member
		chekPrivies(2); #member+

		if($foundRecord) {#records exist - lets edit the data!

			#some path variables to make code less unweildly
			$pathLibraryPowers = '<a href="' . VIRTUAL_PATH
				. '/library/powers.php?CodeName='
				. $CodeName . '&CharID='
				. $CharID . '" target="_blank" >' ;

			$pathLibraryIndex = '<a href="' . VIRTUAL_PATH
				. '/library/index.php?CodeName='
				. $CodeName . '&CharID='
				. $CharID . '&' ;


			echo '
			<style>
				form div.row {margin-bottom: 5px;}
			</style>
			';

			echo '<form
				action="profileUpdate.php?id=' . $myID . '&act=update"
				id="myForm"
				method="post">';

			#section 1 - General Descriptors
			echo charLabel('Images');


			$returnPage = "profile.php?id={$myID}&act=edit";


			echo '
				<div >
					<div class="col-sm-3 text-right text-muted">
						<p class="text-right"><strong>Background: </strong></p>
					</div>

					<div class="col-sm-7">
						<a href="./profileUpload.php?'
							. $_SERVER['QUERY_STRING']
							. '&type=h&series=0&returnPage='
							. $returnPage
							. '" class="btn btn-info" role="button">Banner  (940 x 460px)</a>
						</div>
					<div class="clearfix"></div>
					<br />
				</div>';



#prefix - id - series

#id - series - suffix
#THUMB   2-1t.jpg     teddy thumbnail
#GALLY 	 2-1.jpg      teddy gallery
#PROFL   2.jpg        teddy profile/featured image/emoji
#HEADR   2-1h.jpg     teddy header/background


#MAKES:
#150p.jpg
#150-t.jpg


#WANT:
#15-0p.jpg
#15-0t.jpg




			echo '
				<div >
					<div class="col-sm-3 text-right text-muted">
						<p class="text-right"><strong>Image Gallery: </strong></p>
					</div>

					<div class="col-sm-7">
						<a href="./profileUpload.php?'
							. $_SERVER['QUERY_STRING']
							. '&type=g&series=1&returnPage='
							. $returnPage
							. '" class="btn btn-info" role="button">Image 1</a>

						<a href="./profileUpload.php?'
							. $_SERVER['QUERY_STRING']
							. '&type=g&series=2&returnPage='
							. $returnPage
							. '" class="btn btn-info" role="button">Image 2</a>

						<a href="./profileUpload.php?'
							. $_SERVER['QUERY_STRING']
							. '&type=g&series=3&returnPage='
							. $returnPage
							. '" class="btn btn-info" role="button">Image 3</a>

						<a href="./profileUpload.php?'
							. $_SERVER['QUERY_STRING']
							. '&type=g&series=4&returnPage='
							. $returnPage
							. '" class="btn btn-info" role="button">Image </a>

						<div class="clearfix"></div>
						<br />

						<a href="./profileUpload.php?'
							. $_SERVER['QUERY_STRING']
							. '&type=g&series=5&returnPage='
							. $returnPage
							. '" class="btn btn-info" role="button">Image </a>

						<a href="./profileUpload.php?'
							. $_SERVER['QUERY_STRING']
							. '&type=g&series=6&returnPage='
							. $returnPage
							. '" class="btn btn-info" role="button">Image </a>

						<a href="./profileUpload.php?'
							. $_SERVER['QUERY_STRING']
							. '&type=g&series=7&returnPage='
							. $returnPage
							. '" class="btn btn-info" role="button">Image 7</a>

						<a href="./profileUpload.php?'
							. $_SERVER['QUERY_STRING']
							. '&type=g&series=8&returnPage='
							. $returnPage
							. '" class="btn btn-info" role="button">Image 8</a>
						</div>
					<div class="clearfix"></div>
					<br />
				</div>

				<div >
		<div class="col-sm-3 text-right text-muted">
			<p class="text-right"><strong>Profile: </strong></p>
		</div>

		<div class="col-sm-7">
			<a href="./profileUpload.php?'
				. $_SERVER['QUERY_STRING']
				. '&type=p&series=0&returnPage='
				. $returnPage
				. '&createThumb=TRUE"
				class="btn btn-info" role="button">Main Profile (170 x 170px)</a>';


			if(isset($_GET['msg'])){# msg on querystring implies we're back from uploading new image
				$msgSeconds = (int)$_GET['msg'];
				$currSeconds = time();
				if(($msgSeconds + 2)> $currSeconds)
				{//link only visible once, due to time comparison of qstring data to current timestamp
					echo '<br /><div class=""><script type="text/javascript">';
					echo 'document.write("<form><input type=button value=\'IMAGE UPLOADED! CLICK TO VIEW!\' onClick=history.go()></form>")</scr';
					echo 'ipt></div>';
				}
			}

		echo '</div>
		<div class="clearfix"></div>
		<br />
	</div>';



			#section 1 - General Descriptors
			echo charLabel('general descriptors');

			echo makeInput('codename', $CodeName, 'CodeName');

			//using second result set
			#called in function for now
			echo handlerDropDown($PlayerName, $HandlerUserID);

			echo makeDropDown('status', 'StatusID', $aarStatus, $StatusID);
			echo mkRadio('character type', 'OCFC', $OCFC, 'FC', 'OC', 'Featured Character (FC)', 'Original Character (OC)');

			echo makeInput('alias', $Alias, 'Alias');
			echo makeInput('last name', $LastName, 'LastName');
			echo makeInput('first name', $FirstName, 'FirstName');
			echo makeInput('middle name', $MiddleName, 'MiddleName');
			echo makeInput('nicknames', $NickName, 'NickName');
			echo mkRadio('identity is', 'IdentityID', $IdentityID,    'secret', 'public', 'secret', 'public');


		#section 2 - Appearance
			echo charLabel('Appearance');

			#height
			echo '<div class="row hoverHighlight">
			<div class="col-sm-3 text-right text-muted">
				<p class="text-right"><strong>Height: </strong></p>
			</div>

			<div class="col-sm-3">';

			echo makeNumericSelect('CharHtFt', $CharHtFt, 0, 24, 'ft.') . '</div>

			<div class="col-sm-3">';

				echo makeNumericSelect('CharHtIn', $CharHtIn, 0, 11, 'in.') . '</div>
			</div><!-- END Container -->';

			#Weight
			echo '<div class="row hoverHighlight">
			<div class="col-sm-3 text-right text-muted">
				<p class="text-right"><strong>Weight: </strong></p>
			</div>


			<div class="col-sm-2">';
			echo makeNumericSelect('CharWt000', $CharWt000, 0, 24, '') . '</div>

			<div class="col-sm-2">';
			echo makeNumericSelect('CharWt00', $CharWt00, 0, 9, '') . '</div>

			<div class="col-sm-2">';

			echo makeNumericSelect('CharWt0', $CharWt0, 0, 9, '') . '</div>
			</div><!-- END Container -->';


			echo mkDDinput($myTitle = 'eye', 'EyeColor',  $aarEye,  $EyeColor,  0, '', 'iColor');
			echo mkDDinput($myTitle = 'hair', 'HairColor', $aarHair, $HairColor, 0, '', 'iHair');
			#Distinquishment

			echo makeInput('actual age', $AgeActual, 'AgeActual');
			echo makeInput('apparent age', $AgeApparent, 'AgeApparent');
			echo mkRadio('gender', 'Gender', $Gender, 'male', 'female', 'male', 'female');
			echo makeInput('playby', $Playby, 'Playby');



#growing textarea

?>
<style>
	.myTextarea{
		display:block;
		box-sizing: padding-box;
		overflow:hidden;

		padding:10px;
		width:98%;
		font-size:14px;
		margin:50px auto;
		border-radius:8px;
		border:6px solid SkyBlue;
	}
</style>


<?php
			echo makeTextArea('distinquishing features', $Distinquishment, 'Distinquishment');
			echo makeTextArea('appearance', $Appearance, 'Appearance');


		#section 3 - Personality
			echo charLabel('Personality');

			echo makeTextArea('quote', $Quote, 'Quote');
			echo makeInput('character theme song', $ThemeSong, 'ThemeSong');
			echo makeInput('theme song link', $ThemeSongLink, 'ThemeSongLink');
			echo makeDropDown('waiver', 'Waiver', $aarWaiver, $Waiver);
			echo makeInput('concept', $Concept, 'Concept');
			echo makeDropDown('orientation', 'Orientation', $aarOrientation, $Orientation);
			echo makeDropDown('demeanor', 'Demeanor', $aarTrait, $Demeanor);
			echo makeDropDown('nature', 'Nature', $aarTrait, $Nature);
			echo makeTextArea('personality', $Personality, 'Personality');


		#section 4 - Legal
			echo charLabel('legal'); #legal/clerical

			echo makeDropDown('citizenship', 'Citizenship', $aarCountryName, $Citizenship);
			echo makeDropDown('Legal Status', 'LegalStatus', $aarLegal, $LegalStatus);

			echo '<div class="row hoverHighlight">
				<div class="col-sm-3 text-right text-muted">
					<p class="text-right"><strong>DOB:</strong></p>
				</div>

				<div class="col-sm-9">
					<input
						type="number "
						name="DOByear"
						value="' .  $DOByear . '"
						placeholder="Year as number"
					/> &nbsp;
					<input
						type="number "
						name="DOBday"
						value="' .  $DOBday . '"
						placeholder="Day as number"
					/> &nbsp;
					<input
						type="number "
						name="DOBmonth"
						value="' .  $DOBmonth . '"
						placeholder="Month as number"
					/>

				</div>
			</div>';

			echo makeInput('place of birth', $PlaceOfBirth, 'PlaceOfBirth');
			echo makeDropDown('education', 'Education', $aarEducation, $Education);
			echo makeDropDown('Character Class', 'Classification', $aarClassification, $Classification);

			#section 5 - abilities
			echo charLabel('power ranks'); #Abilities
#http://www.menucool.com/tooltip/javascript-tooltip

			echo makeDropDown('power source', 'PowerSource', 	$aarPowSource, 		$PowerSource );
			echo rdSTAT($aarMyTips['ra'],  	'RankPower',     	$RankPower,				$aarBtnRank);
			echo rdSTAT($aarMyTips['fi'],   'RankFighting',  	$RankFighting,		$aarBtnRank);
			echo rdSTAT($aarMyTips['ag'],   'RankAgility',   	$RankAgility,			$aarBtnRank);
			echo rdSTAT($aarMyTips['st'],   'RankStrength',  	$RankStrength,		$aarBtnRank);
			echo rdSTAT($aarMyTips['end'],  'RankEndurance', 	$RankEndurance,		$aarBtnRank);
			echo rdSTAT($aarMyTips['re'],		'RankReason',   	$RankReason,			$aarBtnRank);
			echo rdSTAT($aarMyTips['int'],  'RankIntuition',	$RankIntuition,		$aarBtnRank);
			echo rdSTAT($aarMyTips['psy'], 	'RankPsyche',			$RankPsyche,   		$aarBtnRank);
			echo makeDropDown('skill level', 'SkillLevel', 		$aarExpertise, 	$SkillLevel);
			echo makeDropDown('expertise', 	 'RankExpertise', $aarExpertise, 	$RankExpertise);
			echo makeDropDown('assets', 		 'RankAsset', 		$aarAsset, 		$RankAsset);


			#section 6 - abilities
			echo charLabel('abilities');

			echo makeInput($pathLibraryPowers . '  powers</a>', $Power, 'Power');

			echo makeInput($pathLibraryPowers . '  power descriptions</a>', $PowerDesc, 'PowerDesc');

			echo makeInput($pathLibraryIndex . 'act=trait-aptitudes" target="_blank" >Aptitudes</a>', $Aptitude, 'Aptitude');

			echo makeInput($pathLibraryIndex . 'act=trait-advantages" target="_blank" >Merits</a>', $Merit, 'Merit');
			echo makeInput($pathLibraryIndex . 'act=trait-disadvantages" target="_blank" >Flaws</a>', $Flaw, 'Flaw');


			#section 7 - resources and stuff
			echo charLabel('assets'); #stuff

			echo makeTextArea($pathLibraryIndex . 'act=trait-equipment" target="_blank" >Equipment</a>', $Equipment, 'Equipment');
			echo makeTextArea($pathLibraryIndex . 'act=trait-recourcess" target="_blank" >Resources</a>', $Resource, 'Resource');
			echo makeTextArea('transportation', $Transportation, 'Transportation');
			echo makeTextArea('uniform', $Uniform, 'Uniform');
			echo makeTextArea('uniform specs', $UniformSpecs, 'UniformSpecs');


			#section 8 - contacts
			echo charLabel('Associations'); #stuff

			echo makeInput('team', $Team, 'Team');
			echo makeInput('team position', $TeamPosition, 'TeamPosition');
			echo makeTextArea('affliation', $Affliation, 'Affliation');
			echo makeTextArea('allies', $Allies, 'Allies');
			echo makeTextArea('contacts', $Contact, 'Contact');
			echo makeTextArea('relationship', $Relationship, 'Relationship');
			echo makeTextArea('relatives', $Relative, 'Relative');
			echo makeTextArea('rivals', $Rivals, 'Rivals');

			#section 9 - abilities
			echo charLabel('history'); #history

			echo makeTextArea('character history', $History, 'History');

			echo '<input type="hidden" name="CharID" value="' . $myID . '" />
				<input type="hidden" name="act" value="update" />
				<input type="submit" value="Update"> &nbsp;
					<button> <a href="profile.php?id=' . $myID . '&act=show">Exit Without Update</a> </button>
						 &nbsp;
					<button> <a href="./index.php">Return to Characters</a> </button>
			</form>';

		}	#END Edit area

	 break;
	############################################################################
	default: # 1)Ask user to enter their name
		echo '<div align="center">What! No such Character? There must be a mistake!!</div>';
		echo '<div align="center"><a href="' . VIRTUAL_PATH . 'characters">Another Character?</a></div>';

		break;
} #END switch


echo '</div>'; #END container
// END POSTBACK

get_footer(); #defaults to footer_inc.php


///// #myFunctions

function randLetter(){
		//$int = rand(0,51);
		$int = rand(0,8);
		$a_z = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$rand_letter = $a_z[$int];
		return $rand_letter;
}

function getThumbs($imgID, $name){ #create 4 random thumbnails
	#id - series - suffix
	#THUMB   2-1t.jpg     teddy thumbnail
	#GALLY 	 2-1.jpg      teddy gallery
	#PROFL   2.jpg        teddy profile/featured image/emoji
	#HEADR   2-1h.jpg     teddy header/background

	#define variables needed
	$x = 1;
	$str = '';
#edit
	if(($_REQUEST['act']) == 'show'){
		#make gallery of 4 random images


		while($x <= 4) {
			$imgPath = '../uploads/' . $imgID . '-' . rand(1,6) . 't.jpg';

			#if image exists
			if(file_exists($imgPath)){
				$str .= '<img src="' . VIRTUAL_PATH .
					'uploads/' . $imgPath . '" alt=" "' . $name .
					'" class="img-thumbnail  pull-right myThumb" >';
			}else{ #show static
				$str .= '<img src="' . VIRTUAL_PATH .
					'_img/_static/static---00' . rand(0,9) . '.gif" alt=" "' . $name .
					'" class="img-thumbnail  pull-right myThumb" >';
			}
			$x++;
		}


	}

	#edit mod
	if(($_REQUEST['act']) == 'edit'){
		#make gallery of 4 random images
		while($x <= 4) {
			$imgPath = '../uploads/c' . $imgID . randLetter() .
					'.jpg';

			#if image exists
			if(file_exists($imgPath)){
				$str .= '<img src="../uploads/c' . $imgID . randLetter() .
					'.jpg" alt=" "' . $name .
					'" class="img-thumbnail  pull-right myThumb" >';
			}else{ #show static
				$str .= '<img src="../_img/_dims/dims35x35.jpg" alt=" "' . $name .
					'" class="img-thumbnail  pull-right myThumb" >';
			}
			$x++;
		}
	}

return $str; #return gallery images
}

function getJumboBg($imgID, $str=''){ #create background image
	#id - series - suffix
	#THUMB   2-1t.jpg     teddy thumbnail
	#GALLY 	 2-1.jpg      teddy gallery
	#PROFL   2.jpg        teddy profile/featured image/emoji
	#HEADR   2-1h.jpg     teddy header/background
	$imgPath = '../uploads/' . $imgID . '-h0.jpg';

	if(($_REQUEST['act']) == 'show'){
		#make gallery of 4 random images
		if(file_exists($imgPath)){
			$str .= $imgPath;
		}else{ #show static
			$str .= VIRTUAL_PATH . '_img/_static/static---blueCascade.gif';
		}
	}

	if(($_REQUEST['act']) == 'edit'){
		#make gallery of 4 random images

		if(file_exists($imgPath)){
				$str .= $imgPath;
			}else{ #show static
				$str .= VIRTUAL_PATH . '_img/_dims/dims940x462ph.jpg';
			}

		}
	return $str; #return gallery images
}

function getHero($imgID, $str=''){
	#id - series - suffix
	#HEADR   2-h0.jpg    teddy header/background
	#PROFL   2-0.jpg    teddy profile/featured image/emoji
	#GALLY 	 2-0.jpg    teddy gallery
	#THUMB   2-0t.jpg   teddy thumbnail

	$imgPath = '../uploads/' . $imgID . '-0.jpg';

	if(($_REQUEST['act']) == 'show'){
		#make gallery of 4 random images

		if(file_exists($imgPath)){
			$str .= $imgPath;
		}else{ #show static
			$str .= VIRTUAL_PATH . '_img/_static/static---00' . rand(1,9). '.gif';
		}
	}

	if(($_REQUEST['act']) == 'edit'){
		#make gallery of 4 random images

		if(file_exists($imgPath)){
				$str .= $imgPath;
			}else{ #show static
				$str .= VIRTUAL_PATH . '_img/_dims/dims170x170phf.jpg';
			}
		}
	return $str; #return gallery images
}

function getJumbotron($myID ='', $CodeName=''){
	echo '<style>
				.jumbotron {
					position: relative;
					background: #fff url("' . getJumboBg($myID) . '") center center;
					width: 100%;
					height: 100%;
					background-size: cover;
					overflow: hidden;
					}

				.vertical-align {
					position: absolute;
					bottom: -18px;
					left: 1%;
					}

				.btnJumbotron {
					position: absolute;
					top:10px;
					right: 0px;

					color: #000;

					background: white;
					#opacity: 0.9;
					font-size: 10px;
					padding: -3px -4px;

					border-radius: 10px 0 0 10px  ;
					font-weight: bold;
					}

					.btnJumbotron a {color: grey; text-decoration: none;}
					.btnJumbotron a:hover { color: tomato; text-decoration: none;}

				.jumbotron h1 {
					color: white;
					text-shadow: 4px 4px 8px #444;
					}

				.btn.outline {
					background: none;
					padding: 12px 22px;
					color: white;
					border: solid 2px white;
					border-radius: 10px;
					font-weight: bold;
					text-shadow: 0px 0px 8px #000000;
					box-shadow: 0px 0px 8px #000000;
					}


				.pull-bottom{
					position: absolute;
					bottom: 0px;}


				.myThumb {
					height: 35px;
					width: 35px;
					margin: 0 3px 0 6px;
					}

				.txt-KO{color: white;}

				.hoverHighlight:hover{ background: WhiteSmoke;}

				.charSection { background: WhiteSmoke;}

			</style>

			<!-- begin character -->
			<div class="container">
				<div class="jumbotron">
					<br />
					<br />
					<br />';

			if(startSession() && isset($_SESSION['UserID']) && ($_REQUEST['act']) == 'show')
			{

				#add additional cheks
				#if is admin, suepr, owner, developer or is player show edit option.

				echo '<div class=text-right>
					<button type="button"  class="btn btn-sm btnJumbotron"><a class="txt-KO" href="./profile.php?id=' . $myID . '&act=edit" data-toggle="click to edit ' . $CodeName . '"> ' . $CodeName . ' &nbsp; <i class="glyphicon glyphicon-edit"></i></a></button>
				</div>';
			}





	echo getImgGallery($myID, $CodeName); #CharID needed, returns array to build image gallery with

	echo '</div>
	<!--END JUMBO-->'; #END jumbo
}

#make empty tr tray
function charLabel($str){
	return '<div>
			<div class="col-sm-3">
				<h3 class="label label-default pull-right "><strong>' . strtoupper($str) . '</strong></h3>
			</div>
			<div class="col-sm-9 ">
				<h3 class="text-right"> &nbsp;</h3>
			</div>

		</div>
		<div class="clearfix"></div>'; #clear fix added to control wacky row highlight
}

function varChekDisplay($myTitle, $str='', $myCarrier=''){
/*
 * Display current settings IF not empty/null/void
 *
 * HOW TO CALL
 *
 *                            label         name       if array
 * echo varChekDisplayREV('availability', $StatusID, $aarStatus);
 *
 *
 *                         label       name
 * echo varChekDisplayREV('player', $PlayerName);

*/

	#if not empty, show me stuff
	if(!empty($str)){
		$myTxt = '';

		#if array make array
		if(is_array($myCarrier) && (!empty($myCarrier))){
			$myArr = $myCarrier;
		}else if (!empty($myCarrier)){
			#is a text notation of some sort
			$myTxt = ' <i><span class="text-muted"> &nbsp; (' . ucwords($myCarrier) . ')</span><i>';
		}


		if(!empty($str) && ($str!='')){#if array exists, use array value
			if(!empty($myArr)){
				$str = (int)$str;    #cast to int
				$str = $myArr[$str]; #get value from array
			}
		}

		#return with array info of gender notation
		return '<div class="row hoverHighlight">
			<div class="col-sm-3 text-right text-muted"><p class="text-right"><strong>' . ucwords($myTitle) . ':</strong></p></div>
			<div class="col-sm-9"><p>' . $str . $myTxt . '</p></div>
		</div>';

	}
}

function editDisplay($myID='') {# shows details from a single customer, and preloads their first name in a form.


	$myID = (int)$myID;  //forcibly convert to integer

	$sql = sprintf("select CustomerID,FirstName,LastName,Email from test_Customers WHERE CustomerID=%d",$myID);
	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));
	if(mysqli_num_rows($result) > 0)//at least one record!
	{//show results
		while ($row = mysqli_fetch_array($result))
		{//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
				 $Name = dbOut($row['FirstName']) . ' ' . dbOut($row['LastName']);
				 $First = dbOut($row['FirstName']);
				 $Last = dbOut($row['LastName']);
				 $Email = dbOut($row['Email']);
		}
	}else{//no records
			//feedback issue to user/developer
			feedback("No such customer. (error code #" . createErrorCode(THIS_PAGE,__LINE__) . ")","error");
		myRedirect(THIS_PAGE);
	}

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


	echo '<h3 align="center">' . smartTitle() . '</h3>
	<h4 align="center">Update Customer\'s Name</h4>
	<p align="center">Customer: <font color="red"><b>' . $Name . '</b>
	 Email: <font color="red"><b>' . $Email . '</b></font>
	<form action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">
	<table align="center">
		 <tr><td align="right">First Name</td>
				 <td>
					 <input type="text" name="FirstName" value="' .  $First . '">
					 <font color="red"><b>*</b></font> <em>(alphanumerics & punctuation)</em>
				 </td>
		 </tr>
		 <tr><td align="right">Last Name</td>
				 <td>
					 <input type="text" name="LastName" value="' .  $Last . '">
					 <font color="red"><b>*</b></font> <em>(alphanumerics & punctuation)</em>
				 </td>
		 </tr>
		 <tr><td align="right">Email</td>
				 <td>
					 <input type="text" name="Email" value="' .  $Email . '">
					 <font color="red"><b>*</b></font> <em>(valid email only)</em>
				 </td>
		 </tr>
		 <input type="hidden" name="CustomerID" value="' . $myID . '" />
		 <input type="hidden" name="act" value="update" />
		 <tr>
				 <td align="center" colspan="2">
					 <input type="submit" value="Update Info!"><em>(<font color="red"><b>*</b> required field</font>)</em>
				 </td>
		 </tr>
	</table>
	</form>
	<div align="center"><a href="' . THIS_PAGE . '">Exit Without Update</a></div>
	';
}

function makeInput($myTitle, $str='', $name=''){
	#create input
		return '<div class="row hoverHighlight">
			<div class="col-sm-3 text-right text-muted"><p class="text-right"><strong>' . ucwords($myTitle) . ':</strong></p> </div>
			<div class="col-sm-9">
				<input
					class="col-sm-9"
					type="text"
					name="'  . $name . '"
					value="' .  $str . '"
					placeholder="?"
				/>
			</div>
		</div>';
	}

#<textarea name="comment" form="usrform">Enter text here...</textarea>
function makeTextArea($myTitle, $str='', $name=''){
	#create input
		return '<div class="row hoverHighlight">
			<div class="col-sm-3 text-right text-muted"><p class="text-right"><strong>' . ucwords($myTitle) . ':</strong></p> </div>

			<div class="col-sm-9 ">
				<textarea
					class="autoExpand col-sm-9"
					name="'  . $name . '"
					value="' .  $str . '"
					rows="3"
					data-min-rows="3"
					placeholder="?"
				/></textarea>

			</div>

		</div>';
	}
#autoExpand col-sm-9 myTextarea

function mkDDinput($myTitle = '', $myName='', $myArr = '', $myVal = '', $count = 0, $myReturn = ''){
	//* $myTitle is one word - sets both the flush right title of the display button AND is used to call the specific jQuery script

	#assemble return / set title*, jQery* and formatting
	$myReturn .= '<div class="row hoverHighlight">
		<div class="col-sm-3 text-right text-muted">
			<p class="text-right"><strong>' . $myTitle . ' Color: </strong></p>
		</div>

		<div class="col-sm-9">
			<select
				id="' . $myTitle . '-htmlselect-basic"
				name="' . $myName . '"

			>';

		#build the drop down
		foreach($myArr as $item) { #sometimes you feel like a select
			if($count == $myVal){
				#we have set this to select
				$myReturn .= '<option
					data-imagesrc="../_img/_' . $myTitle . '/' . $myTitle . 'Color-' . $count++ . '.png"
					selected="selected"
					value="0">
						' . $item . '
				</option>';

			}else{
			 #if not set, make general li setting
				$myReturn .= '<option
					data-imagesrc="../_img/_' . $myTitle . '/' . $myTitle . 'Color-' . $count++ . '.png"
					value="0">
						' . $item . '
				</option>';
			}
		}

	$myReturn .= '</select>
		</div>
	</div>';

	return $myReturn;
}

#make drop down select from array - load preselected options
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

#make drop down select from zdro to whatever $myMax set to.
function makeNumericDropDown($myTitle, $myName, $myValue, $myMax=0 ){

	$myDropdown  = ''; #initialize

	$myDropdown .= '
	<div class="row hoverHighlight">
		<div class="col-sm-3 text-right text-muted">
			<p class="text-right"><strong>' . ucwords($myTitle) . ': </strong></p>
		</div>

		<div class="col-sm-7">
			<div class="form-group">
				<select class="form-control" name="' . $myName . '" id="' . $myTitle . '">';
				#create dropdown list - with option of select= 'selected' if matches db value!
				$count = 0;

				while($count <= $myMax)
				{ #sometimes you feel like a select
					if($count == $myValue){
						 $myDropdown .= '<option value="'. $count .'" selected="selected">'. $count .'</option>';
					}else{
						 #sometimes you don't
						 $myDropdown .= '<option value="'. $count .'">'. $count .'</option>';
					}

					$count++;
				}
		return $myDropdown . '</select></div></div></div><!-- END Container -->';
	}

#Make individual select for when we want to have a few in a row
function makeNumericSelect($myName, $myValue, $count, $myMax, $myTitle){

	#set up dropdown select
	$myDropdown = '<div class="form-group">
		<select class=" form-control col-sm-1"
			name="' . $myName . '"
			id="' . $myName . '">
			';

			#build select
			while($count <= $myMax)
			{ #sometimes you feel like a select
				if($count == $myValue){
					 #$myDropdown .= '<option value="'. $count .'" selected="selected">'. $count .'</option>';
					 $myDropdown .= '<option value="'. $count .'" selected="selected">' . $count . ' ' . $myTitle . '</option>';
				}else{
					 #sometimes you don't
					 #$myDropdown .= '<option value="'. $count .'">'. $count .'</option>';
					$myDropdown .= '<option value="' . $count . '">' . $count . ' ' . $myTitle . '</option>';
				}
				#iterate count
				$count++;
			}
		#close out select
		$myDropdown .= '
		</select>
	</div><!--end form group-->';

	return $myDropdown;
}

#get value from the basic radio settings for OCFC and StatusID
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

######################  DEVELOPMENT  ########################

function rdSTAT($myTitle, $myName='', $myValue='', $myArray, $str = ''){
	#begin construction of return (label)
	$str .=  '<div class="row hoverHighlight">'
	. '<div class="col-sm-3 text-right text-muted">'
	.   '<p class="text-right"><strong>' . ucwords( $myTitle ) . ': (' . $myValue . ')</strong></p>'
	. '</div>'
	#end label construct

	#start button container
	. '<div class="col-sm-9">'
	.   '<fieldset id="' . $myName . '">'
	.     '<div class="btn-toolbar" role="toolbar">'
	.       '<div class="btn-group btn-group-xs" data-toggle="buttons" >';
	$max = count( $myArray );
	for ($x = 0; $x < $max; $x++) {
		$item = $myArray[ $x ];

		/* problem not registering the value so nothing checks */
		#$selectActive = ($myValue == $item ) ? ' active ' : ' btn-default ';
		$selectActive = ($myValue == $x ) ? ' active ' : ' ';
		#$selectChek   = ($myValue == $item ) ? ' checked ' : ' xxxx ';
		$selectChek   = ($myValue == $x ) ? ' checked="checked" ' : ' ';


		$str .= '<label class="btn btn-primary btn-xs ' . $selectActive . '">'
		. '<input style="font-size: 6px;" '

		. ' type="radio" '
		. ' name="' . $myName . '" '
		#DB wants int value -- only ever 18 values in this specific instance
		. ' value="' . $x . '"' . $selectChek . '>' . ucwords( $item )

		. '</label>';
	}

	$str .=  '</div> <!-- END stat buttons -->'
	.       '</div><!-- END toolbar -->'
	.     '</div><!-- END Container -->'
	.   '</fieldset>'
	. '</div>';
	return $str;
}

function handlerDropDown($PlayerName, $HandlerUserID, $myDropdown = ''){//Select User
	#			echo handlerDropDown($PlayerName, $HandlerUserID);

	$sql = "SELECT UserName AS HandlerName, UserID AS HandlerID, LastUpdated AS HandlerUpdate
		FROM ma_Users";

	$foundRecord = FALSE; # Will change to true, if record found!

	# connection comes first in mysqli (improved) function
	$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

	if(mysqli_num_rows($result) > 0){#records exist - process
		$foundRecord = TRUE;

		$myDropdown .= '<div class="row hoverHighlight"><div class="col-sm-3 text-right text-muted"><p class="text-right"><strong> Handler: </strong></p></div>
			<div class="col-sm-7"><div class="form-group">
				<select class="form-control" name="UserID">';
				#create dropdown list - with option of select= 'selected' if matches db value!

				while ($row = mysqli_fetch_assoc($result)) {
					//$HandlerID      - character table
					//$HandlerUserID  - user table


				 $HandlerID = dbOut($row['HandlerID']);
					//dbOut() function is a 'wrapper' used strip slashes, etc. of data leaving db
					#sometimes you feel like a select
					if($HandlerUserID == $HandlerID){
						$myDropdown .= '<option value="'. $HandlerID .'" selected="selected">'. dbOut($row['HandlerName']) .'</option>';
					}else{
						#sometimes you don't
						$myDropdown .= '<option value="'. $HandlerID .'">'. dbOut($row['HandlerName']) .'</option>';
					}

				}
		return $myDropdown . '</select></div></div></div><!-- END Container -->';
	}
	@mysqli_free_result($result); # We're done with the data!
}



function getImgGallery($imgID = '', $CodeName = '', $str = '', $imgHero = '', $modal = FALSE){
/**
	* Take CharID, check upload __DIR__, return all images found meeint criteria of search given
	*
	**/

	$str .= '<h1 class="col-sm-8 vertical-align"><b>' . $CodeName . '</b></h1>

		<!-- image gallery here -->
		<div class"col-sm-2 vertical-align pull-right .vertical-align">

		<div class="  pull-right">';
			#echo getThumbs($myID, $CodeName) . '</div>
			$str .= '<br />
			<div col-sm-2 pull-right">
				<!-- Large modal -->
				<a href="#" class="btn " data-toggle="modal" data-target=".bs-example-modal-lg">
					<img src="';


					$imgPath = '../uploads/' . $imgID . '-0.jpg';

					if(($_REQUEST['act']) == 'show'){
						#make gallery of 4 random images

						if(file_exists($imgPath)){
							$imgHero = $imgPath;
							$modal = TRUE;
						}else{ #show static
							$imgHero = VIRTUAL_PATH . '_img/_static/static---00' . rand(1,9). '.gif';
							#no image, no modal
						}
					}

				$str .= $imgHero . '" alt="'
				. $CodeName . '"
					class="img-thumbnail pull-right" width="170" height="170">
				</a>';


				if($modal){

					$str .= '<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

								<!-- Wrapper for slides -->
								<div class="carousel-inner">';



// create an array to hold directory list
	$results = array();

	// create a handler for the directory
	$directory = '../uploads/';
	$handler = opendir($directory);

	// open directory and walk through the filenames
	while ($file = readdir($handler)) {
		// if file isn't this directory or its parent, add it to the results
		if ($file != "." && $file != "..") {
			// check with regex that the file format is what we're expecting and not something else
			//start of line, start of string, begins with $myID plus a single dash then whatever and is 'g.jpg'
			if(preg_match('#\d?' . $imgID . '-\dg#', $file)) {
				// add to our file array for later use
				$results[] .= $file;
			}
			#$cars=array("Volvo","BMW","Toyota");
		}
	}
	#var_dump ($results);
	$tot = count($results);
	$num = 1;



	foreach ($results as $result){

		#var_dump ($result);

		if($num == 1){
			//first one has a class of active on it
			$str .= '<div class="item active">
		 <img class="img-responsive" src="../uploads/' . $result . '" alt="...">
			<div class="carousel-caption">' . $CodeName . ' (' . $num++ . '/' . $tot . ')</div>
		</div>';


		}else{
			//all others don't have class active on them
			$str .= '<div class="item">
		 <img class="img-responsive" src="../uploads/' . $result  . '" alt="...">
			<div class="carousel-caption">' . $CodeName . ' (' . $num++ . '/' . $tot . ')</div>
		</div>';

		}


	}



/*
		$str .=  '<div class="item active">
		 <img class="img-responsive" src="../uploads/' . $imgID . '-1g.jpg" alt="...">
			<div class="carousel-caption">'. $imgID . ' -- '  . $CodeName . ' (1/3)</div>
		</div>

		<div class="item">
			<img class="img-responsive" src="../uploads/' . $imgID . '-2g.jpg" alt="...">
			<div class="carousel-caption">' . $CodeName . ' (2/3)</div>
		</div>

		 <div class="item">
			<img class="img-responsive" src="../uploads/' . $imgID . '-3g.jpg" alt="...">
			<div class="carousel-caption">' . $CodeName . ' (3/3)</div>
		</div>';
*/


									$str .= '</div>

								<!-- Controls -->
								<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
									<span class="glyphicon glyphicon-chevron-left"></span>
								</a>
								<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
									<span class="glyphicon glyphicon-chevron-right"></span>
								</a>
							</div>
						</div>
					</div>
				</div>';
				} //END Modal Image Gallery

			$str .= '</div>

			<div class="clearfix"></div>
		</div></div><!--END IMAGES-->';

	return $str;
}



//scripts must site outside php so the browser can properly read the script tags
?>

<script type="text/javascript" src="./../_js/jquery.ddslick.js"></script>
<script type="text/javascript" src="./../_js/DDslick-eye.js"></script>
<script type="text/javascript" src="./../_js/DDslick-hair.js"></script>


<script>

	$(document)
		.on('focus.textarea', '.autoExpand', function(){
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

