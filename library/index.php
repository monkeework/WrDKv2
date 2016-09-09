<?php
function maxDoc_library_index(){
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

	#BEGIN CONFIG for contact form (Not General Contact Modal)
	# KEYs for Marvel-Champions
	# get key from http://www.google.com/recaptcha/whyrecaptcha:
	# $publickey = "6LdMUicTAAAAANeseG2cCgxXMMwIFFAa3TBzPzxI";
	# $privatekey = "6LdMUicTAAAAAL9NyDn2pVNfMO2x_MnkC0x9mNLE";
	# For each customer/domain, get a key from http://recaptcha.net/api/getkey

	#EDIT THE FOLLOWING:
	# $toAddress = "speedlanerunner@gmail.com, monkeework@gmail.com , chezshire@gmail.com";  //place your/your client's email address here ADDRESSES!
	# $toName = "Grandmaster, Gardener , Architect"; //place your client's name here
	# $website = "Marvel Champions";  //place NAME of your client's website/form here, ie: ITC280 Contact, ITC280 Registration, etc.
	# $sendEmail = TRUE; //if true,sends email, else shows user data.

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
			background: #000 url("../_img/_traits/bgSexuality.jpg") center center;
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

	#END   CONFIG for contact form (Not General Contact Modal)
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
	<b>Traits Directory</b></h1>

</div>';


switch ($myAction)
{//check 'act' for type of process
		case 'trait-aptitudes':

			require '../_inc/aarCharAptitudes-inc.php';

			#customize category
			$myBody = "
			<p>Below you will find an initial list of possible character skills descriptions for your character application. Please select those, if any which are approperiate for your character and copy them from this directory and paste them in to your characters &#39;Skill&#39; section. When pasting the descriptions, remember to <em> tailor</em>  the description to fit your character. Also, please proof read each and every description you place so that it is properly spellchecked. Failure to personalize descriptions will .</p>";

			#SHOW defensive

			echo showOverview($myAction, $myBody);

			echo showCategory('trait-aptitudes', $aarCharAptitudes, $CodeName, $CharID);
			#show secondary catagories to look at.

		break;
	########################################################
	case 'trait-archtypes':

			require '../_inc/aarCharArchtypes-inc.php';

			#customize category
			$myBody = "
				<p>
					What are Natures and Demeanors? Well, they are sort of like Jungian Archetypes. Each describes an essential form of your character's personality. A character's Nature shows the underlying element making up a persona (i.e., the &quot;true&quot; self), while the Demeanor is the &quot;face&quot; that the character shows to others around them. What follows is a list of Natures and Demeanors we are allowing, along with a (very) brief description of each.
				</p>
				<p>
					" . $myAction . "'s Nature is their basic personality, their fundamental behavior and perception of the world. We recommend setting a character Nature and a character Demeanor for your character as it helps the handler some initial measure of focus as they begin to craft their character. Doing so also helps those who are reviewing the character to get a quick initial read of how you plan to develop the character, thus getting everyone on the same page so to speak.
				</p>
				<p>
					Nature is not the only aspect of the characters true personality, merely the most dominant aspect. In contrast to a characters Nature, Demeanor is the image the character projected to the outside world. It does not impact the character's traits as Nature would, but instead is effectively how the character is perceived, or at least how they want to be perceived.
				</p>
				<p>
					For example, a character with a nature of Child and a demeanor of Celebrant would regain Willpower in situations where he gets someone to nurture or protect him, but overall acts like someone who enjoys life. His nature could manifest through a high degree of dependency, such as by partying until incapacitated and depending on someone to walk him home, provide a ride, or the like.
				</p>";

			#SHOW defensive

			echo showOverview($myAction, $myBody);

			echo showCategory('trait-archtypes', $aarCharArchtypes, $CodeName, $CharID);
			#show secondary catagories to look at.

		break;
	########################################################

	case 'trait-advantages':

			require '../_inc/aarCharAdvantages-inc.php';

			#customize category
			$myBody = "
			<p>
				" . $myAction . "'s Nature is their basic personality, their fundamental behavior and perception of the world. We recommend setting a character Nature and a character Demeanor for your character as it helps the handler some initial measure of focus as they begin to craft their character. Doing so also helps those who are reviewing the character to get a quick initial read of how you plan to develop the character, thus getting everyone on the same page so to speak.
			</p>
			<ol>
				<li>
					Please select between one and five advantages from the list below, copying those which are appropriate for your character from the provided list and pasting them in to your characters &#39;Advantages&#39; section.</li>
				<li>
					When pasting the descriptions, remember to please <em> tailor</em>  the given descriptions to fit your character. Make them relevant to the character AND their history, use examples and your character&#39;s name when and where possible.</li>
				<li>
					Also, please proof read each and every description you place so that it is properly spell checked.</li>
				<li>
					Feel free to make up your own advantages if you are unable to find the one you are looking for. Such as &quot;Farm Work&quot; for Cannonball because he grew up on one. Or &quot;Mother Figure&quot; if your character likes taking care of others. In fact, we encourage to have at least one unique ability for your character. But please remember to follow the site format when doing so.</li>
				<li>
					Finally, remember to personalize your character advantages. Please make them unique and personable to the character they describe. Failure to personalize descriptions is the #1 reason for <em> rejected</em>  applications on XPG.</li>
			</ol>";

			#SHOW advantages

			echo showOverview($myAction, $myBody);

			echo showCategory('trait-advantages', $aarCharAdvantages, $CodeName, $CharID);
			#show secondary catagories to look at.

		break;
	########################################################
	case 'trait-classification':

			require '../_inc/aarCharClassifications-inc.php';

			#customize category
			$myBody = "<p>
				The following listing of " . $myAction . " power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for " . $myAction . " power descriptions below can be found on the Range Tables (STC).
			</p>
			<ol>
				<li>Please select one character classificationfrom the list below.</li>
			</ol>";

			#SHOW defensive

			echo showOverview($myAction, $myBody);

			echo showCategory('trait-classifications', $aarCharClassification, $CodeName, $CharID);
			#show secondary catagories to look at.

		break;
	########################################################
		case 'trait-demeanors':

			require '../_inc/aarCharArchtypes-inc.php';

			#customize category
			$myBody = "
			<p>
				" . $myAction . "'s Nature is their basic personality, their fundamental behavior and perception of the world. We recommend setting a character's Nature as soon as possible as it helps you, the handler to commonicate your intention in how you will craft the character. Doing so also helps those who will review the character to get a quick initial read of how you plan to develop the character, thus getting everyone on the same page so to speak.
			</p>
			<p>
				For example, a character with a nature of Child and a demeanor of Celebrant would regain Willpower in situations where he gets someone to nurture or protect him, but overall acts like someone who enjoys life. His nature could manifest through a high degree of dependency, such as by partying until incapacitated and depending on someone to walk him home, provide a ride, or the like.
			</p>";

			#SHOW defensive

			echo showOverview($myAction, $myBody);

			echo showCategory('trait-archtypes', $aarCharArchtypes, $CodeName, $CharID);
			#show secondary catagories to look at.

		break;
	########################################################
	case 'trait-disadvantages':

			require '../_inc/aarCharDisadvantages-inc.php';

			#customize category
			$myBody = "
			<p>
				" . $myAction . "'s Nature is their basic personality, their fundamental behavior and perception of the world. We recommend setting a character Nature and a character Demeanor for your character as it helps the handler some initial measure of focus as they begin to craft their character. Doing so also helps those who are reviewing the character to get a quick initial read of how you plan to develop the character, thus getting everyone on the same page so to speak.
			</p>
			<ol>
				<li>
					Please select between one and five advantages from the list below, copying those which are appropriate for your character from the provided list and pasting them in to your characters &#39;Advantages&#39; section.</li>
				<li>
					When pasting the descriptions, remember to please <em> tailor</em>  the given descriptions to fit your character. Make them relevant to the character AND their history, use examples and your character&#39;s name when and where possible.</li>
				<li>
					Also, please proof read each and every description you place so that it is properly spell checked.</li>
				<li>
					Feel free to make up your own advantages if you are unable to find the one you are looking for. Such as &quot;Farm Work&quot; for Cannonball because he grew up on one. Or &quot;Mother Figure&quot; if your character likes taking care of others. In fact, we encourage to have at least one unique ability for your character. But please remember to follow the site format when doing so.</li>
				<li>
					Finally, remember to personalize your character advantages. Please make them unique and personable to the character they describe. Failure to personalize descriptions is the #1 reason for <em> rejected</em>  applications on XPG.</li>
			</ol>";

			#SHOW advantages

			echo showOverview($myAction, $myBody);

			echo showCategory('trait-disadvantages', $aarCharDisadvantages, $CodeName, $CharID);
			#show secondary catagories to look at.

		break;
	########################################################
		case 'trait-equipment':

			require '../_inc/aarCharEquipment-inc.php';

			#customize category
			$myBody = "
			<p>
				" . $myAction . "'s Nature is their basic personality, their fundamental behavior and perception of the world. We recommend setting a character Nature and a character Demeanor for your character as it helps the handler some initial measure of focus as they begin to craft their character. Doing so also helps those who are reviewing the character to get a quick initial read of how you plan to develop the character, thus getting everyone on the same page so to speak.
			</p>
			<p>
				Equipment is considered to be anything your character routinely carries on them. As such equipment lists should be reasonable, based on wieght and the volume of what YOUR character can reasonably carry on them. Below you will find an initial offering of sanctioned pieces of Equipment for your character to make use of. Please select those, if any which are approperiate for your character and copy them from this directory and paste them in to the &#39;Equipment&#39; field of your character application. When pasting the descriptions, please take a moment to proof read the pronoun descriptions and make sure that they properly reflect your characters gender and identity.
			</p>
			<p>
				<span style=\"color:#9ba9c5;\"><em> Note:</em>  Some items are considered to be rare, or have other extenuating circumstances which cause them to require specific &#39;mod&#39; approval to possess.</span>
			</p>
			<p>
				<span style=\"color:#9ba9c5;\"><em> Note:</em>  Each entry has been formatted so as to allow you to easily use your text editors find and replace command to change the descriptors as detailed above with a few simple key strokes.</span>
			</p>";

			#SHOW defensive

			echo showOverview($myAction, $myBody);

			echo showCategory('trait-equipment', $aarCharEquipment, $CodeName, $CharID);
			#show secondary catagories to look at.

		break;
	########################################################
		case 'trait-natures':

			require '../_inc/aarCharArchtypes-inc.php';

			#customize category
			$myBody = "
			<p>
				" . $myAction . "'s Nature is their basic personality, their fundamental behavior and perception of the world. We recommend setting a character's Nature as soon as possible as it helps you, the handler to commonicate your intention in how you will craft the character. Doing so also helps those who will review the character to get a quick initial read of how you plan to develop the character, thus getting everyone on the same page so to speak.
			</p>
			<p>
				For example, a character with a nature of Child and a demeanor of Celebrant would regain Willpower in situations where he gets someone to nurture or protect him, but overall acts like someone who enjoys life. His nature could manifest through a high degree of dependency, such as by partying until incapacitated and depending on someone to walk him home, provide a ride, or the like.
			</p>";

			#SHOW defensive

			echo showOverview($myAction, $myBody);

			echo showCategory('trait-archtypes', $aarCharArchtypes, $CodeName, $CharID);
			#show secondary catagories to look at.

		break;
	########################################################
		case 'trait-resources':

			#require '../_inc/aarCharResources-inc.php';

			#customize category
			$myBody = "<h2>RE (RESOURCES)</h2>
				<p>
					Resources represent a characters available cash. But, it isn&#39;t just about the money though. It is the ability to get money or valuable equipment through many, many channels It is the measure of personal wealth and influence and or lack their of which a character possesses. For example, Captain America is not a rich man, and never will be. Still, he is able to call on the vae resources of the Ultimates, S.H.I.E.L.D. and more then half the United States of America&#39;s Goverment because he is a living American legend. So, a Resource rank, in addition to being a volumn of money can also be something which your character has readily has access to, but does not regularily carry on their person.</p>

				<p>
					Below is a table which illustrates a characters RE (Resources) score with examples to help better gage what each rank represents.<br />
					Following the RE chart, you will find various descriptions XPG sanctioned Resources for your character application. Please select those, if any which are approperiate for your character and copy them from this directory and paste them in to your characters &#39;Disadvantages&#39; section. When pasting the descriptions, please take a moment to proof read the pronoun descriptions and make sure that they properly reflect your characters gender.</p>

				<table class=\"table table-hover\">
					<thead>
						<tr>
							<th>rank</th>
							<th>weekly rate</th>
							<th>maximum</th>
							<th>description</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>PA</td>
							<td>Poor (1r)</td>
							<td>0r</td>
							<td>No resources available to the character beyond what they have on them at the moment</td>
						</tr>
						<tr>
							<td>FE</td>
							<td>FEEBLE (2r)</td>
							<td>10r</td>
							<td>Reduced circumstances, unemployed or Social Security benefits<br />
				i.e. Aunt May</td>
						</tr>
						<tr>
							<td>PR</td>
							<td>POOR (4r)</td>
							<td>20r</td>
							<td>Freelance employment, bad credt risk<br />
				i.e. Peter Parker</td>
						</tr>
						<tr>
							<td>TY</td>
							<td>TYPICAL (6r)</td>
							<td>MAXIMUM</td>
							<td>Salaried Employment<br />
				i.e. Betty Brant</td>
						</tr>
						<tr>
							<td>GD</td>
							<td>GOOD (10r)</td>
							<td>100r</td>
							<td>Professional employmen<br />
				i.e. Dr. Strange, Moira MacTaggert, Rhodey Rhoades</td>
						</tr>
						<tr>
							<td>EX</td>
							<td>EXCELLENT (20r)</td>
							<td>500r</td>
							<td>Static Inheritance Fund<br />
				i.e. Marc Spectre, Moon Knight, Monet, Mist</td>
						</tr>
						<tr>
							<td>REM</td>
							<td>REMARKABLE (30r)</td>
							<td>1000r</td>
							<td>Small corporation
							<br />
							i.e. Fantastic Industries</td>
						</tr>
						<tr>
							<td>INC</td>
							<td>INCREDIBLE (40r)</td>
							<td>5000r</td>
							<td>Large corporation<br />
				i.e. Frost Enterprises, Shaw Industries, Pierce Corp.,<br />
				Stark International, The Stane Foundation</td>
						</tr>
						<tr>
							<td>AM</td>
							<td>AMAZING (50r)</td>
							<td>Small country</td>
							<td>Dr. Doom, Namor</td>
						</tr>
						<tr>
							<td>MON</td>
							<td>MONSTEROUS (75r)</td>
							<td>None</td>
							<td>Large nation<br />
				i.e. Canada, European Union, United States of America</td>
						</tr>
						<tr>
							<td>UN</td>
							<td>UNEARTHLY (100r)</td>
							<td>None</td>
							<td>Large nation<br />
				i.e. EGO-The Living Planet</td>
						</tr>
						<tr>
							<td>SX</td>
							<td>SHIFT-X (150r)</td>
							<td>None</td>
							<td>Small galactic union<br />
				Kree, Skrulls</td>
						</tr>
						<tr>
							<td>SY</td>
							<td>SHIFT-Y (200r)</td>
							<td>NONE</td>
							<td>Large galactic Union<br />
				Shi&#39;ar Empire</td>
						</tr>
						<tr>
							<td>SZ</td>
							<td>SHIFT-Z (500r)</td>
							<td>NONE</td>
							<td>Large galactic Union or Small interdimension empire<br />
				Shi&#39;ar Empire, Dormammu</td>
						</tr>
						<tr>
							<td>C1</td>
							<td>CLASS 1000 (1,000r)</td>
							<td>NONE</td>
							<td>TBD</td>
						</tr>
						<tr>
							<td>C3</td>
							<td>CLASS-3000 (3,000r)</td>
							<td>NONE</td>
							<td>TBD</td>
						</tr>
						<tr>
							<td>C5</td>
							<td>CLASS-5000 (10,000r)</td>
							<td>NONE</td>
							<td>TBD</td>
						</tr>
						<tr>
							<td>BYND</td>
							<td>BEYOND (10,000+r)</td>
							<td>NONE</td>
							<td>TBD</td>
						</tr>
					</tbody>
				</table>
			";



			#SHOW defensive

			echo showOverview($myAction, $myBody);
			#show secondary catagories to look at.

		break;
	########################################################

	case 'trait-sexuality':

			#SEE http://calpol25.hubpages.com/hub/Types-Sexuality-In-Humans.
			#customize category
			$myBody = "<p>
				The following listing of " . $myAction . " power summaries are gneral in their description to help create a character profile. Some characters may need more specific details to complete a profile and authors are highly encouraged to tweak the summaries that can be found here; Ranges for " . $myAction . " power descriptions below can be found on the Range Tables (STC).
			</p>

			<h3>The Seven Types Of Sexuality</h3>

			<ul>
					<li>
						Heterosexuality &mdash; Is the sexual attraction between members of the opposite sexes  such as man attracts to woman and woman attracts to man sexually.
					</li>
					<li>
						Homosexuality &mdash; is the sexual attraction between members of the same sexes such as man to man and woman to woman.sexually.
					</li>
					<li>
						Bisexuality &mdash; Is the sexual attraction to both the opposite and same sexes such as man to man and man to woman, woman to woman and woman to man.
					</li>
					<li>
						Asexuality &mdash; Is also known as nonsexuality which is the lack of sexual attraction and sexual interest towards others.
					</li>
					<li>
						Polysexuality &mdash; Is the sexual attraction to more than one gender but do not wish to be known as bisexual as it implies that their are only two binary sexes, do not confuse this with pansexuality (Pan meaning All) and (Poly meaning many).
					</li>
					<li>
						Pansexuality &mdash; Is the sexual attraction towards people regardless of gender also known as omnisexuality, some pansexuals refer to themselves as gender blind as to them gender is  insignificant in determining whether they will be sexually attracted to others.
					</li>
					<li>
						Transexualism &mdash; Is when a person identifies themselves with a physical sex that is different to their own biological one, A medical diagnosis can be made if a person experiences discomfort as a result of a desire to be a member of the opposite sex. for example a person may be born male, and is uncomfortable with their gender as a male  and changes to a female, or a female may change to a male. It is a long process that they will go through and an expensive one too.
					</li>
				<ul>
			";

			echo showOverview($myAction, $myBody);

		break;
	########################################################
	default:
		#customize category
			$myBody = "<p>
					What is a character Trait? Simply put it is anything which adds some amount of detail to the character. Where it is the color of their eyes, the team they are part of, or their secret headquarters located inside a volcano, it is considered to be a trait of the character which helps to add some measure of detail and description to whom the character is.</p>

					<p><em class='text-muted'><b>Note</b> - Not all character traits are defined here. Some simply do not require definition such as eye color, others have not yet presented the need for further detailing beyond what is already available in the character creation tool.</em>
					<br />
					<br />
				</p>";

				echo showOverview($myAction, $myBody, $CodeName, $CharID);;#END default

} #END switch



#CLOSE PAGE UP
echo '

			<h4><i>Do you have an idea for a possible character trait?</i></h4>

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
</div>';

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
			'character aptitudes', 'character archtypes', 'character advantages', 'character classifications', 'character demeanors', 'character disadvantages', 'character equipment', 'character natures', 'character resources', 'character sexuality'
		];
	$myLoadedQuery = [
			'character-aptitudes', 'trait-archtypes', 'trait-advantages', 'trait-classification', 'trait-demeanors', 'trait-disadvantages', 'trait-equipment', 'trait-natures', 'trait-resources', 'trait-sexuality'
		];

	$str .= '<h4><a href="' . THIS_PAGE . '">Trait Categories</a></h4>

		<ul class="nav nav-pills nav-stacked">';

	$count=0;

	foreach($myTitles as $title){
		$myLabel = str_replace("-", " ", $title);

		#if our switch matchs, highlight legend li
		$url  = $myLoadedQuery[$count];
		$chek = $_SERVER['REQUEST_URI']; #get url to test match too
		#clean url for first test
		$act = str_replace("/WrDK/library/index.php?act=","", $chek );

		#var_dump($CodeName);
		#var_dump($CharID);

		if($act == $url){
				$str .= '<li class="active">
					<a style="color: white;" href="'
						. VIRTUAL_PATH . 'library/index.php?act='
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
					<a class="" href="' . VIRTUAL_PATH . 'library/index.php?act='
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
					<a  href="' . VIRTUAL_PATH . 'library/index.php?act='
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
