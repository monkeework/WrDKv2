<?php
function maxDoc_library_FAQ(){
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
			background: #000 url("../_img/_bgs/bgFAQs00.jpg") center center;
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
	<b>FAQs</b></h1>

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

					<h2>Recent FAQ\'s</h2>
					<h5><span class="glyphicon glyphicon-time"></span> Post by Monkee, July 5, 2016.</h5>
					<h5><span class="label label-danger">Powers</span> <span class="label label-primary">Character Creation</span></h5><br>';

					echo "
						<dl>
							<dt>STAT</dt>
							<dd>- A measure of a character's ability in a particular area.</dd>
							<dt>STAT CHAIN</dt>
							<dd>- The comparing of matching character STATs used to resolve a contested character conflict.</dd>
						</dl>




						<ul>
							<li>
								<strong>How Many Characters Can I Play?</strong>
							<br >
								Up to three providing posting minimums are consistantly met. 2 posts within a 7 day rotating period, 150 words minimum per post. Up to 3 Canon or FC&#39;s and 2 Original or OC&#39;s. Your first character must be an FC.</li>
						</ul>
						<ul>
							<li>
								<strong>Can I Play An Original Character Of My Own Making?</strong><br >
								YES! You are now allowed to submit an Original Character that have been in play on other RPG sites, provided they are altered properly to fit our movie-verse history.</li>
						</ul>
						<ul>
							<li>
								<strong>How Powerful Can My Original Character Be?</strong><br >
								We prefers OC characters limit their stats to Incredible or less, and that the classification not exceed the Epsilon level. Additionally, when making an OC, it is best to check with a Mentor first to make sure your conncept is acceptable toWe- Failure to check may result in the deletion of your unapporved work without warning.</li>
						</ul>
						<ul>
							<li>
								<strong>Can I Play A Featured Character Like Cyclops?</strong><br >
								YES! The Cerebra Database is chock full of fantastic characters that are open for your adoption. Simply use the handly little drop down box labeled IN PLAY, scroll down to AVAILIBLE, and hit enter. This will bring you to a page of neat characters that are currently looking for a player!</li>
						</ul>
						<ul>
							<li>
								<strong>Can I Play A Villian Like Magneto?</strong><br >
								No. We prefers that the villains stay mysterious and in the hands of the Site Storytellers.</li>
						</ul>
						<p>
							Any other questions regarding this aspect ofWeshould be directed to the moderators ofWe.</p>

					";

					echo '<br>'; #END display

}




#CLOSE PAGE UP
echo '<hr >
	<h4><i>Do you have a Question for us?</i></h4>

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
