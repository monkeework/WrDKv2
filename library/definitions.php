<?php
function maxDoc_library_Definitions(){
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
			background: #000 url("../_img/_bgs/bgDefinitions.jpg") center center;
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
	<b>Site Definitions</b></h1>

</div>';


switch ($myAction)
{//check 'act' for type of process
	case "defensive":

		#show secondary catagories to look at.
		echo showButtons();
		echo showCategory('defensive powers', $aarPowDefensive);

		break;
	########################################################
	case "detection":

		echo showButtons();
		echo showCategory('detection powers', $aarPowDetection);

		break;
	########################################################
	default:

		echo '
		<div class="container-fluid">
			<div class="row content">
				<div class="col-sm-3 sidenav">
					<h4>Legend</h4>';

					echo showLegend();

					echo '<br />

					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search Blog..">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button">
								<span class="glyphicon glyphicon-search"></span>
							</button>
						</span>
					</div>

					<br />

				</div>

				<div class="col-sm-9">

					<h2>Recently Added Definitions</h2>
					<h5><span class="glyphicon glyphicon-time"></span> Post by Monkee, July 5, 2016.</h5>
					<h5><span class="label label-danger">Powers</span> <span class="label label-primary">Character Creation</span></h5><br>';

					echo "
						<dl>
							<dt>STAT</dt>
							<dd>- A measure of a character's ability in a particular area.</dd>
							<dt>STAT CHAIN</dt>
							<dd>- The comparing of matching character STATs used to resolve a contested character conflict.</dd>
						</dl>

					";
















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
	<hr />
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
}



get_footer();


/*




						<p>
							RE (RESOURCES) - Resources represent a characters available cash. But, it isn&#39;t just about the money though. It is the ability to get money or valuable equipment through many, many channels It is the measure of personal wealth and influence and or lack their of which a character possesses. For example, Captain America is not a rich man, and never will be. Still, he is able to call on the vae resources of the Ultimates, S.H.I.E.L.D. and more then half the United States of America&#39;s Goverment because he is a living American legend. So, a Resource rank, in addition to being a volumn of money can also be something which your character has readily has access to, but does not regularily carry on their person.</p>

						<p>
							Below is a table which illustrates a characters RE (Resources) score with examples to help better gage what each rank represents.<br />
							Following the RE chart, you will find various descriptions XPG sanctioned Resources for your character application. Please select those, if any which are approperiate for your character and copy them from this directory and paste them in to your characters &#39;Disadvantages&#39; section. When pasting the descriptions, please take a moment to proof read the pronoun descriptions and make sure that they properly reflect your characters gender.</p>

						<p>
							&nbsp;</p>

						<table border="5" bordercolor="#050F1D" cellpadding="5" cellspacing="1" width="100%">
							<tbody>
								<tr>
									<th bgcolor="#050F1D" width="10%">
						RANK</th>
									<th bgcolor="#050F1D" width="20%">
						WEEKLY RATE</th>
									<th bgcolor="#050F1D" width="15%">
						MAXIMUM</th>
									<th bgcolor="#050F1D" width="55%">
						DESCRIPTION</th>
								</tr>
								<tr align="center">
									<td bgcolor="#050F1D"><font size="2">PA</font></td>
									<td><font size="2">PATHETIC (1r)</font></td>
									<td><font size="2">0r</font></td>
									<td><font size="2">No resources available to the character beyond what they have on them at the moment</font></td>
								</tr>
								<tr align="center">
									<td bgcolor="#050F1D"><font size="2">FE</font></td>
									<td bgcolor="#0d0e10"><font size="2">FEEBLE (2r)</font></td>
									<td bgcolor="#0d0e10"><font size="2">10r</font></td>
									<td bgcolor="#0d0e10"><font size="2">Reduced circumstances, unemployed or Social Security benefits<br />
						<span style="color:#9ba9c5;"><em> i.e. Aunt May</em> </span></font></td>
								</tr>
								<tr align="center">
									<td bgcolor="#050F1D"><font size="2">PR</font></td>
									<td><font size="2">POOR (4r)</font></td>
									<td><font size="2">20r</font></td>
									<td><font size="2">Freelance employment, bad credt risk<br />
						<span style="color:#9ba9c5;"><em> i.e. Peter Parker</em> </span></font></td>
								</tr>
								<tr align="center">
									<td bgcolor="#050F1D"><font size="2">TY</font></td>
									<td bgcolor="#0d0e10"><font size="2">TYPICAL (6r)</font></td>
									<td bgcolor="#0d0e10"><font size="2">MAXIMUM</font></td>
									<td bgcolor="#0d0e10"><font size="2">Salaried Employment<br />
						<span style="color:#9ba9c5;"><em> i.e. Betty Brant</em> </span></font></td>
								</tr>
								<tr align="center">
									<td bgcolor="#050F1D"><font size="2">GD</font></td>
									<td><font size="2">GOOD (10r)</font></td>
									<td><font size="2">100r</font></td>
									<td><font size="2">Professional employmen<br />
						<span style="color:#9ba9c5;"><em> i.e. Dr. Strange, Moira MacTaggert, Rhodey Rhoades</em> </span></font></td>
								</tr>
								<tr align="center">
									<td bgcolor="#050F1D"><font size="2">EX</font></td>
									<td bgcolor="#0d0e10"><font size="2">EXCELLENT (20r)</font></td>
									<td bgcolor="#0d0e10"><font size="2">500r</font></td>
									<td bgcolor="#0d0e10"><font size="2">Static Inheritance Fund<br />
						<span style="color:#9ba9c5;"><em> i.e. Marc Spectre, Moon Knight, Monet, Mist</em> </span></font></td>
								</tr>
								<tr align="center">
									<td bgcolor="#050F1D"><font size="2">REM</font></td>
									<td><font size="2">REMARKABLE (30r)</font></td>
									<td><font size="2">1000r</font></td>
									<td><font size="2">Small corporation
									<br />
									<span style="color:#9ba9c5;"> <em> i.e. Fantastic Industries</em> </span></font></td>
								</tr>
								<tr align="center">
									<td bgcolor="#050F1D"><font size="2">INC</font></td>
									<td bgcolor="#0d0e10"><font size="2">INCREDIBLE (40r)</font></td>
									<td bgcolor="#0d0e10"><font size="2">5000r</font></td>
									<td bgcolor="#0d0e10"><font size="2">Large corporation<br />
						<span style="color:#9ba9c5;"><em> i.e. Frost Enterprises, Shaw Industries, Pierce Corp.,<br />
						Stark International, The Stane Foundation</em> </span></font></td>
								</tr>
								<tr align="center">
									<td bgcolor="#050F1D"><font size="2">AM</font></td>
									<td><font size="2">AMAZING (50r)</font></td>
									<td><font size="2">Small country</font></td>
									<td><font size="2">Dr. Doom, Namor</font></td>
								</tr>
								<tr align="center">
									<td bgcolor="#050F1D"><font size="2">MON</font></td>
									<td bgcolor="#0d0e10"><font size="2">MONSTEROUS (75r)</font></td>
									<td bgcolor="#0d0e10"><font size="2">None</font></td>
									<td bgcolor="#0d0e10"><font size="2">Large nation<br />
						<span style="color:#9ba9c5;"><em> i.e. Canada, European Union, United States of America</em> </span></font></td>
								</tr>
								<tr align="center">
									<td bgcolor="#050F1D"><font size="2">UN</font></td>
									<td><font size="2">UNEARTHLY (100r)</font></td>
									<td><font size="2">None</font></td>
									<td><font size="2">Large nation<br />
						<span style="color:#9ba9c5;"><em> i.e. EGO-The Living Planet</em> </span></font></td>
								</tr>
								<tr align="center">
									<td bgcolor="#050F1D"><font size="2">SX</font></td>
									<td bgcolor="#0d0e10"><font size="2">SHIFT-X (150r)</font></td>
									<td bgcolor="#0d0e10"><font size="2">None</font></td>
									<td bgcolor="#0d0e10"><font size="2">Small galactic union<br />
						<span style="color:#9ba9c5;"><em> Kree, Skrulls</em> </span></font></td>
								</tr>
								<tr align="center">
									<td bgcolor="#050F1D"><font size="2">SY</font></td>
									<td><font size="2">SHIFT-Y (200r)</font></td>
									<td><font size="2">NONE</font></td>
									<td><font size="2">Large galactic Union<br />
						<span style="color:#9ba9c5;"><em> Shi&#39;ar Empire</em> </span></font></td>
								</tr>
								<tr align="center">
									<td bgcolor="#050F1D"><font size="2">SZ</font></td>
									<td bgcolor="#0d0e10"><font size="2">SHIFT-Z (500r)</font></td>
									<td bgcolor="#0d0e10"><font size="2">NONE</font></td>
									<td bgcolor="#0d0e10"><font size="2">Large galactic Union or Small interdimension empire<br />
						<span style="color:#9ba9c5;"><em> Shi&#39;ar Empire, Dormammu</em> </span></font></td>
								</tr>
								<tr align="center">
									<td bgcolor="#050F1D"><font size="2">C1</font></td>
									<td><font size="2">CLASS 1000 (1,000r)</font></td>
									<td><font size="2">NONE</font></td>
									<td><font size="2">TBD</font></td>
								</tr>
								<tr align="center">
									<td bgcolor="#050F1D"><font size="2">C3</font></td>
									<td bgcolor="#0d0e10"><font size="2">CLASS-3000 (3,000r)</font></td>
									<td bgcolor="#0d0e10"><font size="2">NONE</font></td>
									<td bgcolor="#0d0e10"><font size="2">TBD</font></td>
								</tr>
								<tr align="center">
									<td bgcolor="#050F1D"><font size="2">C5</font></td>
									<td><font size="2">CLASS-5000 (10,000r)</font></td>
									<td><font size="2">NONE</font></td>
									<td><font size="2">TBD</font></td>
								</tr>
								<tr align="center">
									<td bgcolor="#050F1D"><font size="2">BYND</font></td>
									<td bgcolor="#0d0e10"><font size="2">BEYOND (10,000+r)</font></td>
									<td bgcolor="#0d0e10"><font size="2">NONE</font></td>
									<td bgcolor="#0d0e10"><font size="2">TBD</font></td>
								</tr>
							</tbody>
						</table>
						<p>
							&nbsp;</p>

						<hr >
						<p>
							Below you will find an initial list of site specific sanctioned Resources which you can use for your character application on XPG. Please select those, if any, which are approperiate for your character and copy them from directly in to your characters &#39;Resources&#39; field of your character application. When pasting the descriptions, please take a moment to proof read and update the pronoun descriptions, taking time to make sure that they properly reflect your characters gender. Additionally, you are encourage to personalize the write-ups if it will help improve the resource as it relates to your character. An example might be selecting &#39;Home&#39; and changing it to &#39;Town House&#39; because your character&#39;s home is a Town house.</p>



						<hr >
						<p>
							<span style="color:#5bb3ff;">CEREBRA:</span> Created by Professor Charles Francis Xavier with help from Dr. Moira MacTaggart and Eric Lensherr, it was later enhanced by Dr. Henry Patrick McCoy. Originally called Cerebro which is Spanish and Portuguese for &quot;brain&quot;, it is a device that the X-Men use to find, detect, catalog and keep track of mutants the world wide. The current version of Cerebro is called Cerebra.<br />
							Note: Mod approval is required.</p>

						<p>
							<span style="color:#5bb3ff;">MAINFRAME:</span> A large, centrally located computer/server. (often colloquially referred to as Big Iron) are computers used mainly by large organizations for critical applications, typically bulk data processing such as census, industry and consumer statistics, ERP, and financial transaction processing.</p>

						<p>
							<span style="color:#5bb3ff;">OCCULT LIBRARY - Variable:</span> A collection of texts, tombs, scrolls, artifacts and other objects which reflect an interest and or ongoing study of the occult and other related phenomena. <span style="color:#9ba9c5;"><em> Note:</em>  The Library&#39;s rank determines how accurate it is, rather then it&#39;s size. The right book could be equal to all the collected works of the New York Public Library for instance or even that of the Congressional Library.</span></p>

						<ol>
							<li>
								00 - Description to come (Example to come)</li>
							<li>
								02 - Description to come (The Frog Brothers comic book collection)</li>
							<li>
								04 - have one book on the occult. It might have some spells. (Public Library)</li>
							<li>
								06 - Description to come (Batman, Hugo Strange)</li>
							<li>
								08 - Several books on various subjects. It has some spells. (Clea&#39;s Library)</li>
							<li>
								10 - <em> CN</em>  have a good collection including some rare tomes. +1 bonus to all research rolls.<em> CN</em>  have quite a few spells in the books. (Example to come)</li>
							<li>
								12 - Description to come (Dr. Druid)</li>
							<li>
								14 - Description to come (Example to come)</li>
							<li>
								16 - Monster research rolls are at +2. Any number of spells can be found there. <em> CN</em>  must have an Occultism of at least 3 to assemble the library. (Example to come)</li>
							<li>
								18 - Description to come (Dr. Strange)</li>
							<li>
								20 - Any number of spells can be found there. <em> CN</em>  must have an Occultism of at least 6 to assemble the library. This Occult Library can only be found in specialized organizations. Putting together a collection of this size grants at least Adversary 2 to its owner, as others will come to steal it. (Lucien, the Library of Dreams)</li>
						</ol>
						<p>
							&nbsp;</p>

						<p>
							<span style="color:#5bb3ff;">TRUST FUND:</span> <span style="color:#9ba9c5;">X</span> is a &#39;Trust Fund Baby&#39; has a rather sizable trust, and as such has considerable financial resources at <em> her/his</em>  readily disposal.<br />
							<span style="color:#9ba9c5;"><em> Note:</em>  The size of <em> her/his</em>  trust fund is determined by it&#39;s assigned rank-see the chart below for rank value. Also, please note that the value selected indicates the amount of hard cash available to a character in a single month.</span></p>

						<ol>
							<li>
								00 - Up to $750.00 (Unemployed, Social Security or allowance)</li>
							<li>
								02 - Up to $2500 (Freelance, lower middle class, students)</li>
							<li>
								04 - Up to $20,000 (Salaried employment, middle class)</li>
							<li>
								06 - Up to $80,000 (Professional employment, middle class)</li>
							<li>
								08 - Up to $300,000 (Small ineritance or business, upper middle class)</li>
							<li>
								10 - Up to $1,000,000 (Large business or chain, trust fund, upper class)</li>
							<li>
								12 - Up to $4,000,000 (Standard corporation, millionaire)</li>
							<li>
								14 - Up to $15,000,000 (Large corporation, small country)</li>
							<li>
								16 - Up to $50,000,000 (Multinational corp., govt. branch of major country)</li>
							<li>
								18 - Up to $200,000,000 (Large Multinational corp., small govt.)</li>
							<li>
								20 - Up to $800,000,000 (Large Government.)</li>
						</ol>
						<p>
							&nbsp;</p>

						<p>
							<span style="color:#5bb3ff;">WORTHINGTON ENTERPRISES:</span> Based in San Francisco, Worthington Enterprises was founded in the seventeenth century as a merchant house, eventually becoming a large multinational conglomerate. The company opened new subsidiaries, such as <em> Worthington Technologies, Worthington Biotech, Worthington Food Group, Worthington Shipping, Worthington Steel, ShipWorth Ship Builders, Inc., Worthington Aerospace, Worthington Chemicals, Worthington Industries, Worthington Medical, Worthington Electronics, Worthington Entertainment</em>  and the prestigious <em> Worthington Foundation</em> , while shutting down others, such as <em> Worthington Manufacturing</em> .<br />
							<span style="color:#9ba9c5;"><em> Note:</em>  <em> CN</em> s access to each of Worthington Enterprises is determined by their rank. A Rank of Zero indicates that they can&#39;t even get in to the front lobby, while a rank of Ten indicates that no part of the enterprise is off limits to them.</span></p>

						<ul>
							<li>
								<span style="color:#9ba9c5;"><em> WORTHINGTON BOITECH</em> </span> - Worthington Biotech is the company mostly responsible for the Gotham healthcare system. The company itself is a facility for researching and developing new medical procedures and systems. It also trains and teaches a huge number of people annually. Worthington Chemicals and Worthington Pharmaceuticals work closely with Worthington Biotech to develop medicines for different diseases. The current research at Worthington Biotech is focused on finding the cure for cancer. Since the human genome has already been unlocked, Worthington Biotech is studying cloning to produce organs for future transplants. The company is involved in research into brain surgery methods, the fight against AIDS and HIV, and reconstructive plastic surgery. Batman uses Worthington Biotech as a research tool for finding medical information, patient histories and information on illnesses.</li>
							<li>
								<span style="color:#9ba9c5;"><em> WORTHINGTON AREOSPACE</em> </span> - Worthington Aerospace builds luxurious and exclusive corporate and private jets and airliners. Its experimental aviation branch produces experimental and research planes built for the United States government and NASA. The military aviation branch designs and manufactures jet fighters and helicopters for the US military. The most notable models of these are the W-4 Wraith fighter and the Kestrel attack helicopter. Worthington Aerospace maintains competition with other aerospace corporations like Ferris Air and LexAir.</li>
							<li>
								<span style="color:#9ba9c5;"><em> WORTHINGTON CHEMICALS</em> </span> - Worthington Chemicals controls Worthington Oil, Worthington Pharmaceuticals and Worthington Botanical. Worthington Chemicals also has a small percentage of ownership in Tyler Chemicals, based in New York City. Worthington Chemicals is primarily a research and development firm. Worthington Oil researches petrochemicals and alternative fuel sources. Worthington Chemicals is the first company to have created a power generator using algae. Worthington Pharmaceuticals is another one of Worthington Chemicals&#39; research and development branches.</li>
							<li>
								<span style="color:#9ba9c5;"><em> WORTHINGTON ELECTRONICS</em> </span> - Worthington Electronics is a large consortium that manufactures portable radios, stereo and Hi-Fi systems, movie cameras, cameras and electronics, measuring devices, scanners, surveillance equipment, computers and other electronics devices. Its other branches of business include information technology, wired networks, wireless networks and space exploration systems and satellites. It also has contracts with the aerospace, nautical and military industries.</li>
							<li>
								<span style="color:#9ba9c5;"><em> WORTHINGTON ENTERTAINMENT</em> </span> - Worthington Entertainment owns many arenas and stadiums in Gotham and has leased out the Sommerset Stadium to the Metropolis Monarchs. Furthermore, Worthington Entertainment has working partnerships with several modeling agencies and multimedia houses and provides a large number of contacts and information. The Daily Planet newspaper, where Superman and his wife, Lois Lane, work, is operated by Worthington Entertainment. Worthington Entertainment is in direct competition with WGBS (run by Galaxy Communications) and LexCom (run by LexCorp). Those companies, along with other television and movie companies provide the same services as Worthington Entertainment. Through Worthington Entertainment, Batman has contacts in the media and entertainment industries.</li>
							<li>
								<span style="color:#9ba9c5;"><em> WORTHINGTON FOODS</em> </span> - Worthington Foods is a little known subsidiary of WayneTech mostly based in Gotham City. It runs farms and cattle ranches in the Midwest United States, and imports beef from Argentina and other countries. Worthington Foods produces specialized products like ecological foods and natural lines with no additives and controlled growing. Batman uses Worthington Foods as a means to keep tabs on the food produce market.</li>
							<li>
								<span style="color:#9ba9c5;"><em> WORTHINGTON INDUSTRIES</em> </span>&gt; - Worthington Industries is a research and development company used for industrial purposes. The company studies, researches and develops cleaner, mechanical fission and fusion power plants and also owns many factories and normal labor units, from manufacturing cars to making cloth and so on. Worthington Mining is also a part of Worthington Industries, along with the few power stations the company owns. Worthington Mining mostly produces gold and some precious stones in Africa.</li>
							<li>
								<span style="color:#9ba9c5;"><em> WORTHINGTON MEDICAL</em> </span> - Worthington Medical is Worthington Biotech&acirc;&euro;&trade;s sister company but both have different fields of study and work. Worthington Medical handles most of the healthcare system in Gotham and also studies cancer and AIDS with Worthington Biotech. Worthington Medical is focused more on treating illnesses than researching them and maintains and runs many hospitals in Gotham City and helps the Foundation with the orphanages.</li>
							<li>
								<span style="color:#9ba9c5;"><em> WORTHINGTON FOUNDATION</em> </span> - The Worthington Foundation is the holding company for the Thomas Worthington Foundation and the Martha Worthington Foundation. The Worthington Foundation funds scientific research and helps people with research by providing facilities and training.<br />
								The foundation has its own building called the Worthington Foundation Building which includes a penthouse where Batman lived for a period of time. It also has a secret elevator which leads to a matching Batcave in a secret sub-basement under the building.<br />
								Through the Worthington Foundation and the organizations underneath, Batman has a very large network of connections in the world of charities. He finds out about the newest trends and newest arts, but at the same time he has connections to the streets through the soup kitchens and social services groups.</li>
							<li>
								<span style="color:#9ba9c5;"><em> WORTHINGTON SHIPPING</em> </span> - Worthington Shipping owns dozens of freighters and handles three and a half billion tons of freight each month and is used by Batman to gain an inside view on smuggling and drug trafficking.</li>
							<li>
								<span style="color:#9ba9c5;"><em> WORTHINGTON STEEL</em> </span> - Worthington Steel is one of the oldest steel mills and metal refineries in Gotham and supplies steel for shipbuilding. It also studies and replicates alien technology. This has also led to Batman getting priority on technology and alloys for him to study. Worthington Steel&#39;s alliance with the US Navy and the government has produced numerous contacts for Worthington Enterprises.</li>
							<li>
								<span style="color:#9ba9c5;"><em> SHIPWORTH SHIP BUILDING, INC.</em> </span> - Also known as WayneYards is responsible for the building of a large number of naval warships, commercial, and private ships and is currently building a Nimitz class aircraft carrier in Gotham. WayneSteel and WayneYards facilities repair a large number of cruisers and destroyers and also has contacts within the upper pylons of the Navy and the global maritime business.</li>
							<li>
								<span style="color:#9ba9c5;"><em> WORTHINGTON TECHNOLOGIES</em> </span> - Worthington Technologies, also known as WorthTech, is the biggest division of Worthington Enterprises. It is involved in the retrieval and research of alien technology. Its main rival is <em> Stark Enterprises</em> . The subsidiary is sometimes used by X-Men as a means to acquire new technologies or to use the medical facilities.<br />
								Other subsidiaries of WorthTech include: Holt Holdings Inc., Worthington Biotech, Worthington Pharmaceuticals, and Worthington Healthcare, which runs a great many of the west coast&#39;s healthcare systems.</li>
							<li>
								<span style="color:#9ba9c5;"><em> WARREN K. WORTHINGTON FOUNDATION</em> </span> - The Warren K. Worthington Foundation is a foundation for medicine and medical help. This foundation gives annual awards for medical breakthroughs and lifelong commitment, similar to the Nobel Foundation. The Kenneth Worthington Foundation is also responsible for funding the Kenneth Worthington Memorial Clinic in Park Row, San Francisco&#39;s infamous &#39;Tin Pan Alley&#39;. The foundation funds and runs dozens of other free clinics all over the city and in other trouble cities.</li>
							<li>
								<span style="color:#9ba9c5;"><em> KATHYRN WORTHINGTON FOUNDATION</em> </span> - The Kathryn Worthington Foundation is a patron and supporter of arts, families, education and tolerance. The foundation supports and helps to run a number of orphanages and free schools, and provides teachers for those who have learning difficulties. Artists can apply for grants from the foundation to help support them in furthering the arts. The foundation sponsors companies like Family Finders Inc. in Gotham. Family Finders is an organization directed at finding lost people and uniting families. The foundation sponsors and runs dozens of soup kitchens within the city.</li>
							</ul>


*/






$arrFaqS = [
	"STAT" => "A measure of a character's ability in a particular area.",
	"STAT chain" => "The comparing of matching character STATs used to resolve a contested character conflict."
];

$arrFaqP = [
	"power" => "The comparing of matching character STATs used to resolve a contested character conflict.",

	"power, bonus" => "This is a power that is automatically included as part of the package with certain other powers. The hero must take a stated bonus power and place it in one of his remaining power slots. If none are available, he must discard an already chosen power or the power to which the bonus power is attached.",

	"power, nemesis" => "This is a power that directly opposes or even defeats the power in question; think of it in terms of fire and water. The player cannot choose a nemesis! The nemeses are listed primarily for the Judge's benefit when choosing or creating suitable opponents for the heroes.",

	"power, optional" => "This is a power that is commonly associated with the already determined power. Players have the option of selecting one or more of these powers to fill their remaining power slots; this enables the player to tailor his hero's powers, Previously determined powers can be discarded in favor of the optional power.",

	"power, rank" => "A measure of a character's ability in a particular area.",

	"power stunt" => "The comparing of matching character STATs used to resolve a contested character conflict."

];

$arrFaqR = [
	"rank" => "A measure of a character's ability in a particular area.",
	"STAT Chain" => "The comparing of matching character STATs used to resolve a contested character conflict."
];


function showLegend(){
	$myLetters = range("a","z");
	$str  = "";
	$str .= '<ul class="nav nav-pills nav-stacked">';
	$count=0;
	$str .= '<ul class="nav nav-pills nav-stacked">';

	foreach($myLetters as $letter){

		if($letter == $letter){
				$str .= '<li>
					<a href="' . VIRTUAL_PATH . 'traits/add.php?act=' . $letter . '"> '
						. ucfirst($letter)
						. ' </a>
					</li>';
			}else{
				$str .= '<li>
					<a href="' . VIRTUAL_PATH . 'traits/add.php?act=' . ucfirst($letter) . '">'
						. $letter
						. ' </a>
					</li>';
			}

	}

	$str .= '</ul>';

	return $str;
}

function showCategory($myTitle = '', $myArr = ''){
		echo "<h3> {$myTitle} </h3>";

			foreach($myArr as $myKey => $myValue) {
				echo "<br><br><strong class='text-primary'>" . $myKey . ":</strong>   " . $myValue = str_replace("XXXXcharnameXXXX", "<i class='text-primary'>the hero</i>", $myValue);
			}
		}

?>
