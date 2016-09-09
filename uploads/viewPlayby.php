<?php
function maxDoc_library_indexShow(){
	/**
	 * based on indexShow.php, which gets $imgName from query string creates image gallery.
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

# '../' works for a sub-folder.  use './' for the root
require '../_inc/config_inc.php'; #configuration, pathing, error handling, db credentials

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

#redirect back to index page

global $config;

get_header();

echo "
	<div class='jumbotron'>
		<h1 style='margin: 0 0 -35px -35px;'><br /><br /><br /><br />
		<b>Playbys</b></h1>
	</div>

	<div class='container-fluid'>
		<div class='row content'>
			<div class='col-sm-3 sidenav'>
				<h4>Playby's Check:</h4>

				<a href='./index.php?act=f' class='btn btn-primary btn-xs'>Female Playbys</a>
				 &nbsp; <a href='./index.php?act=m' class='btn btn-primary  btn-xs'>Male Playbys</a><br /><br />

				<div class='input-group'>
					<input type='text' class='form-control' placeholder='Check For Specific Playby'>
					<span class='input-group-btn'>
						<button class='btn btn-default' type='button'>
							<span class='glyphicon glyphicon-search'></span>
						</button>
					</span>
				</div>

				<br />

			</div>
			<div class='col-sm-9'>";

#http://localhost/WrDK/uploads/_male/jake_miller/jake_miller-001.jpg


switch ($myAction)
{//check 'act' for type of process
	case "show":
		#SEE : https://www.sanwebe.com/2012/09/image-gallery-from-a-directory-using-php

		#show available male casting options.
	
	/*	
		#asaf_goren---bld=fit+eyes=brown+hair=brunette+rc=white
		#build = b (slim, fit, athletic, muscular, husky, fat)
		#eyes = e (blue, hazel, green, grey, brown, black)
		#hair = h (blonde, red, grey, brown, black, other)
		#race = r (white, black, asain, hispanic, mixed)
		echo showAvailableImp($gender, $prefix, $b='', $e='', $h='', $s='');
		
		Test URL
		#http://localhost/WrDK/uploads/viewPlayby.php?act=show
		&g=male
		&i=alex_saxon
		&d=alex_saxon---eBlu+hBl
	*/
		$gender  = $_GET['g']; #char gender (_male or _female)
		$dirName = $_GET['d'];
		$pbName  = $_GET['i']; #alex_saxon (PB's name)
		#$pbPhys  = $_GET['p'];
	
	  #add 'plus sign' back in
	  $dirName = str_replace(' ', '+', $dirName);
		#trim off directory tail
		#$pbName = '';

	
		$pbName  = str_replace('_', ' ', $pbName);
		$imgPath = $gender . '/' . $dirName;

		echo "<h3>Image gallery For <strong>" . ucwords($pbName) . "</strong> <h3>";

		$path = "_" . $imgPath;

		$files = scandir($path);
		$count=1;
		foreach ($files as $filename)
		{
			if($count >= 3){
				echo '<div class=""

					style="float: right;
						margin: 10px;
						text-align: center;
						">
					<figure>
						<!--playby preview-->
						<a href="_'. $imgPath . '/'. $filename . '" alt="' . $filename . '">
							<img src="_'. $imgPath . '/'. $filename . '" alt="' . $filename . '" alt="0"
								style="
									border-radius: 25px;
									border: 2px solid #bbb;

									width: 200px;
									height: 200px;
									">
						</a>
					</figure>
				</div>';
				}
			$count++;
		}


		#echo showAvailable;

		break;
	########################################################
	default:

		#redirect back to index page
		echo "<h3>Redirect please $myAction<h3>";
}




#CLOSE PAGE UP
echo '

		</div>
	</div>
</div>';#END display

get_footer();


