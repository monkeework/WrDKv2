<?php
function maxDoc_library_Powers(){
	/**
	 * based on add.php is a single page web application that allows us to add a new customer to
	 * an existing table
	 *
	 * LAYOUT: http://www.w3schools.com/bootstrap/bootstrap_templates.asp
	 *
	 * This page is based onedit.php
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
require '../_inc/aarCharPower-inc.php';


	$config->titleTag = smartTitle(); #Fills <title> tag. If left empty will fallback to $config->titleTag in config_inc.php
	$config->metaDescription = smartTitle() . ' - ' . $config->metaDescription;


	#$config->metaDescription = 'Web Database ITC281 class website.'; #Fills <meta> tags.
	#$config->metaKeywords = 'SCCC,Seattle Central,ITC281,database,mysql,php';
	#$config->metaRobots = 'no index, no follow';
	# The config property named 'loadHead' places JS, CSS, etc. inside the <head> tag - only use double quotes, or escape them!
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
			position: relative;
			background: #000 url("../_img/_bgs/bgPowers02.jpg") center center;
			width: 100%;
			height: 100%;
			background-size: cover;
			overflow: hidden;
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


	<!-- JS for captcha.  Move to your _JS? (or not) -->
	<script type="text/javascript">
		 var RecaptchaOptions = {
				theme : "clean"
		 };
	 </script>

	 <!-- CSS class for captcha.  Move to your CSS? (or not) -->
		<style>
			.g-recaptcha div { margin-left: auto; margin-right: auto;}

			#recaptcha_area { margin: auto;}
		</style>
	';
	#$config->banner = ''; #goes inside header
	#$config->copyright = ''; #goes inside footer
	#$config->sidebar1 = ''; #goes inside left side of page
	#$config->sidebar2 = ''; #goes inside right side of page
	#$config->nav1["page.php"] = "New Page!"; #add a new page to end of nav1 (viewable this page only)!!
	#$config->nav1 = array("page.php"=>"New Page!") + $config->nav1; #add a new page to beginning of nav1 (viewable this page only)!!


//END CONFIG AREA ----------------------------------------------------------


# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}

#if(isset($_GET['CodeName'])){$myCodeName = $_GET['CodeName']; }
$CharID = $CodeName = ''; #initialize

#get hidden values to personize page with.
if(isset($_GET['CodeName'])){
	#get CodeName
	$CodeName = $_GET['CodeName'];
	$_SESSION['CodeName'] = $CodeName;

	#get CharID
	$CharID = $_GET['CharID'];
	$_SESSION['CharID'] = $CharID;
}else{
	#initialize the vars if they empty
	$CharID = 0 ;
	$_SESSION['CharID'] = $CharID;

	$_SESSION['CodeName'] = $CodeName;
	$CodeName = 0 ;
}

global $config;
get_header();

echo MaxNotes($pageDeets); #notes to me!

echo '
<div class="jumbotron">
	<h1 style="margin: 0 0 -35px -35px;"><br /><br /><br /><br />
	<b>Power Library</b></h1>

</div>';


switch ($myAction)
{//check 'act' for type of process
	case 'defensive-powers':

			#customize category
			$myBody = "<p>
				The following listing of " . $myAction . " power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for " . $myAction . " power descriptions below can be found on the Range Tables (STC).
			</p>
			<p>
				Defensive powers are basically resistances which help to protect the character from physical, mental, or spiritual harm. Most of the defensive protections detailed in this section are generally proof against a specific from of attack such as Resistance to Fire and Heat, which while good against fiery balls of death <em>Equinox</em> might hurl at your character would do little against that of Endotherm's heat stealing abilities. You can find protections and defensive power suggests below for everything from radiation-based dangers to that of psychic trauma or possible spiritual crisis.
			</p>";

			#SHOW defensive

			echo showOverview($myAction, $myBody);

			echo showCategory('defensive-powers', $aarPowDefensive, $CodeName, $CharID);
			#show secondary catagories to look at.

		break;
	########################################################
	case "detection-powers":

		#customize category
			$myBody = "<p>
				The following listing of " . $myAction . " power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for " . $myAction . " power descriptions below can be found on the Range Tables (STC).
			</p>
			<p>
				Detection powers are basically sensory powers which are not of a psychic, magical, or faith based nature. They allow your character some exoctic or extraordinary method of detechion. The means by which can range from hyper senses to accute awareness of radiation hot zones. Most of the detctions detailed in this section are generally good towards a specific form of detection such as Hyper-Olfactory sense which would held Daredevil to identify if he is being approached by Electra Nachios or Karen Page by distinquishing the differences in their tell-tale scent markers.
			</p>
			";

			#SHOW detection
			echo showOverview($myAction, $myBody);
			echo showCategory('detection-powers', $aarPowDetection, $CodeName, $CharID);

		break;
	########################################################
	case "energy-generation-powers":

		#customize category
			$myBody = "<p>
				The following listing of " . $myAction . " power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for " . $myAction . " power descriptions below can be found on the Range Tables (STC).
			</p>
		<p>
			Energy controls reflect those powers which manipulate th evarious typse of energy that exist &dash; effectvely those non-material states outside the characters own body. These include most know types of energy and their possible states of being.
		</p>
		";

			#SHOW energy generation
			echo showOverview($myAction, $myBody);
		echo showCategory('energy-generation-powers', $aarPowEnergyControl, $CodeName, $CharID);

		break;
	########################################################
	case "energy-emission-powers":

		#customize category
			$myBody = "<p>
				The following listing of " . $myAction . " power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for " . $myAction . " power descriptions below can be found on the Range Tables (STC).
			</p>
			<p>
				Energy-emission powers are exactly what you are likely imaginging when you hear the term. They are bolts of lightning, bursts of extreme cold, or even the abscence such as that of shadow caster Darkstar of the Winter Guard. Energy emission powers can be emitted by any part of the hero's body. For most Powers, it is not important to specify the emergence point. For the Powers of the Energy Emission class, though, emission points become important. This affects how the hero utilizes his Power. It determines ways goes can negate that Power. If the hero loses the part of their body containing the emission point, they may lose their Power as well. When creating the hero, the player should determine an, emission point for any Energy Emission Powers. They may select the first one rolled as the point for all of their character's Energy Emissions, or be adventurous and determine one for each Power.
			</p>
		";

		#SHOW energy-emission
		echo showOverview($myAction, $myBody);
		echo showCategory('energy-emission-powers', $arrPowEnergyEmission, $CodeName, $CharID);

		break;
	########################################################
	case "fighting-enhancement-powers":

		#customize category
			$myBody = "<p>
				The following listing of " . $myAction . " power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for " . $myAction . " power descriptions below can be found on the Range Tables (STC).
			</p>
			<p>
				Fighting powers help to give the edge to close combatant characters such as Wolverine, Sabertooth, or Squirrel Girl (She has a really really big tail folks and she knows how to use it or she wouldn't be an Avenger). The powers might be natural or derived from an accident, experiment, or even artificial in nature. Regardless of their origin, they'll help your character turn the tide in a fight either limiting the amount of damage you can sustain or by adding to the amount of damage you can dole out.
			</p>
			";

		#SHOW fighting
		echo showOverview($myAction, $myBody);
		echo showCategory('fighting-enhancement-powers', $aarPowFighting, $CodeName, $CharID);

		break;
	########################################################
	case "illusion-powers":
		#customize category
		$myBody = "<p>
			The following listing of " . $myAction . " power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for " . $myAction . " power descriptions below can be found on the Range Tables (STC).
		</p>
		";

		echo showOverview($myAction, $myBody);
		echo showCategory('illusion-powers', $aarPowIllusions, $CodeName, $CharID);

		break;
	########################################################
	case "lifeform-control-powers":
		#customize category
		$myBody = "<p>
			The following listing of " . $myAction . " power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for " . $myAction . " power descriptions below can be found on the Range Tables (STC).
		</p>
		<p>
			These powers are severe in the scope of what they do as they affect other characters and as such must be weighted against their character waivers; These powers change the form, structure, composition or even the very nature of a character. The Corrupter for instance can turn anyone not only evil with a touch, but also brings them under his fiendish sway as well. For those character who are of a high tech nature, then these descriptions list the possible effects of their devices.
		</p>
		";

		echo showOverview($myAction, $myBody);
		echo showCategory('lifeform-control-powers', $aarPowLifeformControl, $CodeName, $CharID);

		break;
	########################################################
	case "magic-powers":
		#customize category
		$myBody = "<p>
			The following listing of " . $myAction . " power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for " . $myAction . " power descriptions below can be found on the Range Tables (STC).
		</p>
		<p>
			The list of heroes with magical powers seems to grow by the day lately, the descriptions here will help you to craft such a character if that is your interest. Mental powers are very valuable in that they have little visible effect, and the character using employing them is often hard to detect outright when doing so.
		</p>
		";

		echo showOverview($myAction, $myBody);
		echo showCategory('magic-powers', $aarPowMagic, $CodeName, $CharID);

		break;
	########################################################
	case "matter-control-powers":
		#customize category
		$myBody = "<p>
			The following listing of " . $myAction . " power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for " . $myAction . " power descriptions below can be found on the Range Tables (STC).
		</p>
		<p>
			These powers affect specific forms of animate and inanimate matter (substances as oppossed to energy) outside your character's physical body or beyond their physical means to reach and or otherwise affect. They include the various elemental powers you might expect, as well as the abiltiy to animate objects and transfrom items and in some cases even other characters (see oppossing characters character waiver for possible considerations).
		</p>
		";

		echo showOverview($myAction, $myBody);
		echo showCategory('matter-control-powers', $aarPowMatterControl, $CodeName, $CharID);

		break;
	########################################################
	case "matter-conversion-powers":
		#customize category
		$myBody = "<p>
			The following listing of " . $myAction . " power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for " . $myAction . " power descriptions below can be found on the Range Tables (STC).
		</p>
		<p>
			These powers affect specific forms of animate and inanimate matter (substances as oppossed to energy) outside your character's physical body or beyond their physical means to reach and or otherwise affect. They include the various elemental powers you might expect, as well as the abiltiy to animate objects and transfrom items and in some cases even other characters (see oppossing characters character waiver for possible considerations).
		</p>
		";

		echo showOverview($myAction, $myBody);
		echo showCategory('matter-conversion-powers', $aarPowMatterConversion, $CodeName, $CharID);

		break;
	########################################################
	case "mental-enhancement-powers":
		#customize category
		$myBody = "<p>
			The following listing of " . $myAction . " power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for " . $myAction . " power descriptions below can be found on the Range Tables (STC).
		</p>
		<p>
			The list of heroes with mental powers is near endless these days, the descriptions here will help you to craft such a character if that is your interest. Mental powers are very valuable in that they have little visible effect, and the character using employing them is often hard to detect outright when doing so.
		</p>
		";

		echo showOverview($myAction, $myBody);
		echo showCategory('mental-enhancement-power', $aarPowMentalEnhancement, $CodeName, $CharID);

		break;
	########################################################
	case "physical-enhancement-powers":
		#customize category
		$myBody = "<p>
			The following listing of " . $myAction . " power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for " . $myAction . " power descriptions below can be found on the Range Tables (STC).
		</p>
		";

		echo showOverview($myAction, $myBody);
		echo showCategory('physical-enhancement-powers', $aarPowPhysicalEnhancement, $CodeName, $CharID);

		break;
	########################################################
	case "self-alteration-powers":
		#customize category
		$myBody = "<p>
			The following listing of " . $myAction . " power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for " . $myAction . " power descriptions below can be found on the Range Tables (STC).
		</p>
		<p>
			This category of powers incudes those which allow the hero to significantly modify their own form, becoming larger, smaller, lighter, or different in appearance. WHile thse modifications may have combat applications, they are not primarily offensive or defensive in nature.
		</p>
		";

		echo showOverview($myAction, $myBody);
		echo showCategory('self-alteration-powers', $aarPowSelfAlteration, $CodeName, $CharID);

		break;
	########################################################
	case "travel-powers":
		#customize category
		$myBody = "<p>
			The following listing of " . $myAction . " power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for " . $myAction . " power descriptions below can be found on the Range Tables (STC).
		</p>
		<p>
			As you might expect, all powers within this section affect the way inwhich a character can move within the story, whether by expaning the characters existing abilities or by introducing completely new capabilities such as displacement. It is up to the author to then take the descriptions and apply it to their character. Flight for instance can be accomplished in a variety of ways, from wingless unassisted flight to possessing weird and wild inhuman-like membranes which run along from under your arms down the complete length of your legs - anything is possible! Also consider what happens if something should go amiss, such as if they have rocket jets in their boots like Iron Man, and the Trapster should fire some flame retardent paste and snag the bottom of your characters boots, what do you do. What. Do. You. Do?
			<br />
			<br />
			Personally, I'd call Triple A and wait until they got their to explain the whole situation ;)
		</p>
		";

		echo showOverview($myAction, $myBody);
		echo showCategory('travel-powers', $aarPowTravel, $_GET['CodeName'], $CharID);

		break;
	########################################################
	default:
		#customize category
			$myBody = "<p>
					There is no rigid definition of a &quot;superpower&quot;. In popular culture, it may be used to describe anything from minimal exaggeration of normal human traits, magic, to godlike abilities that far exceed the scope of expectation or even possibility. Such super powered traits can be as simple as flight to the ability to projected unimagined destructive force with a simple look.</p>
				<p>
					Generally speaking, exceptional-but-not-superhuman fictional characters like the Avengers' <em>Black Widow</em> and <em>Hawkeye</em> or <em>Ka-zar</em> of the Savage Lands may be classified as superheroes although they do not have any &quot;actual&quot; superpowers. Common sense and an abilityt to think situations through should never be underestimated.</p>
				<p>
					Similarly, characters who derive their abilities from artificial or external sources such as <em>Iron Man's</em> robotic exoskelton, the <em>Winter Soldier</em> and his bionic limb or <em>Dr. Spectrum's</em> Soul Gem may be fairly described as having superpowers, but are not necessarily superhuman.</p>
				<p>
					Using the links from the power catorgys  you will find a great many descriptions of various super powers catagorized in to easily digestable bits. To view a catagory, either click on the links above to open one of the catagory containers, OR simply click on the 'plus' symbol attached to the catagory you wish to explore. Only one catagory can be open at a time. To close a catagory, click on another. Enjoy.</p>
				<p>
					<em class='text-muted'><b>Note</b> - Characters may routinely operate far below their shown scores shown, and sometimes far above those shown stats in extreme circumstances (with MOD approval). However, regardless of prior moderator approval, the player with the highest score (STAT/STAT CHAIN) always wins in a conflicted challenge.*</em>
					<br >
					<br >
				</p>";

				echo showOverview($myAction, $myBody, $CodeName, $CharID);;#END default

} #END switch


#CLOSE PAGE UP

/**
 * For each customer/domain, get a key from http://www.google.com/recaptcha/whyrecaptcha:
 * $publivkey, $privatekey moved to credentials to protect them
 *
 * Following moved to config_inc.php
 * $resp, $error, $skipFields, $fromDomain, $fromAddress,
 * $toAddress, $toName, $website, $sendEmail = TRUE
 *
 * Following moved to config_inc
 * include INCLUDE_PATH . 'recaptchalib_inc.php'; #required reCAPTCHA class code
 * include INCLUDE_PATH . 'contact_inc.php'; #complex unsightly code moved here
 */
echo '<h4><i>Do you have a suggestion for a word which might need defining?</i></h4>

			<form role="form" action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">';

			if (isset($_POST["recaptcha_response_field"])){# Check for reCAPTCHA response
				$resp = recaptcha_check_answer ($privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);

			if ($resp->is_valid){#reCAPTCHA agrees data is valid
				handle_POST($skipFields,$sendEmail,$toName,$fromAddress,$toAddress,$website,$fromDomain);#process form elements, format and send email.

			#Here we can enter the data sent into a database in a later version of this file
			echo "<!-- format HTML here to be your 'thank you' message -->
				<div class='text-center'><h2>Your Comments Have Been Received!</h2></div>
				<div class='text-center'>Thanks for the input!</div>
				<div class='text-center'>We'll respond via email within 48 hours, if you requested information.</div>";

				}else{#reCATPCHA response says data not valid - prepare for feedback
					$error = $resp->error;
					send_POSTtoJS($skipFields); #function for sending POST data to JS array to reload form elements
				}
			}

			#show form, either for first time, or if data not valid per reCAPTCHA
			if(!isset($_POST["recaptcha_response_field"])|| $error != "")
			{#separate code block to deal with returning failed data, or no data sent yet

echo '<!-- below change the HTML to accommodate your form elements - only "Name" & "Email" are significant -->

	<input
		type="text"
		name="Name"

		class="col-xs-5"
		required="true"

		title="Your Name is Required"
		placeholder="Your Name" />


	<input
		type="email"
		name="Email"

		class="col-xs-6 pull-right"
		required="true"

		title="A Valid Email is Required"
		placeholder="Your Email" />

		<br /><br /><br />

	<textarea
		class="form-control"
		rows="3"
		name="Comments"
		placeholder="Please use this space to outline your idea or suggestion..."></textarea>

		<br />


		<div class="capatcha pull-right">';

		echo recaptcha_get_html($publickey, $error);

		echo '</div>
		<div class="clearfix"></div>
		<br />

		<button type="submit" class="btn btn-success pull-right">Submit</button>

			</p>
		</form>';
			}

			echo '<br><br>

		</div>
	</div>
</div>';#END display


get_footer();


function showOverview($myAction = '', $myBody = '', $myCodeName='', $myCharID=0, $str=''){ #format descriptions from array and

	#remove the dashes used for urls
	$mySubjectTitle = str_replace('-', ' ', $myAction);

	$str  .= '<div class="container-fluid">
			<div class="row content">

				<div class="col-sm-3 sidenav">
				<br />';

	$str .= personalizeDescriptions();
	$str .= showLegend();

	$str .= '<br />
					<div class="input-group class="col-sm-3" >
						<input type="text" class="form-control" placeholder="Search To Come..">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button">
								<span class="glyphicon glyphicon-search"></span>
							</button>
						</span>
					</div>
				</div><!-- end sidebar-->

			<div class="col-sm-9">
				<h2>' . ucwords($mySubjectTitle) . '</h2>
				<h5><span class="glyphicon glyphicon-time"></span> Post by Monkee, July 5, 2016.</h5>
				<h5><span class="label label-danger">Powers</span> <span class="label label-primary">Character Creation</span></h5><br>';

	$str .= $myBody;

	$str .= '<p>
				<em class="text-muted"><b>Note</b> - Each entry has been formatted so as to allow you to easily use your text editors find and replace command to change the descriptors as detailed above with a few simple key strokes.*</em>
			</p>
			<hr />';

	return $str;
}

function showCategory($myTitle = '', $myArr = '', $myCodeName='', $myCharID=0){
	#generate category listing from array

	$str = ''; #initialize

	#if we have a codename
	if(empty($myCodeName)){$myCodeName='your character';}

	#format data and return
	foreach($myArr as $myKey => $myValue) {

		$str .= "<strong class='text-primary'>" . ucwords($myKey) . ":</strong>   " . $myValue = str_replace("XXXXcharnameXXXX", "<i class='text-primary'>" . $myCodeName . "</i>", $myValue);

		ucfirst($str);

		$str = preg_replace_callback('/[.!?] .*?\w/',
	create_function('$matches', 'return strtoupper($matches[0]);'), $str);

		$str = preg_replace_callback('/[.!?].*?\w/', create_function('$matches', 'return strtoupper($matches[0]);'), $str);

	}


	return $str;
	#if(isset($myCodeName)){echo $myCodeName;}
	#var_dump($_SESSION);
}

function showLegend($CodeName = '', $CharID = 0, $str='' ){ #generate category legend and links from array
	#$CodeName, $CharID are fed to us via Sh
	if(isset($_GET['CodeName'])){$CodeName = ($_GET['CodeName']); }
	if(isset($_GET['CharID'])){$CharID = ($_GET['CharID']); }

	$CharID = (int)$CharID; #cast as int to be safe.

	#used to creat links in the legend -- some &ndash; and asci code used to format some letters specifically
	$myTitles = [
			'defensive',  'detection',  'energy generation',  'energy emission',  'fighting',  'illusions',  'lifeform control',  'magic&ndash;&#76;ike ',  'matter control',  'matter conversion',  'mental enhancements', 'restricted', 'self&ndash;&#65;lteration', 'travel'
		];
	$myLoadedQuery = [
			'defensive-powers',  'detection-powers',  'energy-generation-powers',  'energy-emission-powers',  'fighting-enhancement-powers',  'illusion-powers',  'lifeform-control-powers',  'magic-powers',  'matter-control-powers',  'matter-conversion-powers',  'mental-enhancement-powers', 'restricted-powers', 'self-alteration-powers', 'travel-powers'
		];

	$str .= '<h4><a href="' . THIS_PAGE . '">Power Categories</a></h4>

		<ul class="nav nav-pills nav-stacked">';

	$count=0;

	foreach($myTitles as $title){
		$myLabel = str_replace("-", " ", $title);

		#if our switch matchs, highlight legend li
		$url  = $myLoadedQuery[$count];
		$chek = $_SERVER['REQUEST_URI']; #get url to test match too
		#clean url for first test
		$act = str_replace("/WrDK/traits/powers.php?act=","", $chek );

		#var_dump($CodeName);
		#var_dump($CharID);

		if($act == $url){
				$str .= '<li class="active">
					<a style="color: white;" href="'
						. VIRTUAL_PATH . 'library/powers.php?act='
						. $myLoadedQuery[$count++]
						. '&CodeName=' . $_SESSION['CodeName']
						. '&CharID=' . $CharID
						. '">'
						. ucwords($myLabel)
						. ' </a>
					</li>';

			#if title matches these, don't show unless admin or soemthing
			}else if($title == 'magic' || $title == 'restricted'){

				$str .= '<li>
					<a class="" href="' . VIRTUAL_PATH . 'library/powers.php?'
						. '&CodeName=' . $CodeName
						. '&CharID=' . $CharID
						. '">'
						. ucwords($myLabel)
						. '<sup>*<sup> </a>
					</li>';

					[$count++];

			#show me unhighlighted all others
			}else{
				$str .= '<li>
					<a  href="' . VIRTUAL_PATH . 'library/powers.php?act='
						. $myLoadedQuery[$count++]
						. '&CodeName=' . $CodeName
						. '&CharID=' . $CharID
						. '">'
						. ucwords($myLabel)
						. ' </a>
					</li>';
			}
	}

	$str .= '</ul>';

	return $str;
}

function personalizeDescriptions($str = ''){#form submits here we show entered name
	$str='<h4><a href="#">Customize Descriptions</a></h4>
		<p>Personalize all of the descriptions in this section by simply entering you character&quot;s name &mdash; Cheer!</p>

			<form action="' . THIS_PAGE . '" method="get">
				First name: <input type="text" name="CodeName"><br>

				<input type="hidden" name="CharID" value="0">
				<input type="submit" value="Submit">
			</form>
		<hr />';

	return $str;

}





















