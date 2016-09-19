<?php
function maxDoc_users_userPrefs(){
/**
 * based on userPrefs.php is based on dashboard.php & _test/edit.php
 * A session protected 'dashboard' page of links to handler/administrator tools
 *
 * Use this file to set user site prefs.
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

#declaried in users/validateUser.php
$uID 	= $_SESSION['UserID'];
$uName 	= $_SESSION['UserName'];
$uPriv 	= $_SESSION['Privilege'];
$uStart = $_SESSION['uStart']; #startpage



#dumpDie($_SESSION);
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
			<h3> Welcome <a href="<?=VIRTUAL_PATH; ?>users/dashboard.php"><?=$uName; ?></a> to your start page</h3>
			<p>General instructions on what to do/get going to go here</p>

			<h5>Suggested Steps</h5>
			<ul>

					<?php
						// ask user to set their startpage if still set to site default
						if($uStart = '../users/dashboardBegin.php'){
							echo '<li><a href="' . VIRTUAL_PATH . 'users/userPrefs.php">Update your start Page here</a></li>';
						}
					?>
					<li> <del><a href="#" >Do You have a character?</a></del> </li>
					<li> <del><a href="#">Do You Have a character that needs updating?</a></del> </li>
					<li> <del><a href="#">Do You have any posts to reply to?</a></del> </li>
					<li> <del><a href="#">Do you have any posts to start?</a></del> </li>
					<li> <del><a href="#">Have you read our rules?</a></del> </li>
					<li> <del><a href="#">Have your read our Character Creation Guidelines?</a></del> </li>
					<li> <del><a href="#">Have your read our Newbie Guide?</a></del> </li>
			</ul>

			<p class="text-mute"><small>* Please bare with us, we still need to create most of these pages</small></p>




			<div class="clearfix"></div>
		</div>
	</div>
	</div><!--/row-->

	<div class="push"></div>

</div><!--/.container-->


<?php

//END CONTENT AREA

get_footer(); //defaults to theme footer or footer_inc.php

