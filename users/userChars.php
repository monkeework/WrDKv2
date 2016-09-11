<?php
function maxDoc_users_dashboard(){
/**
 * based on dashboard.php is based on admin.php
 * A session protected 'dashboard' page of links to handler/administrator tools
 *
 * Use this file as a landing page after successfully logging in as an administrator.
 * Be sure this page is not publicly accessible by referencing admin_only_inc.php
 *
 *
 * @package ma-v1605-22
 * @author monkeework <monkeework@gmail.com>
 * @version 3.02 2011/05/18
 * @link http://www.monkeework.com/
 * @license http://www.apche.org/licenses/LICENSE-2.0
 * @see $config->userLogin.php
 * @see $config->adminValidate.php
 * @see $config->adminLogout.php
 * @see admin_only_inc.php
 * @todo Get Image Border to show around submitted characters in my characters portion of dashboard.
 */
}

require '../_inc/config_inc.php'; //provides configuration, et al.
//include INCLUDE_PATH . 'arrays-inc.php';

$uID 	 = $_SESSION['UserID'];
$uName = $_SESSION['UserName'];
$uPriv = $_SESSION['Privilege'];

//set access priv needed for this page by member
chekPrivies(1); //known guest (1+)

//Do I need diss?
//$server = 'localhost'; //CHANGE TO YOUR MYSQL HOST!!
//$username='root'; //CHANGE TO YOUR MYSQL USERNAME!!

//to switch theme from Yeti to testBoard
$config->theme = 'testBoard'; //default theme (header/footer combo) see 'Themes' folder for others and info
$config->style = 'testBoard.css'; //currently only Bootswatch Theme uses style to switch look & feel


//END CONFIG AREA ----------------------------------------------------------
$access = "admin"; //admin or higher level can view this page
include_once INCLUDE_PATH . 'admin_only_inc.php'; //session protected page - level is defined in $access var

$feedback = ""; //initialize feedback
if(isset($_GET['msg']))
{
	switch($_GET['msg'])
	{
			case 1:
				 $feedback = "Your permissions don't allow access to that page.";
				 break;
		default:
				 $feedback = "";
	}
}

if($feedback != ""){$feedback = '<div align="center"><h4><font color="red">' . $feedback . '</font></h4></div>';} //Fill out feedback HTML

get_header('testBoard'); //defaults to theme header or header_inc.php

//BEGIN CONTENT AREA
?>

<div class="container-fluid">

<?php
	echo bootswatchFeedback();  //feedback on form operations - see bootswatch_functions.php
	echo getSidebar($uName, $uID, $uPriv);// see custom-inc.php to edit
?>

		<div class="col-sm-9 col-md-10 main">
			<!--toggle sidebar button-->
			<p class="visible-xs">
				<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
			</p>

			<!-- content to go here -->

			<h1 class="page-header"> Your Characters</h1>

			<h2>Notes on characters by mods/whomever if char is not approved - its call to action instructions</h2>




			<div class="row placeholders">

			<?php

//BEGIN user's character que
				$sql = " SELECT UserID, CodeName, FirstName, LastName, MiddleName, CharID, StatusID, Playby, Gender FROM ma_Characters WHERE UserID = $uID ORDER BY CodeName;";

				// connection comes first in mysqli (improved) function
				$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

				if(mysqli_num_rows($result) > 0){//records exist - process
					//outer formatting
					while($row = mysqli_fetch_assoc($result))
					{// process each row
						$cID = $cName = $cStatus = $cPlayby = $cGender = $cDefault = $cLink = $cImg = $pbImg = $statusBorder = '';

						$cID   		= dbOut($row['CharID']);
						$cName 		= dbOut($row['CodeName']);
						$cStatus	= dbOut($row['StatusID']);
						$cPlayby  = dbOut($row['Playby']);
						$cGender  = dbOut($row['Gender']);

						if($cGender == ''){$cGender = 'male';}

						$cLink    = VIRTUAL_PATH . 'characters/profile.php?codename=' . str_replace(' ', '-', $cName) . '&id=' . $cID . '&act=show';
						$cEdit    = VIRTUAL_PATH . 'characters/profile.php?codename=' . str_replace(' ', '-', $cName) . '&id=' . $cID . '&act=edit';
						$cImg     = '../uploads/' . $cID . '-0.jpg';

						$cbDir     = strtolower(str_replace(' ', '_', $cPlayby));
						$cbLnk    = '../uploads/_' . $cGender . '/' . $cbDir . '/' . $cbDir . '-000.jpg';
						$sImg     = './../_img/_static/static---000.gif';

						if($cStatus == 6){$statusBorder = 'border: solid 5px #FFB240;';}

						//create link
						echo '<div class="col-xs-6 col-sm-3 placeholder text-center"><a href="' . $cLink . '"  target="_blank" title="' . $cName . '" >';

						//if we ahve an image use it, else show proxy or default)
						if (file_exists($cImg)) {  //if handler did, show us image
							//set image path
							$imgPath = $cImg;

						//Proxy image
						} elseif(file_exists($cbLnk)) { //if we can match playby, map to playby as proxy
							//set image path
							$imgPath = $cbLnk;

						//default image
						} else { //show default
							//set to static
							$imgPath = $sImg;
						}

						//close up link
						echo '<img src="'
							. $imgPath . '" class="center-block img-responsive img-circle" alt="'
							. $cName . '" style="height:150px; width:150px; '
							. $statusBorder . '"/></a><h5><a href="'
							. $cLink . '" title="'
							. $cName . '" target="_blank">'
							. $cName . '</a></h5><span class="text-muted">'
							. $aarStatus[$cStatus] . ' | <a href="'
							. $cEdit . '" target="_blank" title="'
							. $cName . '">Edit</a> '
							. $cStatus . ' </span>
							<br /><br /></div>'; //close character
					}


				}else{//no records
						echo "<p>You currently have no characters assigned to you.</p>";
				} //END PROFILES SEARCH
				//outer formatting here
//END  user character que

				@mysqli_free_result($result);
		?>


			<div class="clearfix"></div>
		</div>
	</div>
	</div><!--/row-->

	<div class="push"></div>

</div><!--/.container-->


<?php

//END CONTENT AREA

get_footer(); //defaults to theme footer or footer_inc.php


function getDirectories($path='', $str = ''){


	foreach (glob("*") as $dirname ) {
	if( is_dir( $dirname ) )
	echo "<a target=\"_blank\" href=\"$dirname \">$dirname</a><br />";}
	}
