<?php
function maxDoc_library_index(){
	/**
	 * based on add.php, pbChek.php is a single page web application
	 * pvChek displays all actively quantified, available/unused/unclaimed playby site options.
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
	<li> Review/update function checkForm(thisForm)</li>
	<li> used pb chek</li>';

# '../' works for a sub-folder.  use './' for the root
require '../_inc/config_inc.php'; #configuration, pathing, error handling, db credentials
	$config->titleTag = smartTitle(); #Fills <title> tag. 
	$config->metaDescription = smartTitle() . ' - ' . $config->metaDescription;


	#$config->metaDescription = 'Web Database ITC281 class website.'; #Fills <meta> tags.
	#$config->metaKeywords = 'SCCC,Seattle Central,ITC281,database,mysql,php';
	#$config->metaRobots = 'no index, no follow';
	# The config property named 'loadHead' places JS, CSS, etc. inside the <head> tag - only use double quotes, or escape them!
	$config->loadhead = '<script type="text/javascript" src="' . VIRTUAL_PATH . '_js/util.js"></script>
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
			background: #000 url("../_img/_bgs/bgPlayBy00.jpg") center center;
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



	#END   CONFIG for contact form (Not General Contact Modal)

//END CONFIG AREA ----------------------------------------------------------


# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if(isset($_REQUEST['act'])){$myAction = (trim($_REQUEST['act']));}else{$myAction = "";}

$dirPath = $gender = $pbExt = $pbName = $pbPath = ''; #initialize

if(isset($_GET['act'])){
	$gender = $_GET['act'];
}else{ $gender = '';}

#get hidden values to personize page with.
if($gender == 'm'){
	#get gender setting
	$gender = 'male';
	$prefix = 'm';
}else if($gender == 'f'){
	#initialize the vars if they empty
	$gender = 'female';
	$prefix = 'f';
}else{
	#initialize the vars if they empty
}

global $config;


get_header();

echo MaxNotes($pageDeets); #notes to me!

echo "
	<div class='jumbotron'>
		<h1 style='margin: 0 0 -35px -35px;'><br /><br /><br /><br />
		<b>Playbys</b></h1>
	</div>


	<div class='container-fluid'>

		<div class='row content'>
			<div class='col-sm-3 sidenav'>
			
			<br />

				<a href='?act=f' class='btn btn-primary btn-xs'>Female Playbys</a>
				 &nbsp;
				<a href='?act=m' class='btn btn-primary  btn-xs'>Male Playbys</a><br /><br />
				
				<select class='selectpicker' data-style='btn-primary' 
					multiple data-max-options='1'
					>
					<option selected>Search by Gender...</option>
					<option value='gF'>Gender - Female</option>
					<option value='gM'>Gender - Male</option>
				</select>

				<br /><br />

				<select class='selectpicker' 
					data-style='btn-primary' 
					multiple data-max-options='1'
					>
					<option selected>Search by Hair Color...</option>
					<option value='hBk'>Hair - Black</option>
					<option value='hBn'>Hair - Brown</option>
					<option value='hBe'>Hair - Blonde</option>
					<option value='hAn'>Hair - Auburn</option>
					<option value='hCt'>Hair - Chestnut</option>
					<option value='hWt'>Hair - Red</option>
					<option value='hGy'>Hair - Grey</option>
					<option value='hWe'>Hair - White</option>
				</select>

				<br /><br />

				<select class='selectpicker' 
					data-style='btn-primary' 
					multiple data-max-options='1'
					>
					<option selected>Search by Eye Color...</option>
					<option value='hBl'>Eyes - Black</option>
					<option value='eBe'>Eyes - Blue</option>
					<option value='eBn'>Eyes - Brown</option>
					<option value='hGn'>Eyes - Green</option>
					<option value='hGy'>Eyes - Grey</option>
					<option value='eAr'>Eyes - Amber</option>
					<option value='eHl'>Eyes - Hazel</option>
					<option value='hRd'>Eyes - Red</option>
					<option value='eVt'>Eyes - Violet</option>
				</select>

				<br /><br />

				<select class='selectpicker' 
					data-style='btn-primary' 
					multiple data-max-options='1'
					>
					<option selected>Search by Body Type...</option>
					<option value='pSm'>Physique - Heroic</option>
					<option value='pAc'>Physique - Athletic</option>
					<option value='pFt'>Physique - Lanky</option>
					<option value='pAc'>Physique - Trim</option>
					<option value='pOt'>Physique - Overweight</option>
					<option value='pOe'>Physique - Obese</option>
				</select>

				<br /><br />

				<select class='selectpicker' 
					data-style='btn-primary' 
					multiple data-max-options='1'
					>
					<option selected>Search By Race...</option>
					<option value='rAp'>Race - Asian/Pacific</option>
					<option value='rAa'>Race - Afro American</option>
					<option value='rLs'>Race - Latino/Spanish</option>
					<option value='rNa'>Race - Native American</option>
					<option value='rWe'>Race - White</option>
				</select>

				<br /><br />

<!-- <a href='?act=f&name=some_one'-->


			<div class='input-group'>
				<input type='text' 
					class='form-control' 
					placeholder='Check For Specific Playby'>
				<span class='input-group-btn'>
					<button class='btn btn-default' type='button'>
						<span class='glyphicon glyphicon-search'></span>
					</button>
				</span>
			</div>

				<br />

			</div>
			<div class='col-sm-9'>";


switch ($myAction)
{//check 'act' for type of process
	case "m":
		#show available male casting options.
		echo "<h3>Current Unclaimed <b>{$gender}</b> Playbys:<h3>
			<div class='clearfix'><div>";

		#asaf_goren---bld=fit+eyes=brown+hair=brunette+rc=white
	#build = b (slim, fit, athletic, muscular, husky, fat)
	#eyes = e (blue, hazel, green, grey, brown, black)
	#hair = h (blonde, red, grey, brown, black, other)
	#race = r (white, black, asain, hispanic, mixed)
		echo showAvailableImp($gender, $prefix, $b='', $e='', $h='', $s='');
		echo '';
		#echo showAvailable;

		break;
	########################################################
	case "f":
		#show available male casting options.
		echo "<h3>Current Unclaimed <b>{$gender}</b> Playbys:<h3>
			<div class='clearfix'><div>";
		echo showAvailable($gender, $prefix, $b='', $e='', $h='', $s='');
		echo '';

		break;
	########################################################
	default:
		include INCLUDE_PATH . "aarContent-inc.php";
		echo $aarContent['UploadDefault']; #Default content	
		#END display

}




#CLOSE PAGE UP
echo '<div class="clearfix"></div>
<hr >


	<form role="form" action="' . THIS_PAGE . '" method="post" onsubmit="return checkForm(this);">
	<h4><i>Is there a Playby whom you are interested in that you didn\'t see?</i></h4>';

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

				</p>';
		}

		echo '</form>
			<br>
			<br>
		</div>
	</div>
</div>';#END display

get_footer();



function showAvailable($gender, $prefix, $str = ''){
/**
	* Show unclaimed PBs
	*
	*
	* TODO compare against active handler/PB claims
	**/

	$pbExt = '-001.jpg';
	$dirPath = "./_playbys/_{$gender}/";


	foreach(glob("./_{$gender}/*", GLOB_ONLYDIR) as $dir) {
			$dirname = basename($dir);
			$mappen[] = $dirname;
	}


	natsort($mappen);
	foreach($mappen as $map){

		#remove sorting nonsense to make printable name (everything after the dash)
		$pbName = substr($map, 0, strpos($map, '---'));
		#remove underscore to make printable name
		$pbName = ucwords(str_replace("_", " ", $pbName));

		$search_dir = "./_{$gender}/".$map;
		$images = glob("$search_dir/*");
		sort($images);

		#remove '?' and everything after
		$pbNameTrim = substr($pbName, 0, strpos($pbName, '?'));

		if (count($images) > 0) {
				 $imgPath = $images[0];

			$str .=  '<!--playby-->
				<div class="" style="float: right; margin: 10px; text-align: center">
					<a href="viewPlayby.php?act=show&gender=' . $gender . '&img='. $map .'" >
						<figure>
						<!--playby preview-->

							<img src="./'. $imgPath .'" alt="0" style="
										border-radius: 25px;
										border: 2px solid #bbb;

										width: 150px;
										height: 150px;">

							<!--description and price of product-->
							<figcaption>
								<h6 class="">' . $pbName . '</h6>
							</figcaption>
						</figure>
					</a>
				</div>';

		} else {
			 // possibly display a placeholder image?
		}

		#$str .= "</div>";
	}

	return $str;

}


function showAvailableImp($gender, $prefix, $b='', $e='', $h='', $s='',  $str = ''){
/**
	* Show unclaimed PBs
	*
	*
	* TODO compare against active handler/PB claims
	**/

	#get all names in directory
	#test (var_dump)

	#filter names - eliminate non matches
	#test (var_dump)



	$dir    = '_male';
	$dir    = scandir($dir);
	#$files2 = scandir($dir, 1); revesrse order
	$arrDir = [];

	#filter array by types
	foreach ($dir as $folderName) {

		#1 remove base file name
		if(($pos = strpos($folderName, '---')) !== false)
		{
			$pos = substr($folderName, $pos + 3);

			#if string contains search term, add to array
			if (strpos($pos, 'eBlu') !== false)
			{
				#remove sorting nonsense to make printable name (everything after the dash)
				$pbName = substr($folderName, 0, strpos($folderName, '---'));

				#make image path
				$imgPath = '_male/' . $folderName . '/' . $pbName . '-001.jpg';



				#should return this honestly...

/*
wants:   http://localhost/WrDK/uploads/viewPlayby.php
	?
	act=show
	&
	g=male
	&
	i=alex_saxon
	&
	d=alex_saxon---eBlu+hBl
	

http://localhost/WrDK/uploads/viewPlayby.php?act=show&g=male&i=alex_saxon&d=alex_saxon---eBlu+hBl
getting: http://localhost/WrDK/uploads/viewPlayby.php
	?
	act=show
	&
	gender=male
	&
	img=alex_saxon
	&
	dir=alex_saxon---eBlu+hBl


#g for gender, i for img (pbname), d for directory (folder)
*/
				
				echo '<div class="" style="float: right; margin: 10px; text-align: center">
					<a href="viewPlayby.php?act=show&g=' . $gender . '&i='. $pbName . '&d='. $folderName .'" >
						<figure>
						<!--playby preview-->

							<img src="./'. $imgPath .'" alt="0" style="
										border-radius: 25px;
										border: 2px solid #bbb;

										width: 150px;
										height: 150px;">

							<!--description and price of product-->
							<figcaption>';
								#finishing making image name - remove underscore to make printable name
								#$pbName = ucwords(str_replace("_", " ", $pbName));

								echo '<h6 class="">' . ucwords(str_replace("_", " ", $pbName)) . '</h6>
							</figcaption>
						</figure>
					</a>
				</div>';

			}
		}
	}

	/*


	$pbExt = '-001.jpg';
	$dirPath = "./_playbys/_{$gender}/";


	foreach(glob("./_{$gender}/*", GLOB_ONLYDIR) as $dir) {
			$dirname = basename($dir);
			$mappen[] = $dirname;
	}


	natsort($mappen);
	foreach($mappen as $map){

		#remove sorting nonsense to make printable name (everything after the dash)
		$pbName = substr($map, 0, strpos($map, '---'));
		#remove underscore to make printable name
		$pbName = ucwords(str_replace("_", " ", $pbName));

		$search_dir = "./_{$gender}/".$map;
		$images = glob("$search_dir/*");
		sort($images);

		#remove '?' and everything after
		$pbNameTrim = substr($pbName, 0, strpos($pbName, '?'));

		if (count($images) > 0) {
				 $imgPath = $images[0];

			$str .=  '<!--playby-->
				<div class="" style="float: right; margin: 10px; text-align: center">
					<a href="viewPlayby.php?act=show&gender=' . $gender . '&img='. $map .'" >
						<figure>
						<!--playby preview-->

							<img src="./'. $imgPath .'" alt="0" style="
										border-radius: 25px;
										border: 2px solid #bbb;

										width: 150px;
										height: 150px;">

							<!--description and price of product-->
							<figcaption>
								<h6 class="">' . $pbName . '</h6>
							</figcaption>
						</figure>
					</a>
				</div>';

		} else {
			 // possibly display a placeholder image?
		}

		#$str .= "</div>";
	}

	return $str;


*/


}
