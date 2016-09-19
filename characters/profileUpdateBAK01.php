<?php

function maxDoc_characters_profileUpdate(){
	/**
	 * character_edit.php, based on edit.php is a single page web application that allows us to select a character
	 * and edit their data
	 *
	 * This page is based onpostback.php as well as first_crud.php, which is part of the
	 * nmPreload package
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
		#chekPrivies(3); #mods+






//END CONFIG AREA ----------------------------------------------------------

# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){
	$myAction = (trim($_REQUEST['act']));
}else{
	$myAction = "";
}

switch ($myAction)
{//check 'act' for type of process

	case "update": //3) Change character's first name

		#dumpDie($_POST);


		update();
		break;

	default: //1)Select character from list
		myRedirect('profile.php?CodeName=' . $CodeName . '&id=' . $CharID. '&act=show');
}



function update() {
	if(!is_numeric($_POST['CharID']))
	{//data must be alphanumeric only
		feedback("id passed was not a number. (error code #" . createErrorCode(THIS_PAGE,__LINE__) . ")","error");
		myRedirect(THIS_PAGE);
	}

	$iConn = IDB::conn();//must have DB as variable to pass to mysqli_real_escape() via iformReq()
	$redirect = THIS_PAGE; //global var used for following formReq redirection on failure


	//call mysqli_real_escape() internally, to check form data
	$CharID = iformReq('CharID',$iConn);

	#section 1 - General
	$CodeName       	= strip_tags(iformReq('CodeName',					$iConn));
	$UserID       	= strip_tags(iformReq('UserID',			        $iConn));
	$StatusID					= strip_tags(iformReq('StatusID',					$iConn));
	$OCFC							= strip_tags(iformReq('OCFC',							$iConn));
	$Alias						= strip_tags(iformReq('Alias', 						$iConn));

	$LastName       	= strip_tags(iformReq('LastName', 				$iConn));
	$FirstName      	= strip_tags(iformReq('FirstName',  			$iConn));
	$MiddleName     	= strip_tags(iformReq('MiddleName', 			$iConn));
	$NickName  		  	= strip_tags(iformReq('NickName', 				$iConn));
	$IdentityID				= strip_tags(iformReq('IdentityID', 			$iConn));


	#section 2 - Appearance
	$CharHtFt       	= strip_tags(iformReq('CharHtFt',					$iConn));
	$CharHtIn       	= strip_tags(iformReq('CharHtIn',					$iConn));
	$CharWt000      	= strip_tags(iformReq('CharWt000',				$iConn));
	$CharWt00       	= strip_tags(iformReq('CharWt00',					$iConn));
	$CharWt0        	= strip_tags(iformReq('CharWt0',					$iConn));

	$EyeColor       	= strip_tags(iformReq('EyeColor',					$iConn));
	$HairColor      	= strip_tags(iformReq('HairColor',				$iConn));

	$AgeActual      	= strip_tags(iformReq('AgeActual',				$iConn));
	$AgeApparent    	= strip_tags(iformReq('AgeApparent',			$iConn));

	$Gender    		  	= strip_tags(iformReq('Gender',						$iConn));
	$Playby						= strip_tags(iformReq('Playby',						$iConn));

	$Distinquishment	= strip_tags(iformReq('Distinquishment',	$iConn));
	$Appearance     	= strip_tags(iformReq('Appearance',				$iConn));


	#section 3 - personality section
	$Quote    		  	= strip_tags(iformReq('Quote', 						$iConn));
	$ThemeSong				= strip_tags(iformReq('ThemeSong',				$iConn));
	$ThemeSongLink		= strip_tags(iformReq('ThemeSongLink',		$iConn));
	$Waiver						= strip_tags(iformReq('Waiver',						$iConn));
	$Concept    			= strip_tags(iformReq('Concept', 					$iConn));
	$Orientation    	= strip_tags(iformReq('Orientation', 			$iConn));
	$Demeanor    			= strip_tags(iformReq('Demeanor', 				$iConn));
	$Nature    				= strip_tags(iformReq('Nature', 					$iConn));
	$Personality    	= strip_tags(iformReq('Personality',  		$iConn));


	#section 4 - Legal section
	$Citizenship    	= strip_tags(iformReq('Citizenship',			$iConn));
	$LegalStatus			= strip_tags(iformReq('LegalStatus',			$iConn));
	$DOByear        	= strip_tags(iformReq('DOByear',					$iConn));
	$DOBmonth       	= strip_tags(iformReq('DOBmonth', 				$iConn));
	$DOBday         	= strip_tags(iformReq('DOBday', 					$iConn));
	$PlaceOfBirth   	= strip_tags(iformReq('PlaceOfBirth', 		$iConn));
	$Education      	= strip_tags(iformReq('Education', 				$iConn));


	#section 5 - stats
	$Classification 	= strip_tags(iformReq('Classification', 	$iConn));
	$PowerSource    	= strip_tags(iformReq('PowerSource', 			$iConn));


	$RankPower      	= strip_tags(iformReq('RankPower', 				$iConn));

	$RankFighting   	= strip_tags(iformReq('RankFighting', 		$iConn));
	$RankAgility    	= strip_tags(iformReq('RankAgility', 			$iConn));
	$RankStrength   	= strip_tags(iformReq('RankStrength', 		$iConn));
	$RankEndurance  	= strip_tags(iformReq('RankEndurance', 		$iConn));

	$RankReason     	= strip_tags(iformReq('RankReason', 			$iConn));
	$RankIntuition  	= strip_tags(iformReq('RankIntuition', 		$iConn));
	$RankPsyche     	= strip_tags(iformReq('RankPsyche', 			$iConn));



	$SkillLevel     	= strip_tags(iformReq('SkillLevel', 			$iConn));
	$RankExpertise    = strip_tags(iformReq('RankExpertise', 		$iConn));
	$RankAsset     		= strip_tags(iformReq('RankAsset', 				$iConn));


	#section 6 - abilities
	$Power			    	= strip_tags(iformReq('Power', 						$iConn));
	$PowerDesc    		= strip_tags(iformReq('PowerDesc', 				$iConn));
	$Aptitude     		= strip_tags(iformReq('Aptitude', 				$iConn));
	$Merit      			= strip_tags(iformReq('Merit', 						$iConn));
	$Flaw    					= strip_tags(iformReq('Flaw', 						$iConn));

	#section 7 - stuff
	$Equipment				= strip_tags(iformReq('Equipment', 				$iConn));
	$Resource					= strip_tags(iformReq('Resource', 				$iConn));
	$Transportation		= strip_tags(iformReq('Transportation', 	$iConn));
	$Uniform					= strip_tags(iformReq('Uniform', 					$iConn));
	$UniformSpecs			= strip_tags(iformReq('UniformSpecs', 		$iConn));

	#section 8 - contacts
	$Team     				= strip_tags(iformReq('Team', 						$iConn));
	$TeamPosition   	= strip_tags(iformReq('TeamPosition', 		$iConn));


	$Affliation     	= strip_tags(iformReq('Affliation', 			$iConn));
	$Allies      			= strip_tags(iformReq('Allies', 					$iConn));
	$Contact					= strip_tags(iformReq('Contact', 					$iConn));
	$Relationship   	= strip_tags(iformReq('Relationship', 		$iConn));
	$Relative     		= strip_tags(iformReq('Relative', 				$iConn));
	$Rivals    				= strip_tags(iformReq('Rivals', 					$iConn));

	#section 9 - history
	$History    			= strip_tags(iformReq('History', 					$iConn));


	//next check for specific issues with data
	if(!ctype_print($_POST['CodeName']))
	{//data must be alphanumeric or punctuation only
		feedback("First and Last Name must contain letters, numbers or punctuation","warning");
		myRedirect(THIS_PAGE);
	}


	//build string for SQL insert with replacement vars, %s for string, %d for digits

	#PLAYER CODE NAME/FIRSTNAME -- HOW HOW HOW?
	#PLAYER CODE NAME/FIRSTNAME -- HOW HOW HOW?
	#PLAYER CODE NAME/FIRSTNAME -- HOW HOW HOW?

	#PlayerName AS u.FirstName='%s',
	#HandlerID='%s',

		$sql = "UPDATE ma_Characters set

			CodeName='%s',

			UserID='%s',

			StatusID='%s',
			OCFC='%s',
			LastName='%s',
			FirstName='%s',
			MiddleName='%s',
			NickName='%s',
			Alias='%s',
			IdentityID='%s',

			CharHtFt='%s',
			CharHtIn='%s',

			CharWt000='%s',
			CharWt00='%s',
			CharWt0='%s',

			EyeColor='%s',
			HairColor='%s',

			AgeActual='%s',
			AgeApparent='%s',

			Gender='%s',
			Playby='%s',
			Distinquishment='%s',
			Appearance='%s',

			Quote='%s',
			ThemeSong='%s',
			ThemeSongLink='%s',
			Waiver='%s',
			Concept='%s',
			Orientation='%s',
			Demeanor='%s',
			Nature='%s',
			Personality='%s',

			Citizenship='%s',
			LegalStatus='%s',
			DOByear='%s',
			DOBmonth='%s',
			DOBday='%s',
			PlaceOfBirth='%s',
			Education='%s',

			Classification='%s',
			PowerSource='%s',
			RankPower='%s',

			RankFighting='%s',
			RankAgility='%s',
			RankStrength='%s',
			RankEndurance='%s',

			RankReason='%s',
			RankIntuition='%s',
			RankPsyche='%s',

			SkillLevel='%s',
			RankExpertise='%s',
			RankAsset='%s',

			Power='%s',
			PowerDesc='%s',
			Aptitude='%s',
			Merit='%s',
			Flaw='%s',

			Equipment='%s',
			Resource='%s',
			Transportation='%s',
			Uniform='%s',
			UniformSpecs='%s',

			Team='%s',
			TeamPosition='%s',

			Affliation='%s',
			Allies='%s',
			Contact='%s',
			Relationship='%s',
			Relative='%s',
			Rivals='%s',
			History='%s'

			WHERE CharID=%d"
		; #no comma before where statement...


	#			$HandlerID,
	# sprintf() allows us to filter (parameterize) form data
			$sql = sprintf($sql,

			$CodeName,
			$UserID,

			$StatusID,
			$OCFC,
			$LastName,
			$FirstName,
			$MiddleName,
			$NickName,
			$Alias,
			$IdentityID,

			/* Appearance */
			$CharHtFt,
			$CharHtIn,
			$CharWt000,
			$CharWt00,
			$CharWt0,

			$HairColor,
			$EyeColor,

			$AgeActual,
			$AgeApparent,

			$Gender,
			$Playby,

			$Distinquishment,
			$Appearance,

			$Quote,
			$ThemeSong,
			$ThemeSongLink,
			$Waiver,
			$Concept,
			$Orientation,
			$Demeanor,
			$Nature,
			$Personality,

			$Citizenship,
			$LegalStatus,
			$DOByear,
			$DOBmonth,
			$DOBday,
			$PlaceOfBirth,
			$Education,


			$Classification,
			$PowerSource,
			$RankPower,

			$RankFighting,
			$RankAgility,
			$RankStrength,
			$RankEndurance,
			$RankReason,
			$RankIntuition,
			$RankPsyche,

			$SkillLevel,
			$RankExpertise,
			$RankAsset,

			$Power,
			$PowerDesc,
			$Aptitude,
			$Merit,
			$Flaw,

			$Equipment,
			$Resource,
			$Transportation,
			$Uniform,
			$UniformSpecs,


			$Team,
			$TeamPosition,

			$Affliation,
			$Allies,
			$Contact,
			$Relationship,
			$Relative,
			$Rivals,

			$History,


			(int)$CharID);


	@mysqli_query($iConn,$sql) or die(trigger_error(mysqli_error($iConn), E_USER_ERROR));
	#feedback success or failure of update
	if (mysqli_affected_rows($iConn) > 0)
	{//success!  provide feedback, chance to change another!
	 feedback("Character Updated Successfully!", "success");

	}else{//Problem!  Provide feedback!
	 feedback("No Changes Made To {$CodeName}", "warning");
	}

		myRedirect('profile.php?CodeName=' . $CodeName . '&id=' . $CharID. '&act=show');
}

